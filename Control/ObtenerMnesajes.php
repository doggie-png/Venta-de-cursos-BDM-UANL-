<?php
include_once("../Modelos/mensajeModel.php");

if (isset($_GET['idVendedor'])) {
    $idVendedor = $_GET['idVendedor'];
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        echo json_encode([]);  // No está logueado
        exit();
    }

    $usuario = $_SESSION['usuario'];
    $idUsuario = $usuario['IdUsuario'];

    $mensajesModel = new MensajeModel();
    
    // Obtener los mensajes entre el usuario y el vendedor seleccionado
    $mensajes = $mensajesModel->GetMensajesChat($idUsuario, $idVendedor);

    if ($mensajes === false) {
        echo json_encode(['error' => 'No se pudieron obtener los mensajes']);
        exit();
    }

    // Formatear los mensajes para devolverlos en formato JSON
    $resultados = [];

    foreach ($mensajes as $mensaje) {
        $resultados[] = [
            'mensaje' => $mensaje['mensaje'],
            'tipo' => ($mensaje['idUusarioReceptor'] == $idVendedor) ? 'vendedor' : 'comprador',
        ];
    }

    echo json_encode($resultados);
} else {
    echo json_encode(['error' => 'Faltan parámetros']);
}

?>
