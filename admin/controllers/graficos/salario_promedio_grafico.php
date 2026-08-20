<?php
require_once __DIR__ . '/../../models/departamento.php';

$app = new Departamento();
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

if ($accion === 'json') {
    header('Content-Type: application/json');
    $promedios = $app->promedioDepartamentos();

    $departamentos = [];
    $salarios = [];
    foreach ($promedios as $fila) {
        $departamentos[] = $fila['departamento'];
        $salarios[] = round((float)$fila['salario_promedio'], 2);
    }

    echo json_encode([
        'labels' => $departamentos,
        'datasets' => [
            [
                'label' => 'Salario Promedio',
                'data' => $salarios
            ]
        ]
    ]);
    exit;
}

include_once __DIR__ . '/../../views/header.php';
require __DIR__ . '/../../views/graficos/salario_promedio_grafico/index.php';
include_once __DIR__ . '/../../views/footer.php';
