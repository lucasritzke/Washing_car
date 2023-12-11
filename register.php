<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>motorcycle washing</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    #content {
        background-color: #bfbdbd;
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

    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);
    ?>

    <section id="menu">
        <header>
	   <button id="toggleButton" onclick="toggleDarkMode()" style="margin-left: 1218px;font-size: 25px;">&#127765;</button>
	    <div style="margin-top: -70px;" >
            <h1>Bennin-Motorcycles Washing</h1>
            <nav>
                <ul>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li><a href="' . $row["file_name"] . '">' . $row["display_name"] . '</a></li>';
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

    <div id="content" align="center" style="width: 647px;margin-left: 382px;border-radius: 15px;margin-top: -65px;">
        <main style="margin-top: 111px;" >
            <h1>Car information and services</h1>


            <form method="post" enctype="multipart/form-data" action="process_form.php">

                <label for="customerName">Customer name:</label>
                <input type="text" id="customerName" name="customerName" style="border-radius: 11px;" required>
                <br>

                <label for="jobType">Service type:</label>
                <select id="jobType" name="jobType" style="border-radius: 11px;padding: 8px;">
                    <option value="carWashing">Car Washing</option>
                    <option value="carPolishing">Car Polishing</option>
                </select>
                <br>

                <label for="carName">Car Name:</label>
                <input type="text" id="carName" name="carName" style="border-radius: 11px;" required>
                <br>

                <label for="carPlate">Car Plate:</label>
                <input type="text" id="carPlate" name="carPlate" style="border-radius: 11px;" pattern="^([a-zA-Z]{3}\d[A-Za-z]\d{2}|[a-zA-Z]{3}-\d{4})$" required>
                <br>

                <label for="carMileage">Car Mileage:</label>
                <input type="text" id="carMileage" name="carMileage" style="border-radius: 11px;" pattern="\d{1,3}(\.\d{3})*">
                <br>

                <div id="div-background-images" class="light-background" >
                    <h3 for="carPhotos">Car Photos:</h3>
                    <label for="carPhotos">Car Photos 1:</label>
                    <input type="file" id="carPhotos" name="carPhotos[]" accept="image/*" multiple onchange="previewImages(this, 0)" style="width: 237px;">
                    <div id="imageContainer0"></div>
                    <br>

                    <label for="carPhoto1">Car Photo 2 (optional):</label>
                    <input type="file" id="carPhoto1" name="carPhotos[]" accept="image/*" multiple onchange="previewImages(this, 1)" style="width: 237px;">
                    <div id="imageContainer1"></div>
                    <br>

                    <label for="carPhoto2">Car Photo 3 (optional):</label>
                    <input type="file" id="carPhoto2" name="carPhotos[]" accept="image/*" onchange="previewImages(this, 2)" style="width: 237px;">
                    <div id="imageContainer2"></div>
                    <br>

                    <label for="carPhoto3">Car Photo 4 (optional):</label>
                    <input type="file" id="carPhoto3" name="carPhotos[]" accept="image/*" onchange="previewImages(this, 3)" style="width: 237px;">
                    <div id="imageContainer3"></div>
                    <br>
                </div>

                <label for="carCPF">CPF (optional):</label>
                <input type="text" id="carCPF" style="border-radius: 11px;" name="carCPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                <br>

                <label for="carEmail">Email:</label>
                <input type="email" id="carEmail" style="border-radius: 11px;" name="carEmail" required>
                <br>

                <label for="todaysDay">Today's Day:</label>
                <input type="text" id="todaysDay" name="todaysDay" value="<?= date('m-d-Y') ?>" style="border-radius: 11px;"  readonly>
                <br>

                <label for="pickUpDay">Pick Up Day:</label>
                <input type="date" id="pickUpDay" name="pickUpDay" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" style="border-radius: 11px;" required>
                <br>

                <label for="totalValue">Total Value of the Service:</label>
                <input type="text" id="totalValue" name="totalValue" style="border-radius: 11px;" required>
                <br>

                <input type="submit" value="Submit">

            </form>
        </main>
    </div>

    <script>
        function previewImages(input, index) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = document.createElement('img');
                image.src = e.target.result;
                image.style.maxWidth = '100px';
                image.style.maxHeight = '100px';

                var imageContainer = document.getElementById('imageContainer' + index);
                imageContainer.innerHTML = ''; 
                imageContainer.appendChild(image);

            };

            reader.readAsDataURL(input.files[0]);
        }

        function toggleDarkMode() {
            const body = document.body;
            const header = document.querySelector('header');
            const form = document.querySelector('form');
            const allDivs = document.querySelectorAll('.light-background, .dark-background'); // Selecionar todas as classes light-background e dark-background
            const contentDiv = document.getElementById('content');
            const paragraphs = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, a');
            const toggleButton = document.getElementById('toggleButton');

            body.classList.toggle('dark-mode');
            header.classList.toggle('dark-mode');
            form.classList.toggle('dark-mode');
            contentDiv.classList.toggle('dark-mode');

            // Toggle dark mode para todas as classes light-background e dark-background
            allDivs.forEach((element) => {
                element.classList.toggle('dark-background');
                element.classList.toggle('light-background');
            });

            paragraphs.forEach((element) => {
                element.classList.toggle('dark-mode');
            });

	    toggleButton.innerHTML = body.classList.contains('dark-mode') ? '🌑' : '&#127765;';
        }

function displaySearchResults(results) {
    console.log(results); // Add this line

    const searchResultsDiv = document.getElementById('searchResults');

    if (results.data && results.data.length > 0) {
        let tableHtml = '<table>';
        tableHtml += '<tr><th>Customer Name</th><th>Pickup Date</th><th>Return Date</th><th>Total Value</th><th>Action</th></tr>';

        results.data.forEach(result => {
            tableHtml += `<tr>
                <td>${result.customer_name}</td>
                <td>${result.today_day}</td>
                <td>${result.pick_up_Day}</td>
                <td>${result.total_value}</td>
                <td><button onclick="viewMoreInformation('${result.customer_name}')">View More Information</button></td>
            </tr>`;
        });

        tableHtml += '</table>';
        searchResultsDiv.innerHTML = tableHtml;
    } else {
        searchResultsDiv.innerHTML = '<p>No results found.</p>';
    }
}

function viewMoreInformation(customerName) {
    // Perform an AJAX request to fetch detailed information about the selected record
    fetch('view_information_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ customerName: customerName }),
    })
    .then(response => response.json())
    .then(data => {
        // Display detailed information in a modal or alert
        alert(JSON.stringify(data));
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}

    </script>
</body>

</html>
