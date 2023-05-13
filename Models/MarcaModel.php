<?php
namespace Models;
require_once "Conexion.php";
use Models\Conexion;
class Marca extends Conexion{
    private int $id;
    private string $nombre;
    private int $estado;

    public function mostrar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_MARCAS()");
        $stmt->execute();
        $rs = $stmt->get_result();
        $stmt->close();
        $result = [];
        while($result[] = $rs->fetch_assoc());
        return $result;
    }
}
