<?php
namespace Controllers\Administrador;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';

use Models\Categoria as CategoriaModel;

class Categorias {
    public function indexCategorias()
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/Administrador/categorias.php");
    }
    public function obtenerCategorias()
    {
        $categoriaModel = new CategoriaModel();
        return ['data' => $categoriaModel->mostrar()];
    }

    public function agregarCategoria(array $datos)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->setNombre($datos['nombre_categoria']);
        return $categoriaModel->agregar();
    }

    public function eliminarCategoria(int $id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->setId($id);
        return $categoriaModel->eliminar();
    }
    
}
