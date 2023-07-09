<?php
//AUTOR : JEAN PIER CARRASCO TAMARIZ
//Establecemos el nombre de espacio donde se trabaja
namespace Controllers\Bodega;
//Requerimos los archivos necesarios para el funcionamiento
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ClientesModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/VentasModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/Correo.php';
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

//Usamos las clases y lo renombramos
use Models\Producto as ProductoModel;
use Models\Clientes;
use Models\Usuario as UsuarioModel;
use Models\Ventas as VentasModel;
use Controllers\Correo;
use Dompdf\Dompdf;


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
    public function obtenerDatosVentasBodega(string $fechaInicio,string $fechaFin)
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
        return ['data' => $ventaModel->verVentasPorBodega($data['idAccesoRol'],$fechaInicio,$fechaFin)];
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
        //VEMOS SI EL USUARIO AUN SIGUE AUTENTICADO
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => 'Usuario no autenticado'];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            return ['session' => 'Petición no permitida'];
        }
        $clientes = new Clientes();
        //Pasamos el parametro del cliente para que nos otorge su informacion
        $clientes->setId($datos['cliente']);
        //Llamamos al metodo para obtener los datos del cliente
        $cliente = $clientes->obtenerClientes();
        if(!isset($cliente[0])){
            return ['error' => 'Cliente no encontrado'];
        }
        //OBTENEMOS NUESTRO DETALLE DE VENTA
        $detalleVenta = json_decode($datos['detalle'],true);
        $subtotal = 0;
        //RECORREMOS PARA CALCULAR NUESTRO SUBTOTAL
        foreach ($detalleVenta as $dv) {
            $subtotal += floatval($dv['sub_total']);
        }
        //DEFINIMOS LAS VARIABLES PARA NUESTRA VENTA
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
        //SI TOTO ESTA OK SE ENVIA EL CORREO
        if($resultado){
            //SE DEFINE LA ZONA HORARIA
            date_default_timezone_set('America/Bogota');
            //OBTENEMOS EL ENVIO
            $envio = $datos['envio'];
            //OBTENEMOS LA DIRECCION
            $direccion = $datos['direccion'];
            //ALMACENAMOS EL DETALLE PARA QUE SEA RECORRIDO EN NUESTRO PHP DEL CORREO
            $productos = $detalleVenta;
            //DIFINIMOS EL NOMBRE COMPLETO DEL CLIENTE
            $nombreCompleto = $cliente[0]['nombres'] . ' ' . $cliente[0]['apellidos'];
            //OBTENEMOS EL PHP EN TEXTO DEL CORREO
            ob_start();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/Cliente/correoCompra.php';
            //LO ALMACENAMOS EN UNA BARIABLE
            $contenido_html = ob_get_clean();
            //INSTANCIAMOS EL CORREO
            $correo = new Correo;
            //ENVIAMOS EL CORREO AL DESTINATARIO CON LOS CAMPOS NECESARIOS
            $correo->enviarCorreoCompra('COMPROBANTE DE COMPRA - BODEGAFAST',$cliente[0]['correo'],$nombreCompleto,$contenido_html,'¡Gracias por comprar en BODEGAFAST!');
        }
        return !$resultado ? ['error' => 'Error al agregar una venta'] : ['success' => 'Venta generada con éxito'];
    }
    public function reporteVenta(){
        //verificar la autenticacion del usuario 
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            //si no esta autenticado que le redirija al login
            header("location: /login");
            die();
        }
        if (!in_array($data['rol'], [$usuarioModel->rolBodega])) {
            //Si no esta con el rol bodega que le mande al inicio
            header("location: /intranet/inicio");
            die();
        }
        //se llama a las ventas
        $ventaModel = new VentasModel();
        //se llama a la libreria del reporte
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        //se obtiene las ventas
        $ventas = $ventaModel->verVentasPorBodega($data['idAccesoRol'],$fechaInicio,$fechaFin);
        foreach ($ventas as $k=>$venta) {
            $ventaModel->setId($venta['id']);
            //se obtiene el detalle de las ventas
            $ventas[$k]['productos'] = $ventaModel->verDetalleVentas();
        }
        //se incluye una vista html
        if($_POST['accion'] == "pdf"){
            ob_start();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/Bodega/reportes/detalleVenta.php';
            $html = ob_get_clean();
            $dompdf = new Dompdf();
            //Obtencion de la vista
            $dompdf->loadHtml($html);
            //definimos el papel horizontal
            $dompdf->setPaper('A4', 'landscape');
            //renderizamos en el navegador
            $dompdf->render();
            $dompdf->stream("reporte_ventas.pdf",array("Attachment" => false));
        }else{
            header("Content-Type: application/xls"); 
            header('Content-Type: text/html; charset=utf-8');
            header("Content-Disposition: attachment; filename=reporte_de_ventas_" .date('Y:m:d:m:s').".xls");
            header("Pragma: no-cache"); 
            header("Expires: 0");
            ob_start();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/Bodega/reportes/detalleVentaExcel.php';
            echo ob_get_clean();
        }
    }
}
?>