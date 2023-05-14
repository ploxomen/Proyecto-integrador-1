<?php

namespace Controllers\Administrador;
// require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';

// use Models\Categoria as CategoriaModel;

class Bodegas
{
    public function indexBodegas()
    {
        // echo 'asss';
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/Administrador/bodegas.php");
    }
}
