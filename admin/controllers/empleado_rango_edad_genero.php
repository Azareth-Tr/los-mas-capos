<?php
require_once(__DIR__ . '/../models/empleado_rango_edad_genero.php');
include_once __DIR__ . "/../views/header.php";


$app = new Empleado_Rango_Edad_Genero();
$referenceDate = $_GET['reference_date'] ?? date('Y-m-d');
$parsedDate = DateTime::createFromFormat('!Y-m-d', $referenceDate);
if (!$parsedDate || $parsedDate->format('Y-m-d') !== $referenceDate) {
	$referenceDate = date('Y-m-d');
}

$gender = $_GET['gender'] ?? '';
if (!in_array($gender, array('M', 'F'), true)) {
	$gender = '';
}

$resultados = $app->read($referenceDate, $gender);
$rangos = array('<30', '30-39', '40-49', '50-59', '>=60');
$generos = $gender === '' ? array('M', 'F') : array($gender);
$totales = array();

foreach ($rangos as $rango) {
	foreach ($generos as $genero) {
		$totales[$rango][$genero] = 0;
	}
}

foreach ($resultados as $resultado) {
	$totales[$resultado['age_range']][$resultado['gender']] = (int) $resultado['total_employees'];
}

$empleados = array();
foreach ($rangos as $rango) {
	foreach ($generos as $genero) {
		$empleados[] = array(
			'age_range' => $rango,
			'gender' => $genero,
			'total_employees' => $totales[$rango][$genero]
		);
	}
}

$totalEmpleados = array_sum(array_column($resultados, 'total_employees'));
include_once(__DIR__ . "/../views/empleado_rango_edad_genero/index.php");