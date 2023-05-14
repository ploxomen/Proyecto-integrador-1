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
        require_once("views/agregarProductos.php");
    }
    public function indexAdminMisProductos()
    {
        $marcaModel = new MarcaModel();
        $categoriaModel = new CategoriaModel();
        $listaMarcas = $marcaModel->mostrar();
        $listaCategorias = $categoriaModel->mostrar();
        require_once("views/misProductos.php");
    }
    public function mostrarProductos()
    {
        $modelProdcuto = new ProductoModel();
        return ['data' => $modelProdcuto->mostrar()];
    }
    public function agregarProducto(array $datos)
    {
        $modelProdcuto = new ProductoModel();
        $modelProdcuto->setNombre($datos['nombre']);
        $modelProdcuto->setIdBodega(1);
        $modelProdcuto->setImg('aas');
        $modelProdcuto->setDescripcion($datos['descripcion']);
        $modelProdcuto->setIdMarca(intval($datos['marca']));
        $modelProdcuto->setPrecioCompra(floatval($datos['precioCompra']));
        $modelProdcuto->setPrecioVenta(floatval($datos['precioVenta']));
        $modelProdcuto->setStock(floatval($datos['stock']));
        $modelProdcuto->setStockMinimo(floatval($datos['stockMinimo']));
        $modelProdcuto->setDescuento(floatval($datos['descuento']));
        $categorias = [];
        foreach ($_POST['categoria'] as $cat) {
            $categorias[] = ['categoria' => $cat];
        }
        $modelProdcuto->setIdCategoriasJson(json_encode($categorias));
        return $modelProdcuto->agregar();
    }
}

?>