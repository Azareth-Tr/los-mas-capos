<?php
require_once __DIR__ . "/../models/salario_promedio.php";
include_once __DIR__ . "/../views/header.php";

$modelo = new SalarioPromedio();
$salarios = $modelo->obtenerSalarioPromedioPorDepartamento();

require __DIR__ . "/../views/salario_promedio/index.php";
include_once __DIR__ . "/../views/footer.php";
