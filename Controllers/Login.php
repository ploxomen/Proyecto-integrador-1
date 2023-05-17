<?php
namespace Controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';
use Models\Usuario as ModelUsuario;
class Login{
    public function indexLogin()
    {
        if(!isset($_COOKIE['token_bodegafast'])){
            require_once('views/login.php');
            die();
        }
        $usuarioModel = new ModelUsuario();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if(empty($data)){
            setcookie("token_bodegafast", "", time() - 3600, '/');
            header("location: /login");
        }
        switch ($data['rol']) {
            case 'rol_bodega':
                header("location: /intranet/inicio");
            break;
            case 'rol_administrador':
                header("location: /intranet/inicio");
            break;
            case 'rol_usuario':
                header("location: /");
            break;
        }
    }
    public function cerrarSesion()
    {
        if (!isset($_COOKIE['token_bodegafast'])) {
            header("location: /login");
            die();
        }
        $usuarioModel = new ModelUsuario();
        $data = $usuarioModel->obtenerDatosAutenticado();
        $usuarioModel->setId($data['idAcceso']);
        $usuarioModel->setToken("");
        $usuarioModel->actualizarTokenUsuario();
        setcookie("token_bodegafast", "", time() - 3600, '/');
        header("location: /login");
    }
    public function inicioIntranet()
    {
        $rol = ['rol_bodega', 'rol_administrador'];
        $usuarioModel = new ModelUsuario();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if(empty($data)){
            header("location: /login");
            die();
        }
        if(in_array($data['rol'],$rol)){
            require_once('views/home.php');
            die();
        }
        header("location: /");
    }
    public function crearCuenta(string $correo,string $contrasena, string $nombres, string $apellidos, string $celular, string $direccion)
    {
        if (isset($_COOKIE['token_bodegafast'])) {
            return ['error' => 'Ya existe un usuario autenticado, por favor cierre sesión'];
        }
        $usuarioModel = new ModelUsuario();
        $usuarioModel->setCorreo($correo);
        $existeCorreo = $usuarioModel->verificarDuplicidadCorreo();
        if (count($existeCorreo)) {
            return ['error' => 'El correo ' . $correo . ' ya se encuentra registrado, por favor intente con otro correo'];
        }
        $usuarioModel->setContrasena(password_hash($contrasena,PASSWORD_DEFAULT));
        $crearUsuario = $usuarioModel->crearCuentaUsuario($nombres,$apellidos,$celular,$direccion);
        if(!$crearUsuario){
            return ['error' => 'Error al crear el usuario'];
        }
        return $this->autenticarUsuario($correo,$contrasena);
    }
    public function autenticarUsuario(string $correo, string $contrasena)
    {
        $usuarioModel = new ModelUsuario();
        $usuarioModel->setCorreo($correo);
        $autenticar = $usuarioModel->iniciarSesion($correo, $contrasena);
        $resultado = ['error' => 'Usuario o contraseña incorrectos'];
        if(empty($autenticar)){
            return $resultado;
        }
        if(!password_verify($contrasena, $autenticar['contrasena'])){
            return $resultado;
        }
        $token = $usuarioModel->generarToken();
        $usuarioModel->setId($autenticar['idAcceso']);
        $usuarioModel->setToken($token);
        $actualizarToken = $usuarioModel->actualizarTokenUsuario();
        if(!$actualizarToken){
            $resultado['error'] = 'Error al autenticar usuario';
            return $resultado;
        }
        setcookie("token_bodegafast",$token,time() + 604800,"/");
        $resultado = ['success' => 'Usuario autenticado'];
        return $resultado;
    }
}
?>