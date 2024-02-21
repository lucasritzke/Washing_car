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

$sqlHamburger = "SELECT * FROM hamburger";
$resultHamburger = $conn->query($sqlHamburger);
?>

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
        background-color: #fff;
        color: #000;
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
	   <button id="toggleButton" onclick="toggleDarkMode()" style="margin-left: 1218px;font-size: 25px;">
<svg  style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>
</button>
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
<div id="hamburger" class="hamburger" style="position: absolute; top: 10px; right: 1162px;width: 171px;text-align: left;border-radius: 10px;" >
    <div style="border-radius: 8px;" >
	<button id="hamburgerButton" onclick="toggleHamburgerMenu()"  style="margin-top: 15px;font-size: 34px; border-radius: 10px;"    >
<svg id="hamburgerIcon" style="width: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
</button>
        <ul id="hamburgerMenu" style="display: none;">
            <?php
            if ($resultHamburger->num_rows > 0) {
                while ($rowHamburger = $resultHamburger->fetch_assoc()) {
                    echo '<li><a href="' . $rowHamburger["file_name"] . '">' . $rowHamburger["display_name"] . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
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

                <label for="carCPF">CPF (optional):</label>
                <input type="text" id="carCPF" name="carCPF" style="border-radius: 11px;">
                <br>

                <label for="carEmail">Email:</label>
                <input type="email" id="carEmail" style="border-radius: 11px;" name="carEmail" required>
                <br>

                <label for="jobType">Service type:</label>
                <select id="jobType" name="jobType" style="border-radius: 11px;padding: 8px;">
		<?php
                $servername = "mysql-server";
                $username = "root";
                $password = "lritzke";
                $database = "washing_project";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT job_name FROM jobs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $jobName = $row['job_name'];
                        echo "<option value='$jobName'>$jobName</option>";
                    }
                } else {
                    echo "<option value=''>No service types found</option>";
                }

                $conn->close();
                ?>
                </select>
                <br>

                <label for="carName">Car Name:</label>
                <input type="text" id="carName" name="carName" style="border-radius: 11px;" required>
                <br>

                <label for="carPlate">Car Plate:</label>
                <input type="text" id="carPlate" name="carPlate" style="border-radius: 11px;" pattern="^([a-zA-Z]{3}\d[A-Za-z]\d{2}|[a-zA-Z]{3}-\d{4})$" required>
                <br>

                <label for="carMileage">Car Mileage:</label>
                <input type="text" id="carMileage" name="carMileage" style="border-radius: 11px;" pattern="\d{1,3}(\,\d{3})*">
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

                <input type="text" id="todaysDay" name="todaysDay" value="<?= date('Y-m-d') ?>" style="border-radius: 11px; Display: none;"  readonly>
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
    function toggleHamburgerMenu() {
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        hamburgerMenu.style.display = (hamburgerMenu.style.display === 'none' || hamburgerMenu.style.display === '') ? 'block' : 'none';
    }

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

		toggleButton.innerHTML = body.classList.contains('dark-mode') ? '<svg style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#000000" d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>' : '<svg style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>';

	          hamburgerIcon.innerHTML = body.classList.contains('dark-mode') ? '<svg style="width: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>' : '<svg style="width: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>';
        }


function displaySearchResults(results) {
    console.log(results); 

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
    fetch('view_information_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ customerName: customerName }),
    })
    .then(response => response.json())
    .then(data => {
        alert(JSON.stringify(data));
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}

    </script>
</body>

</html>

