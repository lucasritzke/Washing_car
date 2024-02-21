<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carId = $_POST["carId"];
    $customerName = $_POST["customerName"];
    $carCPF = $_POST["carCPF"];
    $email = $_POST["email"];
    $serviceType = $_POST["serviceType"];
    $carName = $_POST["carName"];
    $carPlate = $_POST["carPlate"];
    $carMileage = $_POST["carMileage"];
    $todayDay = $_POST["todayDay"];
    $pickUpDay = $_POST["pickUpDay"];
    $totalValue = $_POST["totalValue"];

    // Atualize os campos de informações no banco de dados conforme necessário
    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlUpdate = "UPDATE car_informations SET 
        customer_name = '$customerName',
        carCPF = '$carCPF',
        email = '$email',
        service_type = '$serviceType',
        car_name = '$carName',
        car_plate = '$carPlate',
        car_mileage = '$carMileage',
        today_day = '$todayDay',
        pick_up_Day = '$pickUpDay',
        total_value = '$totalValue'
        WHERE id_car = $carId";

    if ($conn->query($sqlUpdate) === TRUE) {
        // Responda ao cliente (pode ser necessário ajustar conforme a estrutura do seu aplicativo)
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));

        // Chame a atualização de imagens
        $updateImagesUrl = 'update_car_images.php';
        $updateImagesData = array('carId' => $carId);
        
        $updateImagesOptions = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($updateImagesData),
            ),
        );

        $updateImagesContext  = stream_context_create($updateImagesOptions);
        file_get_contents($updateImagesUrl, false, $updateImagesContext);
    } else {
        // Se a atualização das informações falhar, responda com erro
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Error updating information.'));
    }

    $conn->close();
} else {
    // Se a solicitação não for POST, responda com erro
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request method.'));
}
?>

