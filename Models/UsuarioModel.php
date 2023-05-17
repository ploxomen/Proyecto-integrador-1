<?php

namespace Models;

require_once "Conexion.php";

use Models\Conexion;

class Usuario extends Conexion
{
    private int $id;
    private string $correo;
    private string $contrasena;
    private string $token;
    private int $estado;
    public $rolAdministrador = "rol_administrador";
    public $rolUsuario = "rol_usuario";
    public $rolBodega = "rol_bodega";

    public function iniciarSesion()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("SELECT c.id AS idAcceso,c.correo,c.contrasena,b.id AS bodega,u.id AS usuario, a.id AS administrador FROM acceso c LEFT JOIN bodegas b ON b.id_acceso = c.id LEFT JOIN administrativos a ON a.id_acceso = c.id LEFT JOIN usuarios u ON u.id_acceso = c.id WHERE c.correo = ? AND c.estado = 1 LIMIT 1");
        $stmt->bind_param("s",$this->correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $resultado = $resultado->fetch_assoc();
        $stmt->close();
        return $resultado;
    }
    public function generarToken()
    {
        $longitud = 75;
        return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
    }
    public function actualizarTokenUsuario()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("UPDATE acceso SET token = ? WHERE id = ?");
        $stmt->bind_param("si", $this->token, $this->id);
        $stmt->execute();
        $response = $stmt->error == '' ? true : false;
        $stmt->close();
        return $response;
    }
    public function obtenerDatosAutenticado()
    {
        if(!isset($_COOKIE['token_bodegafast'])){
            return null;
        }
        $this->setToken($_COOKIE['token_bodegafast']);
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_ACCESO(?)");
        $stmt->bind_param("s", $this->token);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $resultado = $resultado->fetch_assoc();
        if(!empty($resultado)){
            $resultado['iniciales'] = $this->obtenerIniciales($resultado['nombres']);
        }
        $stmt->close();
        return $resultado;
    }
    public function verificarDuplicidadCorreo()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_ACCESO_VERIFICAR_DUPLICIDAD_CORREO(?)");
        $stmt->bind_param("s",$this->correo);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        array_pop($result);
        $stmt->close();
        return $result;
    }
    public function crearCuentaUsuario(string $nombres, string $apellidos, string $celular, string $direccion)
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_C_T_ACCESO_USUARIO(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $this->correo,$this->contrasena,$nombres,$apellidos,$celular,$direccion);
        $stmt->execute();
        $response = $stmt->error == '' ? true : false;
        $stmt->close();
        return $response;
    }
    public function obtenerIniciales(string $cadena)
    {
        $valores = array_map(function($val){
            return substr($val,0,1);
        },explode(" ",$cadena));
        return implode("",$valores);
    }
    public function setCorreo(string $correo)
    {
        $this->correo = $correo;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setContrasena(string $contrasena)
    {
        $this->contrasena = $contrasena;
    }
    public function setToken(string $token)
    {
        $this->token = $token;
    }
}
