<?php

use Controllers\Administrador\Categorias;

require_once '../../Controllers/Administrador/Categorias.php';
$cCategoria = new Categorias;
switch ($_POST['accion']) {
    case 'agregar-categoria':
        $response = $cCategoria->agregarCategoria($_POST);
        echo json_encode($response);
        break;
    case 'ver-categorias':
        $response = $cCategoria->obtenerCategorias();
        echo json_encode($response);
        break;
    case 'eliminar-categoria':
        $response = $cCategoria->eliminarCategoria($_POST["idCategoria"]);
        echo json_encode($response);
        break;
}
