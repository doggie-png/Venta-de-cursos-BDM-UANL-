<?php
include_once("Modelos/mensajeModel.php");
include_once("Modelos/SessionControl.php");

$mensajeModel = new MensajeModel();

$usuario = $_SESSION['usuario'];

class Enviar_Mensaje{
  public $vista;
  public function SendMSJ(){
    $this->vista = 'no se que vaya aqui jajajjaja';
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['EnviarMensaje'])) {
      $mensaje = $_POST['Mensaje'];
      $idUsuarioEnviador=$_POST['IdUsuario'];
      if(isset($_POST['idVendedor'])){
        $idUsuarioReceptor=$_POST['idVendedor'];
      }
      if(isset($_POST['idVendedor2'])){
        $idUsuarioReceptor=$_POST['idVendedor2'];
      }
  
      if(empty($mensaje)||$idUsuarioReceptor==$usuario['IdUsuario']){
        echo"<script>
                  alert('NO puedes mandar un mensaje vacio.');
                  window.location.href='../Paginas/mensajes.php';
                </script>";
                exit();
      }
      
      $mensajeModel->InsertarMensaje($idUsuarioEnviador, $idUsuarioReceptor,$mensaje);
      echo "<script>
                  window.location.href='../Paginas/mensajes.php';
                </script>";
          exit();
  }
  
  }
}


?>