<?php
namespace Models;
require_once "Conexion.php";
use Models\Conexion;
class Producto extends Conexion{
    private int $id;
    private int $idBodega;
    private int $idMarca;
    private string $idCategorias;
    private string $nombre;
    private string $descripcion;
    private float $stock;
    private float $stockMinimo;
    private float $precioCompra;
    private float $precioVenta;
    private float $descuento;
    private string $img;
    private int $estado;

    public function agregar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_C_T_PRODUCTOS (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('iissdddddss',$this->idBodega,$this->idMarca,$this->nombre,$this->descripcion,$this->stock,$this->stockMinimo,$this->precioCompra,$this->precioVenta,$this->descuento,$this->img,$this->idCategorias);
        $stmt->execute();
        $response = $stmt->error == '' ? ['success' => 'producto agregado correctamente'] : ['error' => 'el producto no se agrego'];
        $stmt->close();
        return $response;
    }
    public function mostrar()
    {
        $cn = $this->conectar();
        $stmt = $cn->prepare("CALL SP_R_T_PRODUCTOS()");
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = [];
        while ($result[] = $rs->fetch_assoc());
        array_pop($result);
        $stmt->close();
        return $result;
    }
    public function setIdCategoriasJson(string $idCategorias)
    {
        $this->idCategorias = $idCategorias;
    }
    public function setIdBodega(int $idBodega)
    {
        $this->idBodega = $idBodega;
    }
    public function setIdMarca(int $idMarca)
    {
        $this->idMarca = $idMarca;
    }
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setStock(float $stock)
    {
        $this->stock = $stock;
    }
    public function setStockMinimo(float $stockMinimo)
    {
        $this->stockMinimo = $stockMinimo;
    }
    public function setPrecioCompra(float $precioCompra)
    {
        $this->precioCompra = $precioCompra;
    }
    public function setPrecioVenta(float $precioVenta)
    {
        $this->precioVenta = $precioVenta;
    }
    public function setDescuento(float $descuento)
    {
        $this->descuento = $descuento;
    }
    public function setImg(string $img)
    {
        $this->img = $img;
    }
}

?>