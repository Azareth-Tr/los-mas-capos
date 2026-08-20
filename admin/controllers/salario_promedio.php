<?php
require_once __DIR__ . "/../models/departamento.php";

$app = new Departamento();
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

include_once __DIR__ . "/../views/header.php";

switch ($accion) {
    case 'leer':
    default:
        $promedios = $app->promedioDepartamentos();
        require __DIR__ . "/../views/salario_promedio/index.php";
}


require __DIR__ . "/../views/footer.php";