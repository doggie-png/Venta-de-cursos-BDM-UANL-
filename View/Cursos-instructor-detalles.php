<?php

include_once("Model/CursoModel.php");
include_once("Model/SessionControl.php");

$usuarioInfo = new SessionControl();
$idUsuario = $usuarioInfo->SessionGetID();


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis cursos</title>
    <link rel="stylesheet" href="view/css/Compras.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <!--Carrito de compras-->
    
    <div class="container text-center" id="perfil">
      <div class="row align-items-center">
        <h1>Nombre del curso</h1>
        <div class="col-md-12 col-lg-12"   id="listass" >
          <div class="filtros">
            <h2>Alumnos Inscritos: <?php echo count($alumnos); ?></h2>
          </div>
          <div class="productos">
            <ul>
              <?php foreach ($alumnos as $alumno) { ?>
                  <li>
                      <div class="cont-producto">
                          <div class="cards-wrapper" >
                          <?php   $fotoBase64 = base64_encode($alumno['FotoUsuario']);
                                            $extension = $alumno['ExtensionFoto'];
                                            $foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;?>
                              <div class="card-img">
                                  <img src="<?php echo $foto ?>" class="img-usuarioAlumno" alt="">
                              </div>
                              <div class="text">
                                  <h3>Nombre del alumno: <?php echo htmlspecialchars($alumno['Nombres'] . ' ' . $alumno['Apellidos']); ?></h3>
                                  <br>
                                  <h3>Fecha de inscripción: <?php echo htmlspecialchars($alumno['FechaComprado']); ?></h3>
                                  <br>
                                  <h3>Nivel de avance: <?php echo htmlspecialchars($alumno['ProgresoTotal']); ?></h3>
                                  <br>
                                  <h3>Metodo de pago: <?php echo htmlspecialchars($alumno['FormaPago']); ?></h3>
                                  <form action="index.php?control=curso&accion=EnviarMensaje" id="profile-form" method="POST" enctype="multipart/form-data" class="formRegCat">
                                      
                                      <input type="hidden" name="IdUsuarioReceptor" value="<?php echo $alumno['IdUsuario']; ?>"> 
                                      <input type="hidden" name="IdUsuarioEnviador" value="<?php echo $idUsuario; ?>"> 

                                      
                                      <div class="mb-3">
                                          <label for="mensaje" class="form-label">Mensaje:</label>
                                          <input class="form-control" id="mensaje" name="mensaje" rows="4" required></input> 
                                      </div>

                                      
                                      <div class="d-flex justify-content-center">
                                          <button type="submit" class="btn btn-primary " id="btn-primary" name="enviarMensaje">Enviar Mensaje</button>
                                      </div>
                                  </form>


                              </div>
                          </div>
                      </div>
                  </li>
              <?php } ?>
            </ul>            
          </div>          
        </div>
      </div>
    </div>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
