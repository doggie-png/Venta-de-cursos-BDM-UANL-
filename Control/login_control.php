<?php

include_once("Model/UsuarioModel.php");
include_once("Model/SessionControl.php");

class login{
    public $vista;
    public function loginn(){
        $this->vista = 'login';
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Login'])) {
            
            
            $usuarioModel = new UsuarioModel();
            $sessionControl = new SessionControl();
            $emailuser = $_POST['emailuser'];
            $pass = $_POST['pass'];
    
            $intentos = $usuarioModel->LeerIntentos($emailuser);
            if ($intentos >= 3) {
                echo "<script>alert('Este usuario esta bloqueado');</script>";
                exit();
            }
            
            $result = $usuarioModel->IniciarSesion($emailuser, $pass);

            if($result->num_rows > 0){ 
                $usuario = $result->fetch_assoc();
    
                $usuarioModel->ReestablecerIntentos($emailuser);
                $sessionControl->SessionStart($usuario);
                $usuarioModel->close();
                echo "<script>
                
                window.location.href='index.php';
              </script>";
        exit();
            }
            else {
                $usuarioModel->AumentarIntentos($emailuser);
                $usuarioModel->close();
                echo "<script>alert('Correo o contraseña incorrecto(s)');</script>";
            }
            
        }

    }
}



?>