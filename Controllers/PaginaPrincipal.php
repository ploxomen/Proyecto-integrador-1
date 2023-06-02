<?php
//AUTOR: JEAN PIER CARRASCO
//le damos un nombre de espacio
namespace Controllers;
//requerimos los modelos
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/MarcaModel.php';
//usamos los modelos
use Models\Usuario as ModelUsuario;
use Models\Categoria as CategoriaModel;
use Models\Marca as MarcaModel;
//creamos la clase
class PaginaPrincipal{
    //cramos la funcion
    public function indexHome()
    {
        //instanciamos el modelo usuario
        $usuarioModel = new ModelUsuario();
        //instanciamos el modelo categoria
        $categoriaModel = new CategoriaModel();
        //obtenemos los datos a traves de sus metodo 
        $data = $usuarioModel->obtenerDatosAutenticado();
        $listaCategorias = $categoriaModel->mostrar();
        //mostramos la vista principal
        include("views/principal.php");
    }
    //cramos la funcion
    public function indexVerProductos()
    {
        //instanciamos el modelo categoria
        $categoriaModel = new CategoriaModel();
        //instanciamos el modelo marca
        $marcaModel = new MarcaModel();
        //obtenemos los datos a traves de sus metodo 
        $categorias = $categoriaModel->obtenerCategoriasProductos();
        $marcas = $marcaModel->obtenerMarcasProductos();
        //mostramos la vista de los productos
        include("views/productos.php");
    }
}

?>