<?php

$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imageId = $_GET['id'];
$imageNumber = $_GET['image'];

$imageField = "car_image_" . $imageNumber;
$sql = "SELECT $imageField FROM car_informations WHERE id = $imageId";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row[$imageField];

    header('Content-Type: image/jpeg');

    echo file_get_contents($imagePath);
} else {
    echo "Image not found";
}

$conn->close();
?>

