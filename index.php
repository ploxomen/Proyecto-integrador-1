<?php
require_once("autoload.php");
require_once("Router.php");
require_once("Config/config.php");
$router = new Router();
$router->add("/", "Controllers\PaginaPrincipal@indexHome");
$router->add("/listar/productos", "Controllers\PaginaPrincipal@indexVerProductos");
$router->add("/login", "Controllers\Login@indexLogin");
$router->add("/intranet/bodega/agregar-producto", "Controllers\Bodega\Producto@indexAdminProducto");
$router->add("/intranet/bodega/producto/historial", "Controllers\Bodega\Producto@indexHistorialProducto");
$router->add("/intranet/bodega/producto/histoarial", "Controllers\Bodega\Producto@indexHistorialProducto");

$router->add("/intranet/bodega/agregar-venta", "Controllers\Bodega\Venta@indexBodegaAgregarVenta");
$router->add("/intranet/bodega/reporte-ventas", "Controllers\Bodega\Venta@reporteVenta");
$router->add("/intranet/bodega/mis-productos", "Controllers\Bodega\Producto@indexAdminMisProductos");
$router->add("/intranet/bodega/mis-ventas", "Controllers\Bodega\Venta@indexBodegaMisVentas");
$router->add("/intranet/administrador/categorias", "Controllers\Administrador\Categorias@indexCategorias");
$router->add("/intranet/administrador/bodegas", "Controllers\Administrador\Bodegas@indexBodegas");
$router->add("/intranet/administrador/marcas", "Controllers\Administrador\Marcas@indexMarcas");
$router->add("/intranet/inicio", "Controllers\Login@inicioIntranet");
$router->add("/usuario/cerrar-sesion", "Controllers\Login@cerrarSesion");
$router->add("/carrito/compras", "Controllers\Cliente\Compras@indexCarritoCompras");
$router->add("/correo", "Controllers\Correo@configurarCorreo");

$router->run();
?>