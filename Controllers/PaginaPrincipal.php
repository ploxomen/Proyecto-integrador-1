<?php
namespace Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';

use Models\Usuario as ModelUsuario;
use Models\Categoria as CategoriaModel;

class PaginaPrincipal{
    public function indexHome()
    {
        $usuarioModel = new ModelUsuario();
        $categoriaModel = new CategoriaModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        $listaCategorias = $categoriaModel->mostrar();
        include("views/principal.php");
    }
}

?>