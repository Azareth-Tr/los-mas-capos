<?php
require_once __DIR__ . '/models/evolucion_contratacion.php';

$app = new EvolucionContratacion();
$evolucion = $app->leer();

include __DIR__ . "/views/header.php";
include __DIR__ . "/views/evolucion_contratacion/index.php"; 
include __DIR__ . "/views/footer.php";
?>

    