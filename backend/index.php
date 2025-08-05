<?php
header('Content-Type: application/json');

// Importa la configuración de conexión
require_once 'config.php';

// Simple prueba de respuesta
echo json_encode([
    'status' => 'success',
    'message' => 'Conexión exitosa a la base de datos',
    'database' => getenv('MYSQL_DATABASE')
]);
