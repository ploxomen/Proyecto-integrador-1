<?php
namespace Controllers\Cliente;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/ProductoModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
use Models\Usuario as ModelUsuario;
use Models\Producto as ModelProducto;

class Compras{

    public function agregarCarrito(int $idProducto, int $cantidad)
    {
        
        $cookieCarrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : null;
        if(is_null($cookieCarrito)){
            $cookieCarrito = [
                [
                    'idProducto' => $idProducto,
                    'cantidad' => $cantidad
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
                'cantidad' => $cantidad
            ];
        }
        unset($_COOKIE['carrito_compras']);
        setcookie("carrito_compras",null,time() - 1,"/");
        setcookie("carrito_compras",json_encode($cookieCarrito),time() + 604800,'/');
        return ['producto' => count($cookieCarrito),'reciente' => false];
    }
    public function verificarAutenticacionCompra()
    {
        $tokenBodegafast = isset($_COOKIE['token_bodegafast']) ? $_COOKIE['token_bodegafast'] : null;
        $response = ['token' => false,'rol' => null,'nombres' => null, 'apellidos' => null];
        if(!empty($tokenBodegafast)){
            $response['token'] = true;
            $usuarioModel = new ModelUsuario();
            $data = $usuarioModel->obtenerDatosAutenticado();
            $response['rol'] = $data['rol'];
            $response['nombres'] = $data['nombres'];
            $response['apellidos'] = $data['apellidos'];
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
    public function modificarCarritoCantidad(int $idProducto,int $cantidad)
    {
        $cookieCarrito = isset($_COOKIE['carrito_compras']) ? json_decode($_COOKIE['carrito_compras'],true) : [];
        if(is_null($cookieCarrito)){
            $cookieCarrito = [
                [
                    'idProducto' => $idProducto,
                    'cantidad' => $cantidad
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
                'cantidad' => $cantidad
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
}
?>