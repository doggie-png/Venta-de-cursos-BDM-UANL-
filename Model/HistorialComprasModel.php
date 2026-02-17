<?php
include_once("../conexion/conexion.php");
class HIstorialComprasModel {
    private $conex;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conex = $conexion->getConnection();
    }

    public function InsertarHistorialCompra($iduser,$idproducto,$cantidad,$calificacion,$comentario,$precio,$categoria,$fechacompra) 
    {
        $stmt = $this->conex->prepare("CALL InsertarHistorialCompra_PWCI(?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("sssssiss",$iduser,$idproducto,$cantidad,$calificacion,$comentario,$precio,$categoria,$fechacompra);
        return $stmt->execute();
        $stmt->close();
    }

    public function getHistorialCompra($iduser){
        $stmt = $this->conex->prepare("CALL ObtenerHistorialCompras_PWCI2(?)");
        $stmt->bind_param("s",$iduser);
        $stmt->execute();
        $result = $stmt->get_result();
        $Productos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $Productos;
    }

    public function getHistorialVentas($iduser){
        $stmt = $this->conex->prepare("CALL ObtenerHistorialVentas_PWCI(?)");
        $stmt->bind_param("s",$iduser);
        $stmt->execute();
        $result = $stmt->get_result();
        $Productos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $Productos;
    }

    public function getvaloracionProducto($idproducto){
        $stmt = $this->conex->prepare("CALL ObtenerValoracionProducto_PWCI(?)");
        $stmt->bind_param("s",$idproducto);
        $stmt->execute();
        $result = $stmt->get_result();
        $Productos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $Productos;
    }

    
    public function CalificarProducto($idregistro,$iduser,$idproducto,$calificacion,$comentario) 
    {
        $stmt = $this->conex->prepare("CALL CalificarProducto(?, ?, ?, ?,? )");
        $stmt->bind_param("sssss",$idregistro,$iduser,$idproducto,$calificacion,$comentario);
        return $stmt->execute();
        $stmt->close();
    }

    

}

?>