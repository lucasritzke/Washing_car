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
$email = $_POST['email'];

$sql = "DELETE FROM car_informations WHERE id_car='$carId'";
if ($conn->query($sql) === TRUE) {
    echo "Email order $email has been closed";
} else {
    echo "Error deleting car information: " . $conn->error;
}

$conn->close();
?>

