<?php
//Establecemos el nombre de espacio donde se trabaja
namespace Controllers\Bodega;
//Requerimos los archivos necesarios para el funcionamiento
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/BodegaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';

//Usamos las clases y lo renombramos

use Models\Categoria as CategoriaModel;
use Models\Usuario as UsuarioModel;
use Models\Bodega as BodegaModel;
use Models\Producto as ProductoModel;

class Dashboard {

    public function obtenerProductosMasVendidos(string $fechaInicio,string $fechaFin)
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $productoModel = new ProductoModel();
        $productoModel->setIdBodega($data['idAccesoRol']);
        return $productoModel->obtenerProductosDashboard($fechaInicio,$fechaFin);
    }
    public function obtenerProductosMasCategoria(string $fechaInicio, string $fechaFin)
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $categoriaModel = new CategoriaModel();
        return $categoriaModel->obtenerProductosCategoriaDashboard($fechaInicio,$fechaFin,$data['idAccesoRol']);
    }
    public function obtenerRanking(string $fechaInicio,string $fechaFin) : array
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $bodegaModel = new BodegaModel();
        return $bodegaModel->rankingDashboard($fechaInicio,$fechaFin);
    }
    public function obtenerVentas($fechaInicio,$fechaFin)
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $productoModel = new ProductoModel();
        $productoModel->setIdBodega($data['idAccesoRol']);
        return $productoModel->obtenerVentasYearDashboard($fechaInicio,$fechaFin);
    }
}

?>