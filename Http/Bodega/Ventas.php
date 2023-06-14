<?php
use Controllers\Bodega\Venta;
require_once '../../Controllers/Bodega/Venta.php';
$cVentas = new Venta;
switch ($_POST['accion']) {
    case 'ver-cliente':
        $response = $cVentas->verInformacionCliente($_POST['cliente']);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'ver-producto':
        $response = $cVentas->verInformacionProducto($_POST['producto']);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'vericar-productos':
        $response = $cVentas->verificarProductosStock(json_decode($_POST['productos'],true));
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'agregar-venta':
        $response = $cVentas->agregarVentasBodega($_POST);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'ver-ventas':
        $response = $cVentas->obtenerDatosVentasBodega($_POST['finicio'],$_POST['ffin']);
        echo json_encode($response);
    break;
    case 'eliminar-venta':
        // $response = $cVentas->eliminarProducto($_POST['idProducto']);
        // echo json_encode($response);
    break;
}

?>