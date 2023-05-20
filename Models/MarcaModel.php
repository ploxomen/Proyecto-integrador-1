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
        array_pop($result);
        return $result;
    }
    public function obtenerMarcasProductos()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_MARCAS_PRODUCTOS()");
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        array_pop($result);
        $stmt->close();
        return $result;
    }
    public function agregar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_C_T_MARCAS(?)");
        $stmt->bind_param("s", $this->nombre);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'Marca agregada correctamente'] : ['error' => 'La marca no se agregó'];
        $stmt->close();
        return $response;
    }

    public function eliminar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_D_T_MARCAS(?)");
        $stmt->bind_param("i",$this->id);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'Marca eliminada correctamente'] : ['error' => 'La marca no se eliminó'];
        $stmt->close();
        return $response;
    }

    public function actualizar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_U_T_MARCAS(?,?)");
        $stmt->bind_param("is",$this->id, $this->nombre);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'Marca actualizada correctamente'] : ['error' => 'La marca no se actualizó'];
        $stmt->close();
        return $response;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}
