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

        $sql = "SELECT * FROM car_informations WHERE id_car = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $requestData['carId']); // Assuming id_car is an integer
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $record = $result->fetch_assoc();

            // Verifica se há dados antes de enviar a resposta JSON
            if (!empty($record)) {
                // Manipulação de imagens
                $imageKeys = array('car_image_1', 'car_image_2', 'car_image_3', 'car_image_4');
                foreach ($imageKeys as $imageKey) {
                    if (!empty($record[$imageKey])) {
                        $record[$imageKey] = base64_encode($record[$imageKey]); // Convertendo para base64
                    }
                }

                header('Content-Type: application/json');
                echo json_encode($record);
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('error' => 'No data found for the provided Car ID.'));
            }
        } else {
            // Se nenhum dado for encontrado para o ID do carro fornecido
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'No data found for the provided Car ID.'));
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        // Em caso de erro, envie uma resposta JSON com a mensagem de erro
        $errorMessage = "Error in view_information_handler.php: " . $e->getMessage();
        error_log($errorMessage);

        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Error fetching details. Please try again later.'));
    }
} else {
    // Se o ID do carro não for fornecido corretamente na solicitação
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid request.'));
}
?>

