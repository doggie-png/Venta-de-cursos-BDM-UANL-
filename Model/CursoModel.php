<?php

include_once("Conexion.php");

class CursoModel{
    private $conex;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conex = $conexion->getConnection();
    }

    public function InsertarCurso($instructor, $nombre, $descripcion, $foto, $extension, $costo, $fechacreacion)
    {
        $stmt = $this->conex->prepare("CALL InsertarCurso(?, ?, ?, ?, ?, ?, ?, @p_IdCurso)");
        $stmt->bind_param("issssds", $instructor, $nombre, $descripcion, $foto, $extension, $costo, $fechacreacion);
        $stmt->execute();
        $result = $this->conex->query("SELECT @p_IdCurso AS ID_Curso");
        $row = $result->fetch_assoc();
        $ID_Curso = $row["ID_Curso"];
        $stmt->close();
        return $ID_Curso;
    }

    public function AsignarCategorias($ID_Categoria, $ID_Curso)
    {
        $stmt = $this->conex->prepare("CALL InsertarCategoriaAsignada(?, ?)");
        $stmt->bind_param("ii", $ID_Categoria, $ID_Curso);
        $stmt->execute();
        $stmt->close();
    }

    public function InsertarNivel($idcurso, $numnivel, $nombre, $video, $recurso, $tiporecurso, $precioindiv)
    {
        $stmt = $this->conex->prepare("CALL InsertarNivel(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssd", $idcurso, $numnivel, $nombre, $video, $recurso, $tiporecurso, $precioindiv);
        $stmt->execute();
        $stmt->close();
    }

    public function Busqueda($busqueda, $tipoBusqueda, $categorias, $fechaMin, $fechaMax)
    {
        $stmt = $this->conex->prepare("CALL Busqueda(?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $busqueda, $tipoBusqueda, $categorias, $fechaMin, $fechaMax);
        $stmt->execute();
        $result = $stmt->get_result();

        $cursos = [];
        while ($row = $result->fetch_assoc()) {
            $cursos[] = $row;
        }

        $stmt->close();
        return $cursos;
    }

    public function GetInfoCurso($IdCurso)
    {
        $stmt = $this->conex->prepare("CALL GetInfoCurso(?)");
        $stmt->bind_param("i", $IdCurso);
        $stmt->execute();
        $results = [];

        $result1 = $stmt->get_result();
        if ($result1) {
            $results['curso'] = $result1->fetch_assoc(); 
            $result1->free_result();
        }

        
        if ($stmt->more_results()) {
            $stmt->next_result(); 
            $result2 = $stmt->get_result();
            if ($result2) {
                $results['niveles'] = $result2->fetch_assoc(); 
                $result2->free_result();
            }
        }


        if ($stmt->more_results()) {
            $stmt->next_result();
            $result3 = $stmt->get_result();
            if ($result3) {
                $results['detalles_niveles'] = [];
                while ($row = $result3->fetch_assoc()) {
                    $results['detalles_niveles'][] = $row;
                }
                $result3->free_result();
            }
        }

        $stmt->close(); 
        return $results;

    }

    public function InsertarCursoComprado($IdCurso, $IdUsuario, $MetodoPaga)
    {
        $stmt = $this->conex->prepare("CALL InsertCursoComprado(?, ?, ?)");
        $stmt->bind_param("iis", $IdCurso, $IdUsuario, $MetodoPaga);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en CursoComprado: " . $stmt->error);
        }
        $stmt->close();
    }

    public function InsertarNivelCursando($IdNivel, $IdUsuario) 
    {
        $stmt = $this->conex->prepare("CALL InsertarNivelCursando(?, ?)");
        $stmt->bind_param("ii", $IdNivel, $IdUsuario);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en NivelCursando: " . $stmt->error);
        }
        $stmt->close();
    }

    public function ObtenerNivelesPorCurso($IdCurso)
    {
        $niveles = [];
        $stmt = $this->conex->prepare("CALL GetNivelesCurso(?)");
        $stmt->bind_param("i", $IdCurso);
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }
        $result = $stmt->get_result();
        while ($nivel = $result->fetch_assoc()) {
            $niveles[] = $nivel;
        }
        $stmt->close();
        return $niveles;
    }

    public function GetMasVendidos()
    {
        $stmt = $this->conex->prepare("CALL MasVendidos()");
        $stmt->execute();
        $result = $stmt->get_result();
        $MasVendidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $MasVendidos;
    }

    public function GetMasCalificados()
    {
        $stmt = $this->conex->prepare("CALL MasCalificados()");
        $stmt->execute();
        $result = $stmt->get_result();
        $MasVendidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $MasVendidos;
    }

    
    public function GetMasRecientes()
    {
        $stmt = $this->conex->prepare("CALL MasRecientes()");
        $stmt->execute();
        $result = $stmt->get_result();
        $MasVendidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $MasVendidos;
    }

    public function GetMasVendedor($idcurso)
    {
        $stmt = $this->conex->prepare("CALL MasVendedor(?)");
        $stmt->bind_param("i", $IdUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $MasVendidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $MasVendidos;
    }

    public function ObtenerCursosImpartidos($IdUsuario)
    {
        $stmt = $this->conex->prepare("CALL ObtenerCursosPorInstructorSP(?)");
        $stmt->bind_param("i", $IdUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $CursosImpartidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $CursosImpartidos;
    }
    public function ObtenerCursosComprados($IdUsuario)
    {
        $stmt = $this->conex->prepare("CALL obtener_cursos_comprados_por_usuario(?)");
        $stmt->bind_param("i", $IdUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $CursosComprados = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $CursosComprados;
    }
    public function ObtenerCAlumnosInscritos($IdCurso)
    {
        $stmt = $this->conex->prepare("CALL ObtenerCompradoresPorCursoSP(?)");
        $stmt->bind_param("i", $IdCurso);
        $stmt->execute();
        $result = $stmt->get_result();
        $AlumnosInscritos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $AlumnosInscritos;
    }
    public function EnviarMensaje($idUsuEnv,$idUsuRec,$mensaje)
    {
        $stmt = $this->conex->prepare("CALL InsertarMensaje(?,?,?)");
        $stmt->bind_param("iis", $idUsuEnv,$idUsuRec,$mensaje);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en mensjae: " . $stmt->error);
        }
        $stmt->close();
    }

    public function ReporteA()
    {
        $stmt = $this->conex->prepare("CALL ReporteAlumnos()");
        $stmt->execute();
        $result = $stmt->get_result();
        $MasVendidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $MasVendidos;
    }

    public function ReporteI()
    {
        $stmt = $this->conex->prepare("CALL ReporteInstructores()");
        $stmt->execute();
        $result = $stmt->get_result();
        $MasVendidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $MasVendidos;
    }
}

    

?>