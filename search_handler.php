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

        // Use prepared statement to prevent SQL injection
        $sql = "SELECT id_car, customer_name, today_day, pick_up_Day, total_value FROM car_informations WHERE UPPER(CPF) = ? OR UPPER(email) = ?";
        $stmt = $conn->prepare($sql);

        // Convert search input to uppercase for case-insensitive comparison
        $searchInputUpper = strtoupper($searchInput);

        $stmt->bind_param("ss", $searchInputUpper, $searchInputUpper);

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

        // Sending JSON response to the frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $rows]);
        exit(); // Terminate the script after sending JSON
    } catch (Exception $e) {
        die("Error: " . $e->getMessage() . " on line " . $e->getLine());
    }
} else {
    echo json_encode(array('error' => 'Search input is empty.'));
    exit(); // Terminate the script after sending JSON
}
?>

