<?php

include("Conexion.php");

class UsuarioModel {
    private $conex;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conex = $conexion->getConnection();
    }

    public function InsertarUsuario($nomUsuario, $nombre, $apellidos, $fechaNac, $foto, $extension, $genero, $email, $pass, $fechaReg, $rol) 
    {
        $stmt = $this->conex->prepare("CALL InsertarUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssisssi",$nomUsuario, $nombre, $apellidos, $fechaNac, $foto, $extension, $genero, $email, $pass, $fechaReg, $rol);
        return $stmt->execute();
    }

    public function LeerIntentos($emailuser)
    {
        $stmt = $this->conex->prepare("CALL VerificarIntentos(?, @p_Intentos)");
        $stmt->bind_param("s", $emailuser);
        $stmt->execute();

        $select = $this->conex->query("SELECT @p_Intentos AS Intentos");
        $fila = $select->fetch_assoc();
        $stmt->close();
        return $fila['Intentos'];
    }

    public function IniciarSesion($emailuser, $contra)
    {
        $stmt = $this->conex->prepare("CALL IniciarSesion(?, ?)");
        $stmt->bind_param("ss", $emailuser, $contra);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function AumentarIntentos($emailuser)
    {
        $stmt = $this->conex->prepare("CALL AumentarIntentos(?)");
        $stmt->bind_param("s", $emailuser);
        return $stmt->execute();
    }

    public function ReestablecerIntentos($emailuser)
    {
        $stmt = $this->conex->prepare("CALL ReestablecerIntentos(?)");
        $stmt->bind_param("s", $emailuser);
        return $stmt->execute();
    }

    public function UpdatePerfil($nomUsuario, $nombre, $apellido, $fechaNac, $foto, $extension, $genero, $email, $contra, $fechaMod, $ID)
    {
        $stmt = $this->conex->prepare("CALL UpdatePerfil(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssisssi", $nomUsuario, $nombre, $apellido, $fechaNac, $foto, $extension, $genero, $email, $contra, $fechaMod, $ID);
        return $stmt->execute();
    }

    public function close() 
    {
        $this->conex->close();
    }
}

?>