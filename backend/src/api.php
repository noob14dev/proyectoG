<?php
include '../config.php';

header('Content-Type: application/json');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($connection->connect_error) {
    die(json_encode(["error" => $connection->connect_error]));
}

$query = "SELECT * FROM your_table"; // Cambia esto por tu consulta
$result = $connection->query($query);
$data = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($data);
?>
