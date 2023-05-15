<?php
use Controllers\Administrador\Marcas;
require_once '../../Controllers/Administrador/Marcas.php';
$cMarcas = new Marcas;
switch ($_POST['accion']) {
    case 'agregar-marca':
        $response = $cMarcas->agregarMarca($_POST);
        echo json_encode($response);
    break;
    case 'ver-marcas':
        $response = $cMarcas->obtenerMarca();
        echo json_encode($response);
    break;
    case 'eliminar-marca':
        $response = $cMarcas->eliminarMarca($_POST["idMarca"]);
        echo json_encode($response);
    break;
    
}
