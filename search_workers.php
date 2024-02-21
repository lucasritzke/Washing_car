<?php
$searchInput = isset($_POST['searchInput']) ? trim($_POST['searchInput']) : '';

if (!empty($searchInput)) {
    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    try {
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, name, birthdate, sex, cpf, edit_informations, search_informations, create_new_jobs, add_workers, remove_workers, edit_workers FROM workers WHERE cpf = ?;";
        $stmt = $conn->prepare($sql);

        $searchInputUpper = strtoupper($searchInput);

        $stmt->bind_param("s", $searchInputUpper);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        $result = $stmt->get_result();

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode(['data' => $rows]);
        exit();
    } catch (Exception $e) {
        die("Error: " . $e->getMessage() . " on line " . $e->getLine());
    }
} else {
    echo json_encode(array('error' => 'Search input is empty.'));
    exit(); 
}
?>
