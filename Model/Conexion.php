<?php
class Conexion {
    private $server = "127.0.0.1:3306";
    private $user = "root";
    private $pass = "2002";
    private $dbname = "bdmpia2";
    private $conex;

    public function __construct()
    {
        $this->conex = new mysqli($this->server, $this->user, $this->pass, $this->dbname);
        if ($this->conex->connect_error) {
            die("Connection failed: " . $this->conex->connect_error);
        }
    }
    public function getConnection() 
    {
        return $this->conex;
    }

    public function closeConnection() 
    {
        $this->conex->close();
    }
}

?>