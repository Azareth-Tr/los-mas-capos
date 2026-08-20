<?php
require_once __DIR__ . "/../models/consulta_empleados.php";
include_once __DIR__ . "/../views/header.php";

$modelo = new ConsultaEmpleados();

$termino = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
$empNo = isset($_GET['emp_no']) ? (int) $_GET['emp_no'] : null;

$resultados = [];
$detalle = null;

if ($empNo) {
    $detalle = $modelo->obtenerDetalleEmpleado($empNo);
} elseif ($termino !== '') {
    $resultados = $modelo->buscarEmpleados($termino);
    // Si la búsqueda arrojó un único resultado, se muestra su detalle directamente
    if (count($resultados) === 1) {
        $detalle = $modelo->obtenerDetalleEmpleado($resultados[0]['emp_no']);
    }
}

require __DIR__ . "/../views/consulta_empleados/index.php";
include_once __DIR__ . "/../views/footer.php";
