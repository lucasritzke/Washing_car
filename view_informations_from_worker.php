<?php
$requestData = json_decode(file_get_contents('php://input'), true);

if (isset($requestData['id'])) {
    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    try {
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $id = intval($requestData['id']);

        $sql = "SELECT id, name, birthdate, sex, cpf, edit_informations, search_informations, create_new_jobs, add_workers, remove_workers, edit_workers FROM workers WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Aqui você pode processar os dados conforme necessário

            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'No details found for the provided ID.'));
        }

        $stmt->close();
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

