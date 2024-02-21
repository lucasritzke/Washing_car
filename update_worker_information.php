<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $customerName = $_POST["customerName"];
    $CPF = $_POST["CPF"];
    $birthdate = $_POST["birthdate"];
    $sex = $_POST["sex"];
    $edit_informations = $_POST["edit_informations"];
    $search_informations = $_POST["search_informations"];
    $create_new_jobs = $_POST["create_new_jobs"];
    $add_workers = $_POST["add_workers"];
    $remove_workers = $_POST["remove_workers"];
    $edit_workers = $_POST["edit_workers"];

    // Atualize os campos de informações no banco de dados conforme necessário
    $servername = "mysql-server";
    $username = "root";
    $password = "lritzke";
    $database = "washing_project";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlUpdate = "UPDATE workers SET 
        name = '$customerName',
        cpf = '$CPF',
        birthdate = '$birthdate',
        sex = '$sex',
        edit_informations = '$edit_informations',
        search_informations = '$search_informations',
        create_new_jobs = '$create_new_jobs',
        add_workers = '$add_workers',
        remove_workers = '$remove_workers',
        edit_workers = '$edit_workers'
        WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        // Responda ao cliente (pode ser necessário ajustar conforme a estrutura do seu aplicativo)
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
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

