<?php

include_once("Conexion.php");

class CategoriaModel {
    private $conex;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conex = $conexion->getConnection();
    }

    public function GetCategorias()
    {
        $stmt = $this->conex->prepare("CALL GetCategorias()");
        $stmt->execute();
        $result = $stmt->get_result();
        $categorias = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $categorias;
    }
    public function GetCategoriasUsuario($idUsuario)
    {
        $stmt = $this->conex->prepare("CALL ObtenerCategoriasPorUsuario(?)");
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $categorias = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $categorias;
    }

    public function AddCategoria($nombre, $descripcion, $fechaCre, $IdUsuario, $estado)
    {
        $stmt = $this->conex->prepare("CALL InsertarCategoria(?,?,?,?,?)");
        $stmt->bind_param("ssisi", $nombre, $descripcion, $IdUsuario, $fechaCre, $estado);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    public function editCategoria($idCategoria,$nombre, $descripcion)
    {
        $stmt = $this->conex->prepare("CALL ActualizarCategoria(?,?,?)");
        $stmt->bind_param("iss", $idCategoria, $nombre, $descripcion);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    public function eliminarCategoria($idCategoria)
    {
        $stmt = $this->conex->prepare("CALL ActualizarEstadoCategoria(?)");
        $stmt->bind_param("i", $idCategoria);
        $success = $stmt->execute();
        $stmt->close();
        return $success;


    }

    public function close() {
        if ($this->conex) {
            $this->conex->close();
        }
    }
}

?>