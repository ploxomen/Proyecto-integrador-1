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
        array_pop($result);
        $stmt->close();
        return $result;
    }
    public function agregar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_C_T_CATEGORIAS(?)");
        $stmt->bind_param("s", $this->nombre);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'Categoría agregada correctamente'] : ['error' => 'La categoría no se agregó'];
        $stmt->close();
        return $response;
    }

    public function eliminar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_D_T_CATEGORIAS(?)");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'Categoría eliminada correctamente'] : ['error' => 'La categoría no se eliminó'];
        $stmt->close();
        return $response;
    }

    public function actualizar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_U_T_CATEGORIAS(?,?)");
        $stmt->bind_param("is", $this->id, $this->nombre);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'Categoría actualizada correctamente'] : ['error' => 'La categoría no se actualizó'];
        $stmt->close();
        return $response;
    }
    public function obtenerCategoriasProductos()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_CATEGORIAS_PRODUCTOS()");
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        array_pop($result);
        $stmt->close();
        return $result;
    }
    public function obtenerProductosCategoriaDashboard(string $fechaInicio,string $fechaFin, int $idBodega)
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_DASHBOARD_PRODUCTOS_VENDIDOS_CATEGORIA(?,?,?)");
        $stmt->bind_param("ssi", $fechaInicio, $fechaFin,$idBodega);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        array_pop($result);
        $stmt->close();
        return $result;
    }
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado(): int
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     */
    public function setEstado(int $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
