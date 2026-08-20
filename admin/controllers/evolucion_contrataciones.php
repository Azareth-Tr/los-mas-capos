<?php
require_once __DIR__ . '/../sistema.class.php';
require_once __DIR__ . '/../models/evolucion_contratacion.php';

$app = new EvolucionContratacion();

$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

include_once __DIR__ . '/../views/header.php';

switch ($accion) {
    case 'leer':
    default:
        $evolucion = $app->leer();
        require __DIR__ . '/../views/evolucion_contratacion/index.php';
}

include_once __DIR__ . '/../views/footer.php';

