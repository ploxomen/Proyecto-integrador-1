<?php
use Controllers\Bodega\Producto;
require_once '../../Controllers/Bodega/Producto.php';
$cProducto = new Producto;
switch ($_POST['acciones']) {
    case 'solicitar-stock':
        $response = $cProducto->obtenerProductoInformacion($_POST['producto']);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'editar-stock':
        $response = $cProducto->editarStockProductoHistorial($_POST['producto'],$_POST['precioVenta'],$_POST['stock'],$_POST['descuento']);
        echo json_encode($response);
    break;
    case 'ver-historial':
        $response = $cProducto->listaHistorialProducto($_POST['producto'] == "" ? 0 : $_POST['producto']);
        echo json_encode($response);
    break;
}

?>