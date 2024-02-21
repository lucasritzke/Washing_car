<?php
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

var_dump($_POST);

$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customerName = mysqli_real_escape_string($conn, $_POST["customerName"]);
$jobType = mysqli_real_escape_string($conn, $_POST["jobType"]);
$carName = mysqli_real_escape_string($conn, $_POST["carName"]);
$carPlate = mysqli_real_escape_string($conn, $_POST["carPlate"]);
$carMileage = mysqli_real_escape_string($conn, $_POST["carMileage"]);
$carCPF = mysqli_real_escape_string($conn, $_POST["carCPF"]);
$carEmail = mysqli_real_escape_string($conn, $_POST["carEmail"]);
$todayDay = mysqli_real_escape_string($conn, $_POST["todaysDay"]);
$pickUpDay = mysqli_real_escape_string($conn, $_POST["pickUpDay"]);
$totalValue = floatval(str_replace(',', '.', $_POST["totalValue"]));

$carPhotos = [];

for ($i = 0; $i < count($_FILES["carPhotos"]["name"]); $i++) {
    $tmpFilePath = $_FILES["carPhotos"]["tmp_name"][$i];

    if ($tmpFilePath != "") {
        $imagick = new Imagick($tmpFilePath);
        $imagick->resizeImage(800, 600, Imagick::FILTER_LANCZOS, 1);

        $carPhotos[] = mysqli_real_escape_string($conn, file_get_contents($tmpFilePath));
    }
}

$sql = "INSERT INTO car_informations (customer_name, service_type, car_name, car_plate, car_image_1, car_image_2, car_image_3, car_image_4, carCPF, email, today_day, pick_up_Day, total_value, car_mileage)
        VALUES ('$customerName', '$jobType', '$carName', '$carPlate', '" . $carPhotos[0] . "', '" . $carPhotos[1] . "', '" . $carPhotos[2] . "', '" . $carPhotos[3] . "', '$carCPF', '$carEmail', '$todayDay', '$pickUpDay', $totalValue, '$carMileage')";

if ($conn->query($sql) === TRUE) {
    header("Location: register.php?registration=success");
    exit();
} else {
    echo "Erro ao executar a declaração: " . $conn->error;
}

$conn->close();
?>

