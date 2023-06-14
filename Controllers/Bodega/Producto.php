<?php
//Establecemos el nombre de espacio donde se trabaja
namespace Controllers\Bodega;
//Requerimos los archivos necesarios para el funcionamiento
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/MarcaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/CategoriaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
//Usamos las clases y lo renombramos
use Models\Producto as ProductoModel;
use Models\Marca as MarcaModel;
use Models\Categoria as CategoriaModel;
use Models\Usuario as UsuarioModel;

//Definimos la clase Producto
class Producto {
    //Definimos el método el cual mostrará la vista de agregar producto
    public function indexAdminProducto()
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            header("location: /login");
            die();
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            header("location: /intranet/inicio");
            die();
        }
        //Instanciamos el modelo de la Marca
        $marcaModel = new MarcaModel();
        //Instanciamos el modelo de Categoría
        $categoriaModel = new CategoriaModel();
        //Llamamos al metodo para obtener los datos
        $listaMarcas = $marcaModel->mostrar();
        $listaCategorias = $categoriaModel->mostrar();
        //Requerimos la vista para que el usuario la visualice
        require_once("views/Bodega/agregarProductos.php");
    }
    //Definimos el método el cual mostrará la vista de los productos
    public function indexAdminMisProductos()
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            header("location: /login");
            die();
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            header("location: /intranet/inicio");
            die();
        }
        //Instanciamos el modelo de la Marca
        $marcaModel = new MarcaModel();
        //Instanciamos el modelo de Categoría
        $categoriaModel = new CategoriaModel();
        //Llamamos al metodo para obtener los datos
        $listaMarcas = $marcaModel->mostrar();
        $listaCategorias = $categoriaModel->mostrar();
        //Requerimos la vista para que el usuario la visualice
        require_once("views/Bodega/misProductos.php");
    }
    //Definimos el método el cual retornara los datos de los productos
    public function mostrarProductos()
    {
        //Instanciamos el modelo del Producto
        $modelProducto = new ProductoModel();
        //Retornamos en un arreglo los datos obtenidos
        return ['data' => $modelProducto->mostrar()];
    }
    //Definimos el método el cual eliminará un producto a través de su ID
    public function eliminarProducto(int $idProducto)
    {
        //Instanciamos el modelo del Producto
        $modelProducto = new ProductoModel();
        //Seteamos los atributos que son privados a traves de de las funciones (set)
        $modelProducto->setId($idProducto);
        $modelProducto->setIdBodega(1);
        //Llamamos a la funcion de eliminar
        $resultado = $modelProducto->eliminar();
        //Verificamos si se elimino de nuestra db
        if(isset($resultado['success'])){
            //Eliminamos la imagen
            unlink($_SERVER['DOCUMENT_ROOT'] . '/Public/img-productos/' . $resultado['url_img_anterior']);
        }
        //Retornamos el resultado
        return $resultado;
    }
    //Definimos el método para agregar un producto
    public function agregarProducto(array $datos)
    {
        //Instanciamos el modelo del Producto
        $modelProducto = new ProductoModel();
        //Instanciamos el modelo del Usuario
        $modelUsuario = new UsuarioModel();
        //Seteamos los atributos que son privados a traves de de las funciones (set)
        $modelProducto->setNombre($datos['nombre']);
        //Obtenemos el id de la bodega logeada
        $datosBodega = $modelUsuario->obtenerDatosAutenticado();
        if(empty($datosBodega)){
            return ['error' => 'No se encontró la bodega'];
        }
        $modelProducto->setIdBodega($datosBodega['idAccesoRol']);
        $modelProducto->setDescripcion($datos['descripcion']);
        $modelProducto->setIdMarca(intval($datos['marca']));
        $modelProducto->setPrecioCompra(floatval($datos['precioCompra']));
        $modelProducto->setPrecioVenta(floatval($datos['precioVenta']));
        $modelProducto->setStock(floatval($datos['stock']));
        $modelProducto->setStockMinimo(floatval($datos['stockMinimo']));
        $modelProducto->setDescuento(floatval($datos['descuento']));
        $categorias = [];
        //Recorremos y llenamos la categoria debido a que pueden ser mas de una
        foreach ($_POST['categoria'] as $cat) {
            $categorias[] = ['categoria' => $cat];
        }
        //Seteamos las categorias en formato JSON
        $modelProducto->setIdCategoriasJson(json_encode($categorias));
        //Verificamos si se ha subido una imagen
        if(isset($_FILES['img'])){
            //Nombramos la imagen
            $nombreImg = time() . '_' . basename($_FILES['img']['name']); 
            //Establecemos la ruta de la imagen
            $url = $_SERVER['DOCUMENT_ROOT'] . '/Public/img-productos/'. $nombreImg;
            //Subimos la imagen
            if(move_uploaded_file($_FILES['img']['tmp_name'],$url)){
                //Setemaos con la ruta de la imagen
                $modelProducto->setImg($nombreImg);
                //Llamaos al método agregar para registrar nuestro producto
                return $modelProducto->agregar();
            }
        }
        //Se retorna error en caso no haya imagen
        return ['error' => 'El producto debe contener una imagen de referencia'];
    }
    public function updateProducto(array $datos)
    {
        //Instanciamos el modelo del Producto
        $modelProducto = new ProductoModel();
        //Instanciamos el modelo del Usuario
        $modelUsuario = new UsuarioModel();
        //Seteamos los atributos que son privados a traves de de las funciones (set)
        $modelProducto->setNombre($datos['nombre']);
        //Obtenemos el id de la bodega logeada
        $datosBodega = $modelUsuario->obtenerDatosAutenticado();
        if (empty($datosBodega)) {
            return ['error' => 'No se encontró la bodega'];
        }
        $modelProducto->setIdBodega($datosBodega['idAccesoRol']);        
        $modelProducto->setId($datosBodega['idProducto']);
        $modelProducto->setIdBodega($datosBodega['id']);
        $modelProducto->setDescripcion($datos['descripcion']);
        $modelProducto->setIdMarca(intval($datos['marca']));
        $modelProducto->setPrecioCompra(floatval($datos['precioCompra']));
        $modelProducto->setPrecioVenta(floatval($datos['precioVenta']));
        $modelProducto->setStock(floatval($datos['stock']));
        $modelProducto->setStockMinimo(floatval($datos['stockMinimo']));
        $modelProducto->setDescuento(floatval($datos['descuento']));
        $categorias = [];
        //Recorremos y llenamos la categoria debido a que pueden ser mas de una
        foreach ($_POST['categoria'] as $cat) {
            $categorias[] = ['categoria' => $cat];
        }
        //Seteamos las categorias en formato JSON
        $modelProducto->setIdCategoriasJson(json_encode($categorias));
        //Verificamos si se ha subido una imagen
        if (isset($_FILES['img'])) {
            //Eliminamos la imagen anterior que se almacenó al momento de guardar
            unlink($_SERVER['DOCUMENT_ROOT'] . '/Public/img-productos/' . $datos['url_img_anterior']);
            //Nombramos la nueva imagen
            $nombreImg = time() . '_' . basename($_FILES['img']['name']);
            //Establecemos la ruta de la nueva imagen
            $url = $_SERVER['DOCUMENT_ROOT'] . '/Public/img-productos/' . $nombreImg;
            //Subimos la nueva imagen
            if (move_uploaded_file($_FILES['img']['tmp_name'], $url)) {
                //Setemaos con la ruta de la imagen
                $modelProducto->setImg($nombreImg);
                //Llamaos al método agregar para registrar nuestro producto
            }
        }
        return $modelProducto->actualizar();
        //Se retorna error en caso no haya imagen
    }
    public function obtenerProductosCliente(array $datos)
    {
        $modelProducto = new ProductoModel();
        $categorias = isset($datos['categorias']) ? implode(",",$datos['categorias']) : '';;
        $marcas = isset($datos['marcas']) ? implode(",",$datos['marcas']) : '';
        $ordenar = isset($datos['ordenProducto']) ? $datos['ordenProducto'] : '';
        $producto = isset($datos['nombreProducto']) ? $datos['nombreProducto'] : '';
        return ['productos' => $modelProducto->verProductosClientes($producto,$categorias,$marcas,$ordenar)];
    }
    public function indexHistorialProducto(){
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            header("location: /login");
            die();
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            header("location: /intranet/inicio");
            die();
        }
        $producto = new ProductoModel();
        $producto->setIdBodega($data['idAccesoRol']);
        $producto->setId(0);
        //listamos los productos por bodega
        $listaProductos = $producto->verProductosBodega();
        require_once("views/Bodega/historialStockPrecio.php");
    }
    public function obtenerProductoInformacion(int $productoId){
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $producto = new ProductoModel();
        $producto->setIdBodega($data['idAccesoRol']);
        $producto->setId($productoId);
        //listamos los productos por bodega
        $listaProductos = $producto->verProductosBodega();
        return ['producto' => $listaProductos];
    }
    public function editarStockProductoHistorial(int $productoId,float $precio, float $cantidad, float $descuento){
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $producto = new ProductoModel();
        $producto->setId($productoId);
        $producto->setStock($cantidad);
        $producto->setPrecioVenta($precio);
        $producto->setDescuento($descuento);
        //listamos los productos por bodega
        return $producto->actualizarHistorial();
    }
    public function listaHistorialProducto(int $productoId) {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => true];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => true];
        }
        $producto = new ProductoModel();
        $producto->setId($productoId);
        $producto->setIdBodega($data['idAccesoRol']);
        return ['data' => $producto->obtenerHistorialProducto()];
    }
}

?>