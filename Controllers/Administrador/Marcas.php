<?php

namespace Controllers\Administrador;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/MarcaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';

use Models\Marca as MarcaModel;
use Models\Usuario as UsuarioModel;

class Marcas
{
    public function indexMarcas()
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
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/Administrador/marcas.php");
    }
    public function obtenerMarca()
    {
        $modelMarcas = new MarcaModel();
        return ['data' => $modelMarcas->mostrar()];
    }

    public function agregarMarca(array $datos)
    {
        $modelMarcas = new MarcaModel();
        $modelMarcas->setNombre($datos['nombre_marcas']);
        return $modelMarcas->agregar();
    }

    public function eliminarMarca(int $id)
    {
        $modelMarcas = new MarcaModel();
        $modelMarcas->setId($id);
        return $modelMarcas->eliminar();
    }

}
