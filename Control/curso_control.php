<?php

include_once("Model/CursoModel.php");
include_once("Model/SessionControl.php");

$cursoModel = new CursoModel();
$sessionControl = new SessionControl();
$IDUsuario = $sessionControl->SessionGetID();

class curso{
    private $cursoModel;
    private $sessionControl;
    private $IDUsuario;
    public $vista;
    public $alumnos;

    // Constructor para inicializar las dependencias
    public function __construct() {
        $this->cursoModel = new CursoModel(); // Inicializa el modelo del curso
        $this->sessionControl = new SessionControl(); // Inicializa el controlador de sesión
        $this->IDUsuario = $this->sessionControl->SessionGetID(); // Obtiene el ID del usuario
    }
    public function registrar() {
        $this->vista = 'registro-cursos';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['RegCurso'])) {
            $nombreCurso = $_POST['nombre'];
            $descripcionCurso = $_POST['descripcion'];
            $costoCurso = $_POST['precio'];
            $categorias = $_POST['categorias'];
            $foto = null;
            $extension = null;
            $fechaHoy = new DateTime();
            $fechaFormateada = $fechaHoy->format('Y-m-d H:i:s');
    
            // Procesar imagen del curso
            if (isset($_FILES['foto'])) {
                if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                    $tmpFilePath = $_FILES['foto']['tmp_name'];
                    $foto = file_get_contents($tmpFilePath);
                    $fileName = $_FILES['foto']['name'];
                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                } else {
                    echo "<script>alert('Error al subir la imagen: " . $_FILES['foto']['error'] . "');</script>";
                }
            } else {
                echo "<script>alert('No se recibió ningún archivo de imagen.');</script>";
            }
    
            $IdCurso = $this->cursoModel->InsertarCurso($this->IDUsuario, $nombreCurso, $descripcionCurso, $foto, $extension, $costoCurso, $fechaFormateada);
    
            foreach ($categorias as $IdCategoria) {
                $this->cursoModel->AsignarCategorias($IdCategoria, $IdCurso);
            }
    
            $niveles = $_POST['nivel'];
            $numNiveles = count($niveles);
    
            foreach ($niveles as $indice => $nivel) {
                $numeroNivel = $indice;
                $nombreNivel = $nivel['nombre'];
                $tipoRecurso = $nivel['tipo_recurso'];
                $precioNivel = (float)$nivel['precio'];
                $recursoAdicional = null;
                $videoLink = null;
    
                // Verificar si se subió un archivo de video
                if (isset($_FILES['nivel']['name'][$indice]['video']) && $_FILES['nivel']['error'][$indice]['video'] === UPLOAD_ERR_OK) {
                    $videoBasePath = "C:/xampp/htdocs/P_BDM/BDMPIA2.2/View/Videos/";
                    $videoFileName = basename($_FILES['nivel']['name'][$indice]['video']); // Nombre del archivo
                    $tmpVideoPath = $_FILES['nivel']['tmp_name'][$indice]['video']; // Ruta temporal del archivo
    
                    // Verificar que el archivo de video no sea vacío
                    if (!empty($tmpVideoPath)) {
                        // Construir la ruta completa de destino
                        $fullVideoPath = $videoBasePath . $videoFileName;
    
                        // Verificar que la carpeta tenga permisos de escritura
                        if (is_writable($videoBasePath)) {
                            if (move_uploaded_file($tmpVideoPath, $fullVideoPath)) {
                                $videoLink = $fullVideoPath; // Guardar la ruta completa en $videoLink
                            } else {
                                echo "<script>alert('Error al copiar el archivo de video \"$videoFileName\" para el nivel $numeroNivel.');</script>";
                                continue;
                            }
                        } else {
                            echo "<script>alert('La carpeta de videos no tiene permisos de escritura.');</script>";
                            continue;
                        }
                    } else {
                        echo "<script>alert('No se subió un archivo de video para el nivel $numeroNivel.');</script>";
                        continue;
                    }
                }
    
                // Validar el tipo de recurso y mover el archivo correspondiente
                if ($tipoRecurso === 'imagen') {
                    $tmpFilePath = $_FILES['nivel']['tmp_name'][$indice]['recurso'];
                    $typeFile = $_FILES['nivel']['type'][$indice]['recurso'];
                    $fileContent = file_get_contents($tmpFilePath);
                    $recursoAdicional = 'data:' . $typeFile . ';base64,' . base64_encode($fileContent);
                } elseif ($tipoRecurso === 'pdf') {
                    $rutaPdf = "C:/xampp/htdocs/P_BDM/BDMPIA2.2/Model/uploads/nivel_{$IdCurso}_{$numeroNivel}.pdf";
                    if (move_uploaded_file($_FILES['nivel']['tmp_name'][$indice]['recurso'], $rutaPdf)) {
                        $recursoAdicional = $rutaPdf;
                    } else {
                        echo "<script>alert('Error al mover el archivo PDF para el nivel $numeroNivel.');</script>";
                    }
                } elseif ($tipoRecurso === 'url') {
                    $recursoAdicional = $nivel['recurso'];
                }
    
                // Insertar el nivel con su recurso
                $this->cursoModel->InsertarNivel($IdCurso, $numeroNivel, $nombreNivel, $videoLink, $recursoAdicional, $tipoRecurso, $precioNivel);
            }
    
            echo "<script>
                alert('Curso registrado.');
                window.location.href='index.php?control=curso&accion=registrar';
            </script>";
            exit();
        }
    }
    

    public function buscar(){
        $this->vista = 'resultado-busqueda';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['BtnBuscar'])) {
            $busqueda = $_POST['busqueda'] ?? '';
            $tipoBusqueda = $_POST['tipoBusqueda'] ?? 1;
            $categorias = isset($_POST['categorias']) ? implode(',', $_POST['categorias']) : '';
            $fechaMin = $_POST['fechaMinima'];
            $fechaMax = $_POST['fechaMaxima'];
        
            if($categorias === "") {
                $categorias = NULL;
            }
            if($fechaMin === "") {
                $fechaMin = NULL;
            }
            if($fechaMax === "") {
                $fechaMax = NULL;
            }
        
            $cursos = $this->cursoModel->Busqueda($busqueda, $tipoBusqueda, $categorias, $fechaMin, $fechaMax);
            $_SESSION['cursos'] = $cursos;
        }
        else {
            $cursos = $this->cursoModel->Busqueda('', 1, NULL, NULL, NULL);
            $_SESSION['cursos'] = $cursos;
        }
        
        
    }

    public function verinfo(){
        $this->vista='info-curso';
        $idCurso = $_GET['id'] ?? null;
        $InfoCurso = $this->cursoModel->GetInfoCurso($idCurso);
        
        require_once("View/info-curso.php");
    }

    public function comprarcurso() {
        $this->vista='pago';
        $idCurso = $_GET['id'] ?? null;
        $InfoCurso = $this->cursoModel->GetInfoCurso($idCurso);
        require_once("View/pago.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['BtnComprar'])) {
            $idUsuario = $_SESSION['Usuario']['IdUsuario'];
            $metodo = $_POST['tipo-tarjeta'];
            $nivelesOCompleto = $_POST['niveles'];

            if($nivelesOCompleto != "") {
                $this->cursoModel->InsertarCursoComprado($idCurso, $idUsuario, $metodo);

            if ($nivelesOCompleto === "curso-completo") {
                $niveles = $this->cursoModel->ObtenerNivelesPorCurso($idCurso);
                foreach($niveles as $nivel) {
                    $this->cursoModel->InsertarNivelCursando($nivel['IdNivel'], $idUsuario);
                }
            }
            else {
                $nivelesSeleccionados = explode(',', $nivelesOCompleto);
                foreach($nivelesSeleccionados as $idNivel) {
                    $this->cursoModel->InsertarNivelCursando((int)$idNivel, $idUsuario);
                }
            }
            echo "<script>
            alert('Curso comprado exitosamente.');
            window.location.href='index.php?control=curso&accion=VerCursos';
            </script>";
            exit();
            } 
        }
        
    }

    public function detallesVentaCurso(){
        $this->vista = 'Cursos-instructor-detalles';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['verAlumnos'])) {
            $idCurso = $_POST['idCurso'];
            $alumnos = $this->cursoModel->ObtenerCAlumnosInscritos($idCurso);

            if(empty($alumnos)){
                echo "<script>
                alert('No hay alumnos inscritos.');
                window.location.href='index.php?control=curso&accion=VerCursos';
                </script>";
                exit();
            }

            $this->alumnos = $alumnos;
            require_once("View/{$this->vista}.php");
        }
    }
    public function EnviarMensaje(){
        $this->vista = 'Cursos-instructor-detalles';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['enviarMensaje'])) {
            $idUsuarioEnvia = $_POST['IdUsuarioEnviador'];
            $idUsuarioRecepto = $_POST['IdUsuarioReceptor'];
            $mensaje = $_POST['mensaje'];
            $alumnos = $this->cursoModel->EnviarMensaje($idUsuarioEnvia,$idUsuarioRecepto,$mensaje);
                echo "<script>
                alert('Mensaje Enviado.');
                window.location.href='index.php?control=curso&accion=VerCursos';
                </script>";
            exit();
        }
    }

    public function Busqueda(){
        $this->vista = 'resultado-busqueda';        
        $cursos = $this->cursoModel->Busqueda('', 1, null, null, null);
        $_SESSION['cursos'] = $cursos;
        
    }

    public function VerCursos()
    {
        $this->vista = 'cursos';
       
    }

    public function alumnos()
    {
        
        $this->vista = 'reporte';
        $reporteA = $this->cursoModel->ReporteA();
        $_SESSION['ReporteA'] = $reporteA;
        require_once("View/reporte.php");

       
    }

    public function instructor()
    {
        
        $this->vista = 'reporte';
        $reporteI = $this->cursoModel->ReporteI();
        $_SESSION['ReporteI'] = $reporteI;
        require_once("View/reporte.php");
    }

}

?>