<?php
require_once __DIR__ . "/../../models/departamento.php";

$app = new Departamento();
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

if ($accion === 'json') {
    header('Content-Type: application/json');
    $resultado = $app->obtenerNumeroEmpleadosPorDepartamento();

    $labels = [];
    $data = [];

    foreach ($resultado as $fila) {
        $labels[] = $fila['departamento'];
        $data[] = (int)$fila['total_empleados'];
    }

    echo json_encode([
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Empleados',
                'data' => $data
            ]
        ]
    ]);
    exit;
}

include_once __DIR__ . "/../../views/header.php";
require __DIR__ . "/../../views/graficos/numero_empleados_departamento_grafico/index.php";
include_once __DIR__ . "/../../views/footer.php";