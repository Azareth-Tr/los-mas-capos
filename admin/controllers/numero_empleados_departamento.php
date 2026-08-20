<?php
require_once __DIR__ . "/../models/departamento.php";

$app = new Departamento();
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

include_once __DIR__ . "/../views/header.php";

switch ($accion) {
    case 'leer':
    default:
        $departamentos = $app->obtenerNumeroEmpleadosPorDepartamento();
        require __DIR__ . "/../views/numero_empleados_departamento/index.php";
}
include_once __DIR__ . "/../views/footer.php";
