<?php
// controlador/evolucion_contratacion_grafico.php
require_once __DIR__ . '/../../sistema.class.php';
require_once __DIR__ . '/../../models/evolucion_contratacion.php';

$app = new EvolucionContratacion();

$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

if ($accion === 'json') {
    header('Content-Type: application/json');
    $evolucion = $app->leer();

    $anios = [];
    foreach ($evolucion as $fila) {
        if (!in_array($fila['anio'], $anios)) {
            $anios[] = $fila['anio'];
        }
    }
    sort($anios);

    $porGenero = ['M' => [], 'F' => []];
    foreach ($anios as $anio) {
        $porGenero['M'][$anio] = 0;
        $porGenero['F'][$anio] = 0;
    }
    foreach ($evolucion as $fila) {
        $porGenero[$fila['genero']][$fila['anio']] = (int)$fila['total_contrataciones'];
    }

    echo json_encode([
        'labels' => $anios,
        'datasets' => [
            ['label' => 'Hombres', 'data' => array_values($porGenero['M'])],
            ['label' => 'Mujeres', 'data' => array_values($porGenero['F'])]
        ]
    ]);
    exit;
}

// Si no viene ?accion=json, muestra la página normal con el canvas
include_once __DIR__ . '/../../views/header.php';
require __DIR__ . '/../../views/graficos/evolucion_contrataciones_grafico/index.php';
include_once __DIR__ . '/../../views/footer.php';
