<?php
use Controllers\Bodega\Producto;
use Controllers\Cliente\Compras;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/culqi/culqi-php/lib/culqi.php';

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
        $response = $cCompras->agregarCarrito($_POST['producto'],$_POST['cantidad'],$_POST['nombre']);
        echo json_encode($response);
    break;
    case 'modificar-carrito':
        $response = $cCompras->modificarCarritoCantidad($_POST['producto'],$_POST['cantidad'],$_POST['nombre']);
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
    case 'verificar-productos':
        $response = $cCompras->verificarCompra();
        echo json_encode($response);
    break;
    case 'generar-compra':
        $response = $cCompras->agregarCompraCliente($_POST);
        $resultado = ['error' => 'Error al generar la compra'];
        if(isset($response['success'])){
            $cCompras->aliminarTotalCarrito();
            $resultado = ['success' => 'Comprar generada con éxito'];
        }
        echo json_encode($resultado);
    break;
}

?>