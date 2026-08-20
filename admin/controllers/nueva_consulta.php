<?php
require_once __DIR__ . "/../models/empleado.php";

$app = new Empleado();
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

include_once __DIR__ . "/../views/header.php";

switch ($accion) {
    case 'leer':
    default:
        $empleados = $app->obtenerEmpleadosConTitulosYSalario();
        require __DIR__ . "/../views/nueva_consulta/index.php";
}

include_once __DIR__ . "/../views/footer.php";