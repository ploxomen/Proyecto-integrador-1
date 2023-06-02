<?php

namespace Models;

require_once "Conexion.php";

use Models\Conexion;

class Clientes extends Conexion
{
    private int $id;
    private int $idAcceso;
    private string $nomnbres;
    private string $apellidos;
    private string $celular;
    private string $direccion;

    public function obtenerClientes()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_USUARIOS_MOSTRAR_CLIENTES_BODEGA(?)");
        $stmt->bind_param("i",$this->id);
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
     * Get the value of idAcceso
     */
    public function getIdAcceso(): int
    {
        return $this->idAcceso;
    }

    /**
     * Set the value of idAcceso
     */
    public function setIdAcceso(int $idAcceso): self
    {
        $this->idAcceso = $idAcceso;

        return $this;
    }

    /**
     * Get the value of nomnbres
     */
    public function getNomnbres(): string
    {
        return $this->nomnbres;
    }

    /**
     * Set the value of nomnbres
     */
    public function setNomnbres(string $nomnbres): self
    {
        $this->nomnbres = $nomnbres;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     */
    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of celular
     */
    public function getCelular(): string
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     */
    public function setCelular(string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     */
    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }
}