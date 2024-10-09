<?php
include '../config.php';

// Establecer conexión con la base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener todas las tablas de la base de datos
$consulta = "SHOW TABLES";
$resultado = $conexion->query($consulta);

if ($resultado) {
    echo "<h1>Tablas en la base de datos:</h1>";
    echo "<ul>";
    while ($fila = $resultado->fetch_row()) {
        $nombreTabla = $fila[0];
        echo "<li>$nombreTabla</li>";
        
        // Obtener y mostrar los datos de cada tabla
        $consultaDatos = "SELECT * FROM $nombreTabla";
        $resultadoDatos = $conexion->query($consultaDatos);
        
        if ($resultadoDatos && $resultadoDatos->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>";
            while ($campo = $resultadoDatos->fetch_field()) {
                echo "<th>" . $campo->name . "</th>";
            }
            echo "</tr>";
            
            while ($filaDatos = $resultadoDatos->fetch_assoc()) {
                echo "<tr>";
                foreach ($filaDatos as $valor) {
                    echo "<td>$valor</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";
        } else {
            echo "<p>No hay datos en esta tabla.</p>";
        }
    }
    echo "</ul>";
} else {
    echo "Error al obtener las tablas: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
