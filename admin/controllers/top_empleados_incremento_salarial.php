<?php
require_once __DIR__ . '/../sistema.class.php';
require_once __DIR__ . '/../models/top_empleados_incremento_salarial.php';

$app = new TopEmpleadosIncrementoSalarial();

$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

include_once __DIR__ . '/../views/header.php';

switch ($accion) {
    case 'leer':
    default:
        $topEmpleados = $app->leer();
        require __DIR__ . '/../views/top_empleados_incremento_salarial/index.php';
}

include_once __DIR__ . '/../views/footer.php';
