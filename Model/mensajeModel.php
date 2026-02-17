<?php

include("Model/Conexion.php");

class MensajeModel {
    private $conex;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conex = $conexion->getConnection();
    }

    public function GetMensajesTotales($idUsuario)
    {
        $stmt = $this->conex->prepare("CALL ObtenerMensajesEnviados(?)");
        $stmt->bind_param("i",$idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $busqueda = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $busqueda;
    }
    public function GetMensajesChat($idUsuario, $idUusarioVendedor)
    {
        $stmt = $this->conex->prepare("CALL ObtenerMensajesEnviadosChat(?, ?)");
        $stmt->bind_param("ii", $idUsuario, $idUusarioVendedor);
        $stmt->execute();
        $result = $stmt->get_result();
        $busqueda = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $busqueda;
    }

    
    public function getUsuarioInfo($idUsuario) {
        $query = "call obtenerInfoUsuario(?)";
        $stmt = $this->conex->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();  
    }
    

    public function InsertarMensaje($idUsuarioEnviador, $idUsuarioReceptor, $mensaje) {
        $stmt = $this->conex->prepare("CALL InsertarMensaje(?, ?, ?)");
        $stmt->bind_param("iis", $idUsuarioEnviador, $idUsuarioReceptor, $mensaje);
        $resultado = $stmt->execute(); // Ejecutar consulta
        $stmt->close(); // Cerrar la consulta
        return $resultado;
    }
    
    

}

?>