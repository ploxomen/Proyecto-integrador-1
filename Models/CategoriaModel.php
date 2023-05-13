<?php

namespace Models;

require_once "Conexion.php";

use Models\Conexion;

class Categoria extends Conexion
{
    private int $id;
    private string $nombre;
    private int $estado;

    public function mostrar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_CATEGORIAS()");
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        $stmt->close();
        return $result;
    }
}
