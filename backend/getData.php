<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

require "config.php"; // conexión con $pdo

// Petición
$data = json_decode(file_get_contents("php://input"), true);
$periodicidad = $data['periodicidad'];   // "0"=semestres, "1"=anio-periodo
$proyecto     = $data['proyecto'];       // 578 o 678
$componentes  = $data['componentes'];    // ["1","2","3",...]

// Cargar mapa de preguntas->componente
$mapJson = json_decode(file_get_contents("componentes.json"), true);
$map = [];
foreach ($mapJson as $m) {
    $map[$m['codigo']] = $m['componente'];
}

// Query según periodicidad
if ($periodicidad == 0) {
    $query = "
        SELECT permanencia_en_semestres AS eje, num, AVG(valor) as promedio
        FROM res_encuesta_resultados_vf
        WHERE proyecto_curricular = ?
        GROUP BY permanencia_en_semestres, num
        ORDER BY permanencia_en_semestres
    ";
} else {
    $query = "
        SELECT CONCAT(ano, '-', periodo) AS eje, num, AVG(valor) as promedio
        FROM res_encuesta_resultados_vf
        WHERE proyecto_curricular = ?
        GROUP BY ano, periodo, num
        ORDER BY ano, periodo
    ";
}


$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $proyecto);
$stmt->execute();
$resultados = $stmt->get_result();

// 1️⃣ Agrupar preguntas por componente
$agrupados = [];
foreach ($resultados as $row) {
    $pregunta   = (string)$row['num'];
    $componente = $map[$pregunta] ?? null;

    if (!$componente) continue;
    if (!in_array((string)$componente, $componentes, true)) continue;

    $label = $row['eje'] . ($periodicidad == 0 ? " semestres" : "");
    $valor = (float)$row['promedio'];

    // acumular dentro del componente
    if (!isset($agrupados[$componente][$label])) {
        $agrupados[$componente][$label] = ["suma" => 0, "count" => 0];
    }

    $agrupados[$componente][$label]["suma"]  += $valor;
    $agrupados[$componente][$label]["count"] += 1;
}

// 2️⃣ Calcular promedio por componente
$series = [];
foreach ($agrupados as $comp => $labels) {
    $dataPoints = [];
    foreach ($labels as $label => $info) {
        $prom = round($info["suma"] / $info["count"], 2);
        $dataPoints[] = [
            "name"  => $label,
            "value" => $prom
        ];
    }
    $series[] = [
        "name" => "Componente $comp",
        "data" => $dataPoints
    ];
}

// Respuesta JSON
echo json_encode(["series" => $series]);