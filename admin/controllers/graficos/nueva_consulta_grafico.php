<?php
require_once __DIR__ . '/../../models/empleado.php';

$app = new Empleado();

$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

if ($accion === 'json') {
    header('Content-Type: application/json');
    $datos = $app->obtenerEmpleadosConTitulosYSalario();

    $salarios = array_map(fn($fila) => (float)$fila['salario'], $datos);

    $salarioMin = min($salarios);
    $salarioMax = max($salarios);

    $numBins = 6;
    $rango = $salarioMax - $salarioMin;
    $anchoBin = $rango > 0 ? $rango / $numBins : 1;

    $bins = [];
    $etiquetas = [];
    for ($i = 0; $i < $numBins; $i++) {
        $inicio = $salarioMin + ($i * $anchoBin);
        $fin = $inicio + $anchoBin;
        $bins[$i] = 0;
        $etiquetas[$i] = '$' . number_format($inicio, 0) . ' - $' . number_format($fin, 0);
    }

    foreach ($salarios as $salario) {
        $indice = ($anchoBin > 0)
            ? (int)floor(($salario - $salarioMin) / $anchoBin)
            : 0;
        if ($indice >= $numBins) {
            $indice = $numBins - 1;
        }
        $bins[$indice]++;
    }

    echo json_encode([
        'labels' => array_values($etiquetas),
        'valores' => array_values($bins),
        'total_empleados' => count($salarios)
    ]);
    exit;
}

include_once __DIR__ . '/../../views/header.php';
require __DIR__ . '/../../views/graficos/nueva_consulta_grafico/index.php';
include_once __DIR__ . '/../../views/footer.php';