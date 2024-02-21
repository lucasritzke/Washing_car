<?php
$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verify_cpf = $_POST["cpf_verify"];
    $check_permission_sql = "SELECT edit_informations FROM workers WHERE cpf = '$verify_cpf'";
    $result_permission = $conn->query($check_permission_sql);

    if ($result_permission->num_rows > 0) {
        $row = $result_permission->fetch_assoc();
        if ($row["edit_informations"] == 1) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Sem permissao."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Cpf invalido."]);
    }
    exit; 
}
?>

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
    <title>Search Car Information</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
.dark-mode button.button_ole {
  background-color: #b3b3b3;
  color: #000 !important;
}

    img {
	width: 20%;    
    }

    #content {
        background-color: #bdbdbd;
        color: #000;
    }

    .dark-mode #content {
        background-color: #fff;
        color: #fff;
    }

    .light-background {
        background: #aaa;
        color: #000;
    }

.dark-mode button.button {
  background-color: #aeaeae;
  color: #000 !important;
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
        border: 1px solid #000;
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
	<button id="toggleButton" onclick="toggleDarkMode()" style="margin-left: 1218px; font-size: 25px;">
<svg  style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>
</button>
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
    <div id="content" align="center" style="width: 647px; margin-left: 382px; border-radius: 15px;">
        <main>
            <h1>Edit Car Information</h1>

        <form id="searchForm">
                <label for="searchInput">Enter with the cpf or Email:</label>
                <input type="text" id="searchInput" name="searchInput" required>
                <br>
                <input type="hidden" name="cpf_verify" id="cpf_verify" value="">
                <input type="button" value="Search" onclick="verifyPermissionAndSearch()">
        </form>


            <div id="searchResults"></div>
        </main>
    </div>

    <script>

    function toggleHamburgerMenu() {
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        hamburgerMenu.style.display = (hamburgerMenu.style.display === 'none' || hamburgerMenu.style.display === '') ? 'block' : 'none';
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

        function searchCarInformation() {
            const searchInput = document.getElementById('searchInput').value;

            if (searchInput.trim() !== "") {
                const formData = new FormData();
                formData.append('searchInput', searchInput);

                fetch('search_handler_edit.php', {
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
                <td><button class="button" onclick="viewMoreInformation('${result.id_car}')">View More Information</button></td>
            </tr>`;
        });

        tableHtml += '</table>';
        searchResultsDiv.innerHTML = tableHtml;
    } else {
        searchResultsDiv.innerHTML = '<p>No results found.</p>';
    }
}

function viewMoreInformation(carId) {
    const detailsUrl = 'view_information_handler_edit.php';
    fetch(detailsUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ carId: carId }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            return response.json();
        })
        .then(details => {
            console.log('Details received:', details);

            const searchResultsDiv = document.getElementById('searchResults');

            if (details !== null) {
                let detailsHtml = `<h2>Edit Details for Car ID ${carId}</h2>`;
                detailsHtml += '<table>';

                detailsHtml += `<tr><th>Customer Name</th><td><input type='text' id='customer_name_${carId}' value='${details.customer_name}'></td></tr>`;
                detailsHtml += `<tr><th>CPF</th><td><input type='text' id='carCPF_${carId}' value='${details.carCPF}'></td></tr>`;
                detailsHtml += `<tr><th>Email</th><td><input type='text' id='email_${carId}' value='${details.email}'></td></tr>`;
                detailsHtml += `<tr><th>Car Name</th><td><input type='text' id='car_name_${carId}' value='${details.car_name}'></td></tr>`;
                detailsHtml += `<tr><th>Car Plate</th><td><input type='text' id='car_plate_${carId}' value='${details.car_plate}'></td></tr>`;
                detailsHtml += `<tr><th>Car Mileage</th><td><input type='text' id='car_mileage_${carId}' value='${details.car_mileage}'></td></tr>`;
                detailsHtml += `<tr><th>Service Type</th><td><select id="service_type_${carId}" style="width: 193px;padding: 9px;">`;
                detailsHtml += `<option value="Car-Washing" ${details.service_type === 'Car-Washing' ? 'selected' : ''}>Car Washing</option>`;
                detailsHtml += `<option value="Car-Polishing" ${details.service_type === 'Car-Polishing' ? 'selected' : ''}>Car Polishing</option>`;
                detailsHtml += `</select></td></tr>`;
                detailsHtml += `<tr><th>Entry Day</th><td><input type='text' id='today_day_${carId}' value='${details.today_day}'></td></tr>`;
                detailsHtml += `<tr><th>Pick up Day</th><td><input type='text' id='pick_up_day_${carId}' value='${details.pick_up_Day}'></td></tr>`;
                detailsHtml += `<tr><th>Total Value</th><td><input type='text' id='total_value_${carId}' value='${details.total_value}'></td></tr>`;
                detailsHtml += `<button class="button_ole" onclick="updateInformation(${carId})">Save Changes</button>`;
                detailsHtml += '</table>';

detailsHtml += `<div style="display: flex;">`; // Abre a div flexível antes do loop

for (let i = 1; i <= 4; i++) {
    const imageFieldName = `car_image_${i}`;
    const imageUrl = details[imageFieldName] ? `data:image/jpeg;base64,${details[imageFieldName]}` : '';
    detailsHtml += `<tr><th></th><td>`;
    detailsHtml += `<div id='imageContainer_${imageFieldName}_${carId}' style="position: relative; display: ${imageUrl ? 'block' : 'none'};">`;
    detailsHtml += `<img src="${imageUrl}" id='${imageFieldName}_${carId}' style="max-width: 100px; max-height: 100px; margin-right: 10px; width: 63px; margin-left: 66px; ">`;
    detailsHtml += `<img id='${imageFieldName}_preview_${carId}' src="" style="max-width: 100px; max-height: 100px; position: absolute; top: 0; left: 0; display: none;">`;
    detailsHtml += `</div>`;
}

detailsHtml += `</div>`; 

                searchResultsDiv.innerHTML = detailsHtml;
            } else {
                searchResultsDiv.innerHTML = '<p>No details found for the provided Car ID.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching details:', error);
            const searchResultsDiv = document.getElementById('searchResults');
            searchResultsDiv.innerHTML = '<p>An error occurred while fetching details.</p>';
        });
}


function updateImagePreview(input, imageId, previewId) {
    const imageElement = document.getElementById(imageId);
    const previewElement = document.getElementById(previewId);

    if (!imageElement || !previewElement) {
        console.error('Image or preview element not found.');
        return;
    }

    const containerId = `imageContainer_${previewId}`;
    const containerElement = document.getElementById(containerId);

    const file = input.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imageElement.src = e.target.result;
            containerElement.style.display = 'block';

            const carId = getCarIdFromElement(input); 
            updateInformation(carId);
        };
        reader.readAsDataURL(file);
    } else {
        containerElement.style.display = 'none';  
        imageElement.src = '';  

        const carId = getCarIdFromElement(input); 
        updateInformation(carId);
    }
}


function updateInformation(carId) {
    const customerName = document.getElementById('customer_name_' + carId).value;
    const carCPF = document.getElementById('carCPF_' + carId).value;
    const email = document.getElementById('email_' + carId).value;
    const carName = document.getElementById('car_name_' + carId).value;
    const carPlate = document.getElementById('car_plate_' + carId).value;
    const carMileage = document.getElementById('car_mileage_' + carId).value;
    const serviceType = document.getElementById('service_type_' + carId).value;
    const todayDay = document.getElementById('today_day_' + carId).value;
    const pickUpDay = document.getElementById('pick_up_day_' + carId).value;
    const totalValue = document.getElementById('total_value_' + carId).value;

    const updateUrl = 'update_car_information.php';
    const formData = new FormData();

    formData.append('carId', carId);
    formData.append('customerName', customerName);
    formData.append('carCPF', carCPF);
    formData.append('email', email);
    formData.append('serviceType', serviceType);
    formData.append('carName', carName);
    formData.append('carPlate', carPlate);
    formData.append('carMileage', carMileage);
    formData.append('todayDay', todayDay);
    formData.append('pickUpDay', pickUpDay);
    formData.append('totalValue', totalValue);

    fetch(updateUrl, {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Information updated successfully.');
                updateImages(carId); // 
            } else {
                console.error('Failed to update information.');
            }
        })
        .catch(error => {
            console.error('Error updating information:', error);
        });
}

        function verifyPermissionAndSearch() {
            const cpf_verify = prompt("Digite seu CPF:");

            document.getElementById("cpf_verify").value = cpf_verify;

            const formData = new FormData(document.getElementById('searchForm'));

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    searchCarInformation();  // Call your existing function

                } else {
                    alert(data.message);
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error verifying permission:', error);
                alert('An error occurred while verifying permission.');
                location.reload();
            });
        }

    </script>
</body>

</html>
