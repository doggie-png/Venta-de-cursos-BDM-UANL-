<?php

include_once("Model/UsuarioModel.php");
include_once("Model/SessionControl.php");
class perfil{
    public $vista;
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
                        window.location.href='index.php?control=perfil&accion=actualizar';
                      </script>";
                exit();
            }
            else{
                $usuarioModel->close();
                echo "<script>
                        alert('Error al actualizar usuario.');
                        window.location.href='index.php?control=perfil&accion=actualizar';
                      </script>";
                exit();
            }
        }
    }
}


?>