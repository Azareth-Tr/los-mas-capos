<?php
require_once __DIR__ . "/../models/empleado.php";
include_once __DIR__ . "/../views/header.php";

$app = new Empleado();
$empleados = $app->obtenerEmpleadosConTitulosYSalario();

require __DIR__ . "/../views/nueva_consulta/index.php";
