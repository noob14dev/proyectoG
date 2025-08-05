
<?php
// Asegurarse de que la conexión a la base de datos esté establecida
// include_once '../config.php';
require_once '../config.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los nombres de las columnas de la tabla
$sql_columnas = "SHOW COLUMNS FROM res_encuesta_resultados_vf";
$resultado_columnas = $conexion->query($sql_columnas);

if ($resultado_columnas) {
    echo "<h3>Columnas de la tabla res_encuesta_resultados_vf:</h3>";
    echo "<ul>";
    while ($columna = $resultado_columnas->fetch_assoc()) {
        echo "<li>" . $columna['Field'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Error al obtener las columnas: " . $conexion->error;
}

// Resto del código...
?>
