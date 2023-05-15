<?php
namespace Controllers\Bodega;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/MarcaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';

use Models\Producto as ProductoModel;
use Models\Marca as MarcaModel;
use Models\Categoria as CategoriaModel;

class Producto {
    public function indexAdminProducto()
    {
        $marcaModel = new MarcaModel();
        $categoriaModel = new CategoriaModel();
        $listaMarcas = $marcaModel->mostrar();
        $listaCategorias = $categoriaModel->mostrar();
        require_once("views/Bodega/agregarProductos.php");
    }
    public function indexAdminMisProductos()
    {
        $marcaModel = new MarcaModel();
        $categoriaModel = new CategoriaModel();
        $listaMarcas = $marcaModel->mostrar();
        $listaCategorias = $categoriaModel->mostrar();
        require_once("views/Bodega/misProductos.php");
    }
    public function mostrarProductos()
    {
        $modelProducto = new ProductoModel();
        return ['data' => $modelProducto->mostrar()];
    }
    public function eliminarProducto(int $idProducto)
    {
        $modelProducto = new ProductoModel();
        $modelProducto->setId($idProducto);
        $modelProducto->setIdBodega(1);
        return $modelProducto->eliminar();
    }
    public function agregarProducto(array $datos)
    {
        $modelProducto = new ProductoModel();
        $modelProducto->setNombre($datos['nombre']);
        $modelProducto->setIdBodega(1);
        $modelProducto->setImg('aas');
        $modelProducto->setDescripcion($datos['descripcion']);
        $modelProducto->setIdMarca(intval($datos['marca']));
        $modelProducto->setPrecioCompra(floatval($datos['precioCompra']));
        $modelProducto->setPrecioVenta(floatval($datos['precioVenta']));
        $modelProducto->setStock(floatval($datos['stock']));
        $modelProducto->setStockMinimo(floatval($datos['stockMinimo']));
        $modelProducto->setDescuento(floatval($datos['descuento']));
        $categorias = [];
        foreach ($_POST['categoria'] as $cat) {
            $categorias[] = ['categoria' => $cat];
        }
        $modelProducto->setIdCategoriasJson(json_encode($categorias));
        return $modelProducto->agregar();
    }
}

?>