<?php
//AUTOR : JEAN PIER CARRASCO TAMARIZ
//Establecemos el nombre de espacio donde se trabaja
namespace Controllers\Bodega;
//Requerimos los archivos necesarios para el funcionamiento
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ClientesModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/VentasModel.php';


//Usamos las clases y lo renombramos
use Models\Producto as ProductoModel;
use Models\Clientes;
use Models\Usuario as UsuarioModel;
use Models\Ventas as VentasModel;


//Definimos la clase Producto
class Venta {
    //Definimos el método el cual mostrará la vista de agregar producto
    public function indexBodegaAgregarVenta()
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
        //Instanciamos el modelo de clientes
        $clientes = new Clientes();
        //Pasamos el parametro 0 para que nos otorge todos los clientes activos, si se requiere solo un cliente el parametro tiene que ser diferente de 0
        $clientes->setId(0);
        //Llamamos al metodo para obtener los datos
        $listaClientes = $clientes->obtenerClientes();
        //Instanciamos el modelo producto
        $producto = new ProductoModel();
        $producto->setIdBodega($data['idAccesoRol']);
        $producto->setId(0);
        //listamos los productos por bodega
        $listaProductos = $producto->verProductosBodega();
        //Requerimos la vista para que el usuario la visualice
        require_once("views/Bodega/agregarVenta.php");
    }
    //Definimos el método el cual mostrará la vista de los productos
    public function indexBodegaMisVentas()
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
        require_once("views/Bodega/misVentas.php");
    }
    public function obtenerDatosVentasBodega()
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
        $ventaModel = new VentasModel();
        return ['data' => $ventaModel->verVentasPorBodega($data['idAccesoRol'])];
    }
    //Definimos el método el cual retornara los datos del cliente
    public function verInformacionCliente(int $idCliente)
    {
        //Instanciamos el modelo del cliente
        $clientes = new Clientes();        
        //Pasamos el id
        $clientes->setId($idCliente);
        //Retornamos la data
        return ['success' => $clientes->obtenerClientes()];
    }
    //Definimos el método el cual retornara los datos del producto
    public function verInformacionProducto(int $idProducto)
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['error' => 'Usuario no autenticado'];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['error' => 'Petición no permitida'];
        }
        $producto = new ProductoModel();
        $producto->setIdBodega($data['idAccesoRol']);
        $producto->setId($idProducto);
        return ['success' => $producto->verProductosBodega()];
    }
    public function verificarProductosStock(array $productos)
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => 'Usuario no autenticado'];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => 'Petición no permitida'];
        }
        $producto = new ProductoModel();
        $producto->setIdBodega($data['idAccesoRol']);
        $idProductos = implode(",",array_column($productos,"id"));
        $productosDb = $producto->verificarProductosStock($idProductos);
        $response = ['success' => 'no hay inconvenientes'];
        foreach ($productos as $pc) {
            $producto = array_filter($productosDb,function($v)use($pc){
                return $v['id'] == $pc['id'];
            });
            if(empty($producto)){
                $response = ['error' => 'El producto ' . $pc['nombre'] . ' no se a encontrado, posiblemente haya sido eliminado'];
                break;
            }
            $kp = key($producto);
            if(intval($pc['cantidad']) > intval($productosDb[$kp]['stock'])){
                $response = ['error' => 'El producto ' . $pc['nombre'] . ' no debe superar la cantidad de ' . intval($productosDb[$kp]['stock']) . ' unidades'];
                break;
            }
        }
        return $response;
    }
    //Definimos el método para agregar un producto
    public function agregarVentasBodega(array $datos)
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => 'Usuario no autenticado'];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => 'Petición no permitida'];
        }
        $detalleVenta = json_decode($datos['detalle'],true);
        $subtotal = 0;
        foreach ($detalleVenta as $dv) {
            $subtotal += floatval($dv['sub_total']);
        }
        $igv = floatval(0.18 * $subtotal);
        $total = floatval($subtotal + floatval($datos['envio']));
        $ventaModel = new VentasModel();
        $ventaModel->setIdCliente($datos['cliente']);
        $ventaModel->setDireccion($datos['direccion']);
        $ventaModel->setCelular($datos['celular']);
        $ventaModel->setMetodoEnvio("DELIVERY");
        $ventaModel->setMetodoPago("EFECTIVO");
        $ventaModel->setResponsableVenta("BODEGA");
        $ventaModel->setEnvio($datos['envio']);
        $ventaModel->setSubtotal($subtotal);
        $ventaModel->setTotal($total);
        $ventaModel->setIgv($igv);
        $ventaModel->setDetalleVentas(json_encode($detalleVenta));
        $resultado = $ventaModel->agregarVenta();
        return !$resultado ? ['error' => 'Error al agregar una venta'] : ['success' => 'Venta generada con éxito'];
    }
}
?>