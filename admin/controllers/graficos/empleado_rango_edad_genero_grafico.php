<?php
require_once __DIR__ . "/../../models/empleado_rango_edad_genero.php";
include_once __DIR__ . "/../../views/header.php";

$modelo = new EmpleadoRangoEdadGenero();

$fechaReferencia = isset($_GET['fecha_referencia']) && $_GET['fecha_referencia'] !== ''
    ? $_GET['fecha_referencia']
    : date('Y-m-d');

$distribucion = $modelo->obtenerDistribucionPorEdadYGenero($fechaReferencia);

require __DIR__ . "/../../views/graficos/empleado_rango_edad_genero_grafico/index.php";
include_once __DIR__ . "/../../views/footer.php";
