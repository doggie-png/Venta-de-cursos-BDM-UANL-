<?php
  include_once("Model/mensajeModel.php");
  include_once("Model/SessionControl.php");

  // Obtener el ID del usuario actual
  $usuario = new SessionControl();
  $idUsuario = $usuario->SessionGetID();

  // Crear instancia del modelo de mensajes
  $mensajes = new MensajeModel();

  // Obtener todos los mensajes del usuario
  $mensajesTotales = $mensajes->GetMensajesTotales($idUsuario);

  // Para evitar usuarios repetidos
  $usuariosMostrados = [];

  // Si el usuario hace clic en un chat específico, obtener los mensajes de ese chat
  if (isset($_GET['idReceptor'])) {
    $idReceptor = $_GET['idReceptor']; // Elimina espacios adicionales
    // Obtener los mensajes para este receptor específico
    $mensajesChat = $mensajes->GetMensajesChat($idUsuario, $idReceptor);
  } else {
    $mensajesChat = [];
    $idReceptor = null; // Si no se selecciona receptor, el valor de idReceptor es null
  }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="stylesheet" href="View/css/mensajes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<div class="container text-center" id="contenedor">
  <div class="row align-items-center">
    <!-- Sidebar con cursos y usuarios -->
    <div class="col-md-12 col-xl-4" id="nota-compra">
      <div class="chats">
        <h1>Chats</h1>
        
        <?php foreach ($mensajesTotales as $mensaje): ?>
          <?php
            // Mostrar los nombres de los emisores y receptores sin duplicados
            $idReceptorChat = ($mensaje['IdEmisor'] == $idUsuario) ? $mensaje['IdReceptor'] : $mensaje['IdEmisor'];
            
            // Si el receptor ya ha sido mostrado, saltar este ciclo
            if (in_array($idReceptorChat, $usuariosMostrados)) {
              continue;
            }
            
            $usuariosMostrados[] = $idReceptorChat; // Marcar al usuario como mostrado
            if($mensaje['ReceptorNombre'] == $_SESSION['Usuario']['Nombres']) {
              $nombreUsuario = $mensaje['EmisorNombre'];
            } else {
              $nombreUsuario = $mensaje['ReceptorNombre'];
            }
          ?>
          
          <div class="contacto">
            <div class="usuario">
              <p>
                <?php echo htmlspecialchars($nombreUsuario); ?>
                <a href="index.php?control=mensajes&accion=GetMSJ&idReceptor=<?php echo $idReceptorChat; ?>" style="margin-left:30px;text-decoration:none;">Ver Mensajes</a>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Mensajes en detalle -->
    <div class="col-md-12 col-xl-8" id="Chat">
      <div class="mensajes-vista">
        <div class="vendedor">
          <h1>Conversación</h1>
        </div>

        <div class="view">
          <div class="conversacion">
            <?php if (!empty($mensajesChat)): ?>
              <?php foreach ($mensajesChat as $msg): ?>
                <div class="<?php echo ($msg['IdEmisor'] == $idUsuario) ? 'mover' : 'hola'; ?>">
                  <div class="<?php echo ($msg['IdEmisor'] == $idUsuario) ? 'msj-comprador' : 'msj-vendedor'; ?>">
                    <p><?php echo htmlspecialchars($msg['Contenido']); ?></p>
                    <p id="hora"><?php echo date("H:i", strtotime($msg['FechaEnvio'])); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No hay mensajes aún.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Formulario para enviar mensaje -->
        <div class="inputs">
        <?php if (isset($idReceptor)): ?>
            <form action="index.php?control=Mensajes&accion=SendMSJ" method="POST">
                <input type="hidden" name="idReceptor" value="<?php echo htmlspecialchars($idReceptor); ?>">
                <input type="hidden" name="idEnviador" value="<?php echo htmlspecialchars($idUsuario); ?>">
                <input type="text" name="mensaje" id="mensaje" placeholder="Escribe un mensaje" required>
                <button type="submit" id="EnviarMensaje" name="EnviarMensaje">Enviar</button>
            </form>
        <?php else: ?>
            <p>Selecciona un chat para enviar un mensaje.</p>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/main.js"></script>

<style>
  #Chat .conversacion {
    max-height: 70vh;
    overflow-y: auto; 
  }

  .msj-vendedor, .msj-comprador {
    word-wrap: break-word; 
    white-space: pre-wrap; 
  }

  @media (max-width: 768px) {
    #contenedor {
      padding: 15px;
    }

    .col-md-12.col-xl-4, .col-md-12.col-xl-8 {
      margin-bottom: 20px;
    }

    .chats {
      overflow-x: auto;
    }

    #Chat .view {
      padding: 10px;
    }
    
    .inputs {
      margin-top: 10px;
    }
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Seleccionar el contenedor de los mensajes
    var conversacion = document.querySelector("#Chat .conversacion");
    if (conversacion) {
      // Desplazarse automáticamente al final
      conversacion.scrollTop = conversacion.scrollHeight;
    }
  });
</script>
