<?php
require_once __DIR__ . "/../models/numero_empleados_departamento.php";
include_once __DIR__ . "/../views/header.php";

$modelo = new NumeroEmpleadosDepartamento();
$departamentos = $modelo->obtenerEmpleadosPorDepartamento();

require __DIR__ . "/../views/numero_empleados_departamento/index.php";
include_once __DIR__ . "/../views/footer.php";
