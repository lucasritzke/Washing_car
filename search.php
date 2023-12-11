<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Car Information</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    img {
	width: 50%;    
    }

    #content {
        background-color: #bdbdbd;
        color: #000;
    }

    .dark-mode #content {
        background-color: #686868;
        color: #fff;
    }

    .light-background {
        background: #aaa;
        color: #000;
    }

    .dark-background {
        background: #000;
        color: #fff;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
        text-align: left;
    }

    th,
    td {
        padding: 12px;
    }
</style>

<body>
    <div id="background-paragraph"></div>

    <?php
    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlMenu = "SELECT * FROM menu";
    $resultMenu = $conn->query($sqlMenu);
    ?>

    <section id="menu">
        <header>
            <button id="toggleButton" onclick="toggleDarkMode()" style="margin-left: 1218px; font-size: 25px;">&#127765;</button>
            <div style="margin-top: -70px;">
                <h1>Bennin-Motorcycles Washing</h1>
                <nav>
                    <ul>
                        <?php
                        if ($resultMenu->num_rows > 0) {
                            while ($rowMenu = $resultMenu->fetch_assoc()) {
                                echo '<li><a href="' . $rowMenu["file_name"] . '">' . $rowMenu["display_name"] . '</a></li>';
                            }
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </ul>
                </nav>
            </div>
        </header>
    </section>

    <div id="content" align="center" style="width: 647px; margin-left: 382px; border-radius: 15px;">
        <main>
            <h1>Search Car Information</h1>

            <form id="searchForm">
                <label for="searchInput">Enter CPF or Email:</label>
                <input type="text" id="searchInput" name="searchInput" style="border-radius: 11px;" required>
                <br>

                <input type="button" value="Search" onclick="searchCarInformation()">
            </form>

            <div id="searchResults"></div>
        </main>
    </div>

    <script>
        function toggleDarkMode() {
            const body = document.body;
            const header = document.querySelector('header');
            const form = document.querySelector('form');
            const allDivs = document.querySelectorAll('.light-background, .dark-background');
            const contentDiv = document.getElementById('content');
            const paragraphs = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, a');
            const toggleButton = document.getElementById('toggleButton');

            body.classList.toggle('dark-mode');
            header.classList.toggle('dark-mode');
            form.classList.toggle('dark-mode');
            contentDiv.classList.toggle('dark-mode');

            allDivs.forEach((element) => {
                element.classList.toggle('dark-background');
                element.classList.toggle('light-background');
            });

            paragraphs.forEach((element) => {
                element.classList.toggle('dark-mode');
            });
            toggleButton.innerHTML = body.classList.contains('dark-mode') ? '🌑' : '&#127765;';
        }

        function searchCarInformation() {
            const searchInput = document.getElementById('searchInput').value;

            if (searchInput.trim() !== "") {
                const formData = new FormData();
                formData.append('searchInput', searchInput);

                fetch('search_handler.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(results => {
                        displaySearchResults(results);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }
        }

        function displaySearchResults(results) {
            const searchResultsDiv = document.getElementById('searchResults');

            if (results && results.data && results.data.length > 0) {
                let tableHtml = '<table>';
                tableHtml += '<tr><th>Customer Name</th><th>Pickup Date</th><th>Return Date</th><th>Total Value</th><th>Action</th></tr>';

                results.data.forEach(result => {
                    tableHtml += `<tr>
                        <td>${result.customer_name}</td>
                        <td>${result.today_day}</td>
                        <td>${result.pick_up_Day}</td>
                        <td>${result.total_value}</td>
                        <td><button onclick="viewMoreInformation('${result.id_car}')">View More Information</button></td>
                    </tr>`;
                });

                tableHtml += '</table>';
                searchResultsDiv.innerHTML = tableHtml;
            } else {
                searchResultsDiv.innerHTML = '<p>No results found.</p>';
            }
        }

        function displayImages(base64Images) {
            const imageContainer = document.getElementById('imageContainer');

            if (imageContainer) {
                base64Images.forEach((base64Image, index) => {
                    const imgElement = document.createElement('img');
                    imgElement.src = 'data:image/png;base64,' + base64Image;
                    imgElement.alt = 'Car Image ' + (index + 1);
                    imgElement.style.width = '200px';

                    imageContainer.appendChild(imgElement);
                });
            } else {
                console.error('Error: imageContainer is null. Verify the presence of the element with id "imageContainer" in your HTML.');
            }
        }

        function viewMoreInformation(carId) {
            const detailsUrl = 'view_information_handler.php';

            fetch(detailsUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ carId: carId }),
            })
                .then(response => response.json())
                .then(details => {
                    console.log('Details received:', details);

                    const searchResultsDiv = document.getElementById('searchResults');

                    if (details !== null) {
                        let detailsHtml = `<h2>Details for Car ID ${carId}</h2>`;

                        for (const key in details) {
                            if (details.hasOwnProperty(key) && details[key] !== null) {
                                if (key.startsWith('car_image_')) {
                                    detailsHtml += `<p>${key}: </p>`;
                                    const base64Image = details[key];
                                    detailsHtml += `<img src="data:image/png;base64,${base64Image}" alt="${key}">`;
                                } else {
                                    detailsHtml += `<p>${key}: ${details[key]}</p>`;
                                }
                            }
                        }

                        const imageKeys = Object.keys(details).filter(key => key.startsWith('car_image_'));
                        const base64Images = imageKeys.map(key => details[key]);
                        displayImages(base64Images);

                        searchResultsDiv.innerHTML = detailsHtml;
                    } else {
                        searchResultsDiv.innerHTML = '<p>No details found for the provided Car ID.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching details:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
        });
    </script>
</body>

</html>

