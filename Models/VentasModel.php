<?php

namespace Models;

require_once "Conexion.php";

use Models\Conexion;

class Ventas extends Conexion
{
    private int $id;
    private int $idCliente;
    private string $direccion;
    private string $celular;
    private string $metodoEnvio;
    private string $metodoPago;
    private string $responsableVenta;
    private float $subtotal;
    private float $igv;
    private float $envio;
    private float $total;
    private string $detalleVentas;
    private int $estado;

    public function agregarVenta()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_C_T_VENTAS(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isssssdddds", $this->idCliente, $this->direccion,$this->celular,$this->metodoEnvio,$this->metodoPago,$this->responsableVenta,$this->subtotal,$this->envio,$this->total,$this->igv,$this->detalleVentas);
        $stmt->execute();
        $response = $stmt->error == '' ? true : false;
        $stmt->close();
        return $response;
    }
    public function verVentasPorBodega(int $idBodega,string $fechaInicio,string $fechaFin)
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_VENTAS_BODEGAS(?,?,?)");
        $stmt->bind_param("iss",$idBodega,$fechaInicio,$fechaFin);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        array_pop($result);
        $stmt->close();
        return $result;
    }
    public function verDetalleVentas(){
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_VENTAS_PRODUCTOS(?)");
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
     * Get the value of idCliente
     */
    public function getIdCliente(): int
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     */
    public function setIdCliente(int $idCliente): self
    {
        $this->idCliente = $idCliente;

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
     * Get the value of metodoEnvio
     */
    public function getMetodoEnvio(): string
    {
        return $this->metodoEnvio;
    }

    /**
     * Set the value of metodoEnvio
     */
    public function setMetodoEnvio(string $metodoEnvio): self
    {
        $this->metodoEnvio = $metodoEnvio;

        return $this;
    }

    /**
     * Get the value of metodoPago
     */
    public function getMetodoPago(): string
    {
        return $this->metodoPago;
    }

    /**
     * Set the value of metodoPago
     */
    public function setMetodoPago(string $metodoPago): self
    {
        $this->metodoPago = $metodoPago;

        return $this;
    }

    /**
     * Get the value of responsableVenta
     */
    public function getResponsableVenta(): string
    {
        return $this->responsableVenta;
    }

    /**
     * Set the value of responsableVenta
     */
    public function setResponsableVenta(string $responsableVenta): self
    {
        $this->responsableVenta = $responsableVenta;

        return $this;
    }

    /**
     * Get the value of subtotal
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     */
    public function setSubtotal(float $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get the value of igv
     */
    public function getIgv(): float
    {
        return $this->igv;
    }

    /**
     * Set the value of igv
     */
    public function setIgv(float $igv): self
    {
        $this->igv = $igv;

        return $this;
    }

    /**
     * Get the value of envio
     */
    public function getEnvio(): float
    {
        return $this->envio;
    }

    /**
     * Set the value of envio
     */
    public function setEnvio(float $envio): self
    {
        $this->envio = $envio;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal(float $total): self
    {
        $this->total = $total;

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

    /**
     * Get the value of detalleVentas
     */
    public function getDetalleVentas(): string
    {
        return $this->detalleVentas;
    }

    /**
     * Set the value of detalleVentas
     */
    public function setDetalleVentas(string $detalleVentas): self
    {
        $this->detalleVentas = $detalleVentas;

        return $this;
    }
}