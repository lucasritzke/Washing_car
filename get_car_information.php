<?php
$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$carId = $_GET['carId']; 

$sql = "SELECT service_type, total_value, email FROM car_informations WHERE id_car='$carId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); 
} else {
    echo json_encode(array()); 
}

$conn->close();
?>

