<?php

namespace Controllers\Administrador;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/MarcaModel.php';

use Models\Marca as MarcaModel;

class Marcas
{
    public function indexMarcas()
    {
        // echo 'asss';
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
