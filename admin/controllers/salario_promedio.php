<?php
require_once __DIR__ . "/../models/departamento.php";
include_once __DIR__ . "/../views/header.php";

$app = new Departamento();
$promedios = $app->promedioDepartamentos();

/*
if (empty($promedios)) {
    require __DIR__ . "/../views/salario_promedio/promedio_vacio.php";
}
else{
    require __DIR__ . "/../views/salario_promedio/index.php";
}
*/

require __DIR__ . "/../views/salario_promedio/index.php";