<?php
use Controllers\Administrador\Bodegas;
require_once '../../Controllers/Administrador/Bodegas.php';
$cBodega = new Bodegas;
switch ($_POST['accion']) {
    case 'agregar-bodega':
        $response = $cBodega->agregarBodega($_POST);
        echo json_encode($response);
    break;
    case 'ver-bodegas':
        $response = $cBodega->obtenerBodegas();
        echo json_encode($response);
    break;
}
