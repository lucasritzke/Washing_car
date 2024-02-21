<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"), true);
    $carId = $requestData['carId'];

    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT customer_name, carCPF, email, service_type, car_name, car_plate, car_mileage, today_day, pick_up_day, total_value 
            FROM car_informations
            WHERE id_car = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $result = $stmt->get_result();
    $carDetails = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode(['data' => $carDetails]);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>

