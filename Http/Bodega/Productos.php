<?php
use Controllers\Bodega\Producto;
require_once '../../Controllers/Bodega/Producto.php';
$cProducto = new Producto;
switch ($_POST['accion']) {
    case 'agregar-producto':
        $response = $cProducto->agregarProducto($_POST);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'ver-productos':
        $response = $cProducto->mostrarProductos();
        echo json_encode($response);
    break;
    case 'eliminar-producto':
        $response = $cProducto->eliminarProducto($_POST['idProducto']);
        echo json_encode($response);
    break;
}

?>