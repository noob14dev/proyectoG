<?php
// Incluir el archivo de configuración
include_once '../config.php';

// Establecer conexión con la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conexion->connect_error]));
}

// Establecer el conjunto de caracteres a utf8mb4
$conexion->set_charset("utf8mb4");

// Consulta para obtener el código y la descripción de res_resultados_de_aprendizaje
$consulta = "SELECT codigo, descripcion FROM res_resultados_de_aprendizaje";

// Ejecutar la consulta
$resultado = $conexion->query($consulta);

// Asegurarse de que se impriman los datos como JSON
header('Content-Type: application/json');

if ($resultado) {
    $datos = $resultado->fetch_all(MYSQLI_ASSOC);
    
    if (!empty($datos)) {
        // Codificar los datos a JSON
        $json_datos = json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
        if ($json_datos === false) {
            // Error en la codificación JSON
            echo json_encode(["error" => "Error al codificar los datos: " . json_last_error_msg()]);
        } else {
            // Imprimir los datos codificados
            echo $json_datos;
        }
    } else {
        // No hay datos para imprimir
        echo json_encode(["mensaje" => "No se encontraron resultados"]);
    }
} else {
    echo json_encode(["error" => "Error al obtener los datos: " . $conexion->error]);
}

// Agregar registro de errores
error_log("Consulta ejecutada: " . $consulta);
error_log("Número de filas devueltas: " . ($resultado ? $resultado->num_rows : 0));

// Cerrar la conexión
$conexion->close();
?>
