<?php

include_once("Model/UsuarioModel.php");
date_default_timezone_set('America/Mexico_City');

class user{
    public $vista;
    public function registrar() {
        
        $this->vista = 'registro';
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['RegistroUsuario'])) {
    
            $user = $_POST['user'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['lastnames'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $fechaNac = $_POST['date'];
            $genero = $_POST['genero'];
            $rol = $_POST['rol'];
            $foto = null;
            $extension = null;
            $fechaHoy = new DateTime();
            $fechaReg = $fechaHoy->format('Y-m-d H:i:s');
        
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['foto']['tmp_name'];
                $foto = file_get_contents($tmpFilePath);
        
                $fileName = $_FILES['foto']['name'];
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            } 
            else {
                echo "<script>alert('Error al subir la imagen.');</script>";
                exit;
            }
        
            $usuarioModel = new UsuarioModel();
            
            if ($usuarioModel->InsertarUsuario($user, $nombre, $apellidos, $fechaNac, $foto, $extension, $genero, $email, $pass, $fechaReg, $rol)) {
                echo "<script>alert('Usuario registrado exitosamente.'); window.location.href='index.php?control=user&accion=loginn';</script>";
                exit();
            }
            else {
                echo "<script>alert('Error al registrar usuario.');</script>";
            }
        
            $usuarioModel->close();
        }
    }
    
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
                $this->vista = 'home';
            }
            else {
                $usuarioModel->AumentarIntentos($emailuser);
                $usuarioModel->close();
                echo "<script>alert('Correo o contraseña incorrecto(s)');</script>";
            }
            
        }

    }

    public function actualizar(){
        $this->vista = 'perfil';
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UpdatePerfil'])) {
            $usuarioModel = new UsuarioModel();
            $sessionControl = new SessionControl();
            $user = $_POST['user'];
            $names = $_POST['names'];
            $lastnames = $_POST['lastnames'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $date = $_POST['date'];
            $genero = $_POST['genero'];
            $foto = null;
            $extension = null;
            $fechaHoy = new DateTime();
            $fechaMod = $fechaHoy->format('Y-m-d H:i:s');
        
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['foto']['tmp_name'];
                $foto = file_get_contents($tmpFilePath);
        
                $fileName = $_FILES['foto']['name'];
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            } 
            else {
                $foto = $_SESSION['Usuario']['Foto'];
                $extension = $_SESSION['Usuario']['Extension'];
            }
        
            $ID = $sessionControl->SessionGetID();
        
            if($usuarioModel->UpdatePerfil($user, $names, $lastnames, $date, $foto, $extension, $genero, $email, $pass, $fechaMod, $ID)) {
                $sessionControl->SessionUpdate($user, $names, $lastnames, $date, $foto, $extension, $genero, $email, $pass);
                $usuarioModel->close();
                echo "<script>
                        alert('Usuario actualizado exitosamente.');
                        window.location.href='index.php?control=user&accion=actualizar';
                      </script>";
                exit();
            }
            else{
                $usuarioModel->close();
                echo "<script>
                        alert('Error al actualizar usuario.');
                        window.location.href='index.php?control=user&accion=actualizar';
                      </script>";
                exit();
            }
        }
    }
}


?>