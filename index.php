<?php
    require_once("autoload.php");
    require_once("Router.php");
    $router = new Router();
    $router->add("/", "Controllers\PaginaPrincipal@indexHome");
    $router->add("/login", "Controllers\Login@indexLogin");
    $router->add("/intranet/agregar-producto", "Controllers\Bodega\Producto@indexAdminProducto");
    $router->add("/intranet/mis-productos", "Controllers\Bodega\Producto@indexAdminMisProductos");
    $router->run();
?>