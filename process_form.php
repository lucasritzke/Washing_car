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
    $customerName = $_POST["customerName"];
    $jobType = $_POST["jobType"];
    $carName = $_POST["carName"];
    $carPlate = $_POST["carPlate"];
    $carCPF = $_POST["carCPF"];
    $carEmail = $_POST["carEmail"];
    $todayDay = $_POST["todaysDay"];
    $pickUpDay = $_POST["pickUpDay"];
    $totalValue = $_POST["totalValue"];

    $carPhotos = [];

    for ($i = 0; $i < count($_FILES["carPhotos"]["name"]); $i++) {
        $tmpFilePath = $_FILES["carPhotos"]["tmp_name"][$i];

        if ($tmpFilePath != "") {
            $imagick = new Imagick($tmpFilePath);
            $imagick->resizeImage(800, 600, Imagick::FILTER_LANCZOS, 1);

            // Obter os dados binários da imagem
            $carPhotos[] = file_get_contents($tmpFilePath);
        }
    }

    // Preparar a declaração de inserção
    $sql = "INSERT INTO car_informations (customer_name, service_type, car_name, car_plate, car_image_1, car_image_2, car_image_3, car_image_4, CPF, email, today_day, pick_up_Day, total_value)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Vincular parâmetros
    $null = null;
    $stmt->bind_param("ssssbbbbbssss", $customerName, $jobType, $carName, $carPlate, $null, $null, $null, $null, $carCPF, $carEmail, $todayDay, $pickUpDay, $totalValue);

    // Enviar dados binários usando mysqli_stmt::send_long_data
    for ($i = 0; $i < count($carPhotos); $i++) {
        $stmt->send_long_data($i + 4, $carPhotos[$i]);
    }

    // Executar a declaração
    $stmt->execute();

    // Verificar sucesso
    if ($stmt->affected_rows > 0) {
        // Redirecionar de volta para register.php com a mensagem
        header("Location: register.php?registration=success");
        exit();
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    // Fechar declaração e conexão
    $stmt->close();
    $conn->close();
}
?>

