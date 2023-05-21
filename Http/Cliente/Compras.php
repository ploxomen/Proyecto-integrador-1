<?php
use Controllers\Bodega\Producto;
use Controllers\Cliente\Compras;

require_once '../../Controllers/Bodega/Producto.php';
require_once '../../Controllers/Cliente/Compras.php';

$cProducto = new Producto;
$cCompras = new Compras;

switch ($_POST['accion']) {
    case 'consultar-producto':
        $response = $cProducto->obtenerProductosCliente($_POST);
        echo json_encode($response);
    break;
    case 'agregar-carrito':
        $response = $cCompras->agregarCarrito($_POST['producto'],$_POST['cantidad']);
        echo json_encode($response);
    break;
    case 'modificar-carrito':
        $response = $cCompras->modificarCarritoCantidad($_POST['producto'],$_POST['cantidad']);
        echo json_encode($response);
    break;
    case 'eliminar-producto-carrito':
        $response = $cCompras->eliminarCarritoCompas($_POST['producto']);
        echo json_encode($response);
    break;
    case 'eliminar-total-carrito':
        $response = $cCompras->aliminarTotalCarrito();
        echo json_encode($response);
    break;
    case 'verificar-autenticacion':
        $response = $cCompras->verificarAutenticacionCompra();
        echo json_encode($response);
    break;
}

?>