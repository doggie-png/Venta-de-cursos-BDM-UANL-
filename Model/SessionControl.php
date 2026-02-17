<?php

class SessionControl {
    public function SessionStart($usuario)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['Usuario'] = $usuario;
    }

    public function SessionUpdate($nomUsuario, $nombres, $apellidos, $fechaNac, $foto, $extension, $genero, $email, $contra) 
    {
        if (isset($_SESSION['Usuario'])) {
            $_SESSION['Usuario']['NomUsuario'] = $nomUsuario;
            $_SESSION['Usuario']['Nombres'] = $nombres;
            $_SESSION['Usuario']['Apellidos'] = $apellidos;
            $_SESSION['Usuario']['FechaNac'] = $fechaNac;
            $_SESSION['Usuario']['Foto'] = $foto;
            $_SESSION['Usuario']['Extension'] = $extension;
            $_SESSION['Usuario']['Genero'] = $genero;
            $_SESSION['Usuario']['Email'] = $email;
            $_SESSION['Usuario']['Contra'] = $contra;
        }
    }

    public function SessionEnd()
    {
        session_start();
        session_unset();
        session_destroy();
    }

    public function SessionGetID()
    {
        return $_SESSION['Usuario']['IdUsuario'];
    }
}

?>