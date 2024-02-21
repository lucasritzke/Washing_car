<?php
$requestData = json_decode(file_get_contents('php://input'), true);

if (isset($requestData['carId'])) {
    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    try {
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $carId = intval($requestData['carId']);

        $sql = "SELECT customer_name, carCPF, email, service_type, car_name, car_plate, car_mileage, today_day, pick_up_Day, total_value,
                car_image_1, car_image_2, car_image_3, car_image_4
                FROM car_informations WHERE id_car = $carId";
        $result = $conn->query($sql);

        if ($result) {
            $record = $result->fetch_assoc();

            // Encode image fields
            for ($i = 1; $i <= 4; $i++) {
                $imageFieldName = "car_image_$i";
                if (!empty($record[$imageFieldName])) {
                    $record[$imageFieldName] = base64_encode($record[$imageFieldName]);
                }
            }

            header('Content-Type: application/json');
            echo json_encode($record);
        } else {
            // If no data is found for the provided Car ID
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'No data found for the provided Car ID.'));
        }

        $conn->close();
    } catch (Exception $e) {
        $errorMessage = "Error in view_information_handler_edit.php: " . $e->getMessage();
        error_log($errorMessage);

        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Error fetching details. Please try again later.'));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request.'));
}
?>

