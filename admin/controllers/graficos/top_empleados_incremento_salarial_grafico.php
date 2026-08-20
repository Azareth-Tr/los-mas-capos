<?php
require_once __DIR__ . '/../../models/top_empleados_incremento_salarial.php';

$app = new TopEmpleadosIncrementoSalarial();

$accion = isset($_GET['accion']) ? $_GET['accion'] : null;
$cantidad = isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : 10;

if ($accion === 'json') {
    header('Content-Type: application/json');
    $datos = $app->leer($cantidad);

    $puntos = [];
    foreach ($datos as $fila) {
        $puntos[] = [
            'nombre' => $fila['empleado'],
            'incremento' => (float)$fila['porcentaje_incremento'],
            'salario_min' => (float)$fila['salario_minimo'],
            'salario_max' => (float)$fila['salario_maximo'],
            'anios' => (int)$fila['anios_carrera']
        ];
    }

    echo json_encode(['puntos' => $puntos]);
    exit;
}

include_once __DIR__ . '/../../views/header.php';
require __DIR__ . '/../../views/graficos/top_empleados_incremento_salarial_grafico/index.php';
include_once __DIR__ . '/../../views/footer.php';