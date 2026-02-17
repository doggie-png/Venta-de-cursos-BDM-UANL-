<?php
session_start(); // Inicia la sesión si aún no está iniciada

// Destruir la sesión
session_unset();  // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir a la página de inicio (landing page)
header("Location: ../index.php");
exit(); // Asegura que el script no continúe ejecutándose
?>