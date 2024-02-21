<?php
$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$carId = $_POST['carId'];

$sql = "SELECT car_name, car_plate FROM car_informations WHERE id_car='$carId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $carName = $row['car_name'];
    $carPlate = $row['car_plate'];

    echo "Do you really want to delete this record for the car $carName with the license plate $carPlate?";
} else {
    echo "Error: No car found with the provided ID.";
}

$conn->close();
?>

