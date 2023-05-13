<?php
namespace Models;
class Conexion{
    private string $host = "localhost";
    private string $port = "3307";
    private string $db = "bodegafast";
    private string $user = "root";
    private string $password = "root123";

    public function conectar()
    {
        try {
            $cn = new \mysqli($this->host, $this->user, $this->password, $this->db, $this->port);
            return $cn;
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }

}

?>