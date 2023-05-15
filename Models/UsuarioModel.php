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
    public function setCorreo(string $correo)
    {
        $this->correo = $correo;
    }
}
