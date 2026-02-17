<?php
include_once("Model/mensajeModel.php");
include_once("Model/SessionControl.php");

class Mensajes {
    public $vista;
    private $mensajeModel;
    private $usuario;

    // Constructor para inicializar el modelo y sesión
    public function __construct() {
        $this->mensajeModel = new MensajeModel();
        $this->usuario = $_SESSION['Usuario'];
    }

    public function GetMSJTotales() {
        $this->vista = 'mensajes';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ObtenerMensaje'])) {
            $idUsuarioEnviador = $this->usuario['IdUsuario'];
            
            if (!$this->mensajeModel->GetMensajesTotales($idUsuarioEnviador)) {
                echo "<script>
                          alert('No hay ningún mensaje, envía un mensaje primero.');
                          window.location.href='../index.php';
                      </script>";
                exit();
            }
        }
    }

    public function GetMSJ() {
        $this->vista = 'mensajes';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ObtenerMensaje'])) {
            $idUsuarioEnviador = $_POST['IdUsuario'];
            $idUsuarioReceptor = $_GET['idReceptor'];
            
            $this->mensajeModel->GetMensajesChat($idUsuarioEnviador, $idUsuarioReceptor);
            exit();
        }
    }

    public function SendMSJ() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['EnviarMensaje'])) {
            $idReceptor = trim($_POST['idReceptor']); // Limpia espacios
            $idEnviador = trim($_POST['idEnviador']); // Limpia espacios
            $mensaje = trim($_POST['mensaje']);
            echo $idReceptor;
            if (!empty($idReceptor) && !empty($idEnviador) && !empty($mensaje)) {
                $this->mensajeModel->InsertarMensaje($idEnviador, $idReceptor, $mensaje);
                echo "<script>
                        window.location.href='index.php?control=mensajes&accion=GetMSJ&idReceptor=$idReceptor';
                      </script>";
            } else {
                echo "<script>alert('Por favor completa todos los campos.');</script>";
            }
        }
    }
    
    
  

    public function Mensajes() {
        $this->vista = 'mensajes';
    }
}
?>
