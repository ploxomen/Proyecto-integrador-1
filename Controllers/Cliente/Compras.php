<?php

namespace Controllers\Cliente;
//incluimos composer para el usuo de la libraria
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/VentasModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/Correo.php';
//incluimos la libraria de culqi para PHP
include_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/culqi/culqi-php/lib/culqi.php';

use Models\Usuario as ModelUsuario;
use Models\Producto as ModelProducto;
use Models\Ventas as VentasModel;
use Controllers\Correo;

class Compras{
    private $SECRET_KEY = "sk_test_tNzIoYbCp0MtHpbA";
    public function agregarCarrito(int $idProducto, int $cantidad, string $nombre)
    {
        $cookieCarrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : null;
        if(is_null($cookieCarrito)){
            $cookieCarrito = [
                [
                    'idProducto' => $idProducto,
                    'cantidad' => $cantidad,
                    'nombre' => $nombre
                ]
            ];
            setcookie("carrito_compras",json_encode($cookieCarrito),time() + 604800,'/');
            return ['producto' => 1, 'reciente' => true];
        }
        $existeCarrito = false;
        foreach ($cookieCarrito as $k=>$carrito) {
            if($carrito['idProducto'] == $idProducto){
                $existeCarrito = true;
                $cookieCarrito[$k]['cantidad'] = $cantidad + $cookieCarrito[$k]['cantidad'];
                break;
            }
        }
        if(!$existeCarrito){
            $cookieCarrito[] = [
                'idProducto' => $idProducto,
                'cantidad' => $cantidad,
                'nombre' => $nombre
            ];
        }
        unset($_COOKIE['carrito_compras']);
        setcookie("carrito_compras",null,time() - 1,"/");
        setcookie("carrito_compras",json_encode($cookieCarrito),time() + 604800,'/');
        return ['producto' => count($cookieCarrito),'reciente' => false];
    }
    public function verificarAutenticacionCompra()
    {
        error_reporting(0);
        //Obtenemos el carrito de compras
        $tokenBodegafast = isset($_COOKIE['token_bodegafast']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        $response = ['token' => false,'rol' => null,'nombres' => null, 'apellidos' => null];
        if(!empty($tokenBodegafast)){
            $total = 0;
            $response['token'] = true;
            $usuarioModel = new ModelUsuario();
            //verificamos el usuario autenticado
            $data = $usuarioModel->obtenerDatosAutenticado();
            $response['rol'] = $data['rol'];
            $response['nombres'] = $data['nombres'];
            $response['apellidos'] = $data['apellidos'];
            $idProductos = "";
            //asignamos los costos a los productos
            foreach ($tokenBodegafast as $key => $value) {
                $idProductos .= $value['idProducto'];
                $idProductos .= ($key + 1) != count($tokenBodegafast) ? "," : "";
            }
            //calculamos el subtotal con el total
            $modeloProducto = new ModelProducto;
            $productos = $modeloProducto->verProductosClientesCarrito($idProductos);
            foreach ($productos as $kp => $vp) {
                $filtroCarrito = array_filter($tokenBodegafast,function($valCarrito)use($vp){
                    return $valCarrito['idProducto'] == $vp['id'];
                });
                if(empty($filtroCarrito)){
                    continue;
                }
                $productos[$kp]['cantidad'] = $tokenBodegafast[key($filtroCarrito)]['cantidad'];
                $productos[$kp]['subtotal'] = $tokenBodegafast[key($filtroCarrito)]['cantidad'] * $vp['precio_venta'];
                $total += $productos[$kp]['subtotal'];
            }
            $response['total'] = $total;
            //generamos una orden para los metodos de pago
            $culqi = new \Culqi\Culqi(array('api_key' => $this->SECRET_KEY));
            $order = $culqi->Orders->create(
                array(
                  "amount" => ($total + 10) * 100,
                  "currency_code" => "PEN",
                  "description" => 'Venta BODEGAFAST',        
                  "order_number" => uniqid(),
                  "client_details" => array( 
                      "first_name"=> $data['nombres'], 
                      "last_name" => $data['apellidos'],
                      "email" => $data['correo'], 
                      "phone_number" => $data['celular']
                   ),
                  "expiration_date" => time() + 24*60*60// Orden con un dia de validez
                )
          );
          $response['orden'] = $order;
        }
        return $response;
    }
    public function indexCarritoCompras()
    {
        $carrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        $productos = [];
        $total = 0;
        $tokenBodegafast = isset($_COOKIE['token_bodegafast']) ? $_COOKIE['token_bodegafast'] : null;
        $data = null;
        if(!empty($carrito)){
            if(!empty($tokenBodegafast)){
                $usuarioModel = new ModelUsuario();
                $data = $usuarioModel->obtenerDatosAutenticado();
            }
            $idProductos = "";
            foreach ($carrito as $key => $value) {
                $idProductos .= $value['idProducto'];
                $idProductos .= ($key + 1) != count($carrito) ? "," : "";
            }
            $modeloProducto = new ModelProducto;
            $productos = $modeloProducto->verProductosClientesCarrito($idProductos);
            foreach ($productos as $kp => $vp) {
                $filtroCarrito = array_filter($carrito,function($valCarrito)use($vp){
                    return $valCarrito['idProducto'] == $vp['id'];
                });
                if(empty($filtroCarrito)){
                    continue;
                }
                $productos[$kp]['cantidad'] = $carrito[key($filtroCarrito)]['cantidad'];
                $productos[$kp]['subtotal'] = $carrito[key($filtroCarrito)]['cantidad'] * $vp['precio_venta'];
                $total += $productos[$kp]['subtotal'];
            }
        }
        require_once("views/carrito.php");
    }
    public function eliminarCarritoCompas(int $idProducto)
    {
        $cookieCarrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        
        $nuevoCarrito = [];
        foreach ($cookieCarrito as $k=>$carrito) {
            if($carrito['idProducto'] == $idProducto){
                continue;
            }
            $nuevoCarrito[] = $cookieCarrito[$k];
        }
        if(count($nuevoCarrito) === 0){
            if(isset($_COOKIE['carrito_compras'])){
                unset($_COOKIE['carrito_compras']);
                setcookie("carrito_compras",null,time() - 1,"/");
            }
            return ['reload' => true];
        }
        $total = 0;
        if(isset($_COOKIE['carrito_compras'])){
            unset($_COOKIE['carrito_compras']);
            setcookie("carrito_compras",null,time() - 1,"/");
            setcookie("carrito_compras",json_encode($nuevoCarrito),time() + 604800,'/');
            $idProductos = "";
            foreach ($nuevoCarrito as $key => $value) {
                $idProductos .= $value['idProducto'];
                $idProductos .= ($key + 1) != count($nuevoCarrito) ? "," : "";
            }
            $modeloProducto = new ModelProducto;
            $productos = $modeloProducto->verProductosClientesCarrito($idProductos);
            foreach ($productos as $kp => $vp) {
                $filtroCarrito = array_filter($nuevoCarrito,function($valCarrito)use($vp){
                    return $valCarrito['idProducto'] == $vp['id'];
                });
                if(empty($filtroCarrito)){
                    continue;
                }
                
                $productos[$kp]['cantidad'] = $nuevoCarrito[key($filtroCarrito)]['cantidad'];
                $productos[$kp]['subtotal'] = $nuevoCarrito[key($filtroCarrito)]['cantidad'] * $vp['precio_venta'];
                $total += $productos[$kp]['subtotal'];
            }
        }
        return ['producto' => count($nuevoCarrito),'total' => number_format(floatval($total),2)];
    }
    public function modificarCarritoCantidad(int $idProducto,int $cantidad, string $nombre)
    {
        $cookieCarrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        if(is_null($cookieCarrito)){
            $cookieCarrito = [
                [
                    'idProducto' => $idProducto,
                    'cantidad' => $cantidad,
                    'nombre' => $nombre
                ]
            ];
            setcookie("carrito_compras",json_encode($cookieCarrito),time() + 604800,'/');
            return ['producto' => 1, 'reciente' => true];
        }
        $existeCarrito = false;
        foreach ($cookieCarrito as $k=>$carrito) {
            if($carrito['idProducto'] == $idProducto){
                $existeCarrito = true;
                $cookieCarrito[$k]['cantidad'] = $cantidad;
                break;
            }
        }
        if(!$existeCarrito){
            $cookieCarrito[] = [
                'idProducto' => $idProducto,
                'cantidad' => $cantidad,
                'nombre' => $nombre
            ];
        }
        unset($_COOKIE['carrito_compras']);
        setcookie("carrito_compras",null,time() - 1,"/");
        setcookie("carrito_compras",json_encode($cookieCarrito),time() + 604800,'/');
        $idProductos = "";
        $total = 0;
        $subtotal = 0;
        foreach ($cookieCarrito as $key => $value) {
            $idProductos .= $value['idProducto'];
            $idProductos .= ($key + 1) != count($cookieCarrito) ? "," : "";
        }
        $modeloProducto = new ModelProducto;
        $productos = $modeloProducto->verProductosClientesCarrito($idProductos);
        foreach ($productos as $kp => $vp) {
            $filtroCarrito = array_filter($cookieCarrito,function($valCarrito)use($vp){
                return $valCarrito['idProducto'] == $vp['id'];
            });
            if(empty($filtroCarrito)){
                continue;
            }
            $productos[$kp]['cantidad'] = $cookieCarrito[key($filtroCarrito)]['cantidad'];
            $productos[$kp]['subtotal'] = $cookieCarrito[key($filtroCarrito)]['cantidad'] * $vp['precio_venta'];
            if($cookieCarrito[key($filtroCarrito)]['idProducto'] == $idProducto){
                $subtotal = $productos[$kp]['subtotal'];
            }
            $total += $productos[$kp]['subtotal'];
        }
        return ['total' => number_format(floatval($total),2), 'subtotal' => number_format(floatval($subtotal),2)];
    }
    public function aliminarTotalCarrito()
    {
        if(isset($_COOKIE['carrito_compras'])){
            unset($_COOKIE['carrito_compras']);
            setcookie("carrito_compras",null,time() - 1,"/");
            return ['success' => 'Se canceló el proceso de compra...'];
        }
        return ['error' => 'No se encontró el carrito de compras'];
    }
    public function verificarCompra()
    {
        $cookieCarrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        $producto = new ModelProducto();
        $idProductos = implode(",",array_column($cookieCarrito,"idProducto"));
        $productosDb = $producto->verProductosClientesCarrito($idProductos);
        $response = ['success' => 'no hay inconvenientes'];
        foreach ($cookieCarrito as $pc) {
            $producto = array_filter($productosDb,function($v)use($pc){
                return $v['id'] == $pc['idProducto'];
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
    public function agregarCompraCliente(array $datos)
    {
        error_reporting(0);
        //OBTENEMOS EL CARRITO DE COMPRAS
        $detalleVenta = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        $subtotal = 0;
        //OBTENEMOS EL MODELO DEL PRODUCTO
        $modeloProducto = new ModelProducto;
        //FILTRAMOS LOS PRODUCTOS
        $idProductos = implode(",",array_column($detalleVenta,"idProducto"));
        //OBTENEMOS LOS DATOS DE LA DB PARA COMPRAR
        $productos = $modeloProducto->verProductosClientesCarrito($idProductos);
        //RECORREMOS PARA FILTRAR
        foreach ($productos as $kp => $vp) {
            //FILTRAMOS EL ARREGLO
            $filtroCarrito = array_filter($detalleVenta,function($valCarrito)use($vp){
                return $valCarrito['idProducto'] == $vp['id'];
            });
            if(empty($filtroCarrito)){
                continue;
            }
            //DEFINIMOS LA CANTIDAD Y EL SUBTOTAL
            $productos[$kp]['cantidad'] = $detalleVenta[key($filtroCarrito)]['cantidad'];
            $productos[$kp]['sub_total'] = $detalleVenta[key($filtroCarrito)]['cantidad'] * $vp['precio_venta'];
            $subtotal += $productos[$kp]['sub_total'];
        }
        //VEMOS SI EL USUARIO AUN SIGUE AUTENTICADO
        $usuarioModel = new ModelUsuario();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            return ['session' => 'Usuario no autenticado'];
        }
        if (!in_array($data['rol'], [$usuarioModel->rolUsuario])) {
            return ['session' => 'Petición no permitida'];
        }
        //DEFINIMOS LAS VARIABLES PARA NUESTRA COMPRA
        $igv = floatval(0.18 * $subtotal);
        $envio = 10;
        $total = floatval($subtotal + $envio);
        //Creamos nuestra venta en culqi
        $culqi = new \Culqi\Culqi(array('api_key' => $this->SECRET_KEY));
        $charge = $culqi->Charges->create(
            array(
              "amount" => ($total * 100),
              "capture" => true,
              "currency_code" => "PEN",
              "description" => "Compra BODEGAFAST",
              "email" => $datos['email'],
              "installments" => 0,
              "source_id" => $datos['token']
            )
        );
        $ventaModel = new VentasModel();
        $ventaModel->setIdCliente($data['idAccesoRol']);
        $ventaModel->setDireccion($datos['direccion']);
        $ventaModel->setCelular($datos['celular']);
        $ventaModel->setMetodoEnvio("DELIVERY");
        $ventaModel->setMetodoPago($datos['tipo']);
        $ventaModel->setResponsableVenta("CLIENTE");
        $ventaModel->setEnvio($envio);
        $ventaModel->setSubtotal($subtotal);
        $ventaModel->setTotal($total);
        $ventaModel->setIgv($igv);
        $ventaModel->setDetalleVentas(json_encode($productos));
        $resultado = $ventaModel->agregarVenta();
        //SI TOTO ESTA OK SE ENVIA EL CORREO
        if($resultado){
            //SE DEFINE LA ZONA HORARIA
            date_default_timezone_set('America/Bogota');
            $direccion = $datos['direccion'];
            $nombreCompleto = $data['nombres'] . ' ' . $data['apellidos'];
            //OBTENEMOS EL PHP EN TEXTO DEL CORREO
            ob_start();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/Views/Cliente/correoCompra.php';
            //LO ALMACENAMOS EN UNA BARIABLE
            $contenido_html = ob_get_clean();
            //INSTANCIAMOS EL CORREO
            $correo = new Correo;
            //ENVIAMOS EL CORREO AL DESTINATARIO CON LOS CAMPOS NECESARIOS
            $correo->enviarCorreoCompra('COMPROBANTE DE COMPRA - BODEGAFAST',$data['correo'],$nombreCompleto,$contenido_html,'¡Gracias por comprar en BODEGAFAST!');
        }
        //RETORNAMOS EL RESULTADO
        return !$resultado ? ['error' => 'Error al agregar una venta'] : ['success' => 'Venta generada con éxito'];
    }
}
?>