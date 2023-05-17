<?php

namespace Controllers\Administrador;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/BodegaModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/UsuarioModel.php';


use Models\Bodega as BodegaModel;
use Models\Usuario as UsuarioModel;


class Bodegas
{
    public function indexBodegas()
    {
        $usuarioModel = new UsuarioModel();
        $data = $usuarioModel->obtenerDatosAutenticado();
        if (empty($data)) {
            header("location: /login");
            die();
        }
        if (!in_array($data['rol'], [$usuarioModel->rolAdministrador])) {
            header("location: /intranet/inicio");
            die();
        }
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/Administrador/bodegas.php");
    }
    public function obtenerBodegas()
    {
        $modelBodega = new BodegaModel();
        return ['data' => $modelBodega->mostrar()];
    }
    public function agregarBodega(array $datos)
    {
        $modelUsuario = new UsuarioModel();
        $modelUsuario->setCorreo($datos['correo']);
        $existeCorreo = $modelUsuario->verificarDuplicidadCorreo();
        if(count($existeCorreo)){
            return ['error' => 'El correo ' . $datos['correo'] . ' ya se encuentra registrado, por favor intente con otro correo'];
        }
        $modelBodega = new BodegaModel();
        $modelBodega->setRuc($datos['ruc']);
        $modelBodega->setNombre($datos['nombre']);
        $modelBodega->setDireccion($datos['direccion']);
        $modelBodega->setTelefono($datos['telefono']);
        $modelBodega->setCelular($datos['celular']);
        $modelBodega->setLocalizacion($datos['localizacion']);
        $modelBodega->setDniPropietario($datos['dni_propietario']);
        $modelBodega->setNombrePropietario($datos['nombre_propietario']);
        $contrasena = "bodegafast2023@";
        $agregarBodega = $modelBodega->agregar($datos['correo'],password_hash($contrasena,PASSWORD_DEFAULT));
        return $agregarBodega ? ['success' => 'Bodega creada correctamente ' . ' la contraseña es ' . $contrasena] : ['error' => 'Error al crear la bodega'];
    }
}
