<?php
namespace Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/MarcaModel.php';

use Models\Usuario as ModelUsuario;
use Models\Categoria as CategoriaModel;
use Models\Marca as MarcaModel;

class PaginaPrincipal{
    public function indexHome()
    {
        $usuarioModel = new ModelUsuario();
        $categoriaModel = new CategoriaModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        $listaCategorias = $categoriaModel->mostrar();
        include("views/principal.php");
    }
    public function indexVerProductos()
    {
        $categoriaModel = new CategoriaModel();
        $marcaModel = new MarcaModel();
        $categorias = $categoriaModel->obtenerCategoriasProductos();
        $marcas = $marcaModel->obtenerMarcasProductos();
        // echo "a";
        include("views/productos.php");
    }
}

?>