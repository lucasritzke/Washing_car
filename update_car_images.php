<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carId = $_POST["carId"];

    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $carPhotos = [];
    for ($i = 1; $i <= 4; $i++) {
        $imageFieldName = "car_image_" . $i;

        if (isset($_FILES[$imageFieldName])) {
            $imageData = file_get_contents($_FILES[$imageFieldName]["tmp_name"]);
            $carPhotos[] = mysqli_real_escape_string($conn, $imageData);
        }
    }

    // Atualize as colunas de imagem no banco de dados
    $sqlImageUpdate = "UPDATE car_informations SET 
        car_image_1 = '" . $carPhotos[0] . "',
        car_image_2 = '" . $carPhotos[1] . "',
        car_image_3 = '" . $carPhotos[2] . "',
        car_image_4 = '" . $carPhotos[3] . "'
        WHERE id_car = $carId";

    $conn->query($sqlImageUpdate);

    // Responda ao cliente
    header('Content-Type: application/json');
    echo json_encode(array('success' => true));

    $conn->close();
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
?>
