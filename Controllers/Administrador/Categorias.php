<?php
namespace Controllers\Administrador;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';

use Models\Categoria as CategoriaModel;
use Models\Usuario as UsuarioModel;

class Categorias {
    public function indexCategorias()
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            header("location: /login");
            die();
        }
        if (!in_array($data['rol'], [$usuarioModel->rolAdministrador])) {
            header("location: /intranet/inicio");
            die();
        }
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
