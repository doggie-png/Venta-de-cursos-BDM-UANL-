<?php
  require_once("Control/Home_control.php");
  include_once("Model/CursoModel.php");
  $cursoModel = new CursoModel();
  $MasVendidos = $cursoModel->GetMasVendidos();
  $MasCalificados = $cursoModel->GetMasCalificados();
  $MasRecientes = $cursoModel->GetMasRecientes();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose and Enjoy</title>
    <link rel="stylesheet" href="view/css/home.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



    <!--pubilicidad por imagen-->

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="view/imagenes/000c9b6d79f3f5c5c309bc3ec0819476.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="view/imagenes/Partes-de-un-escenario.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="view/imagenes/WhatsApp Image 2024-08-15 at 11.19.49 PM.jpeg" class="d-block w-100" alt="hola">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" id="anterior" >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" id="siguiente">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--carrucel con tarjetas de productos-->
    <div class="container py-4" id="cont">
      <h1 class="mb-4 text-center">Cursos más vendidos</h1>
      <div class="row g-3">
        <?php foreach ($MasVendidos as $masvendidoss): ?>
          <?php 
            $fotoBase64 = base64_encode($masvendidoss['Foto']);
            $extension = $masvendidoss['Extension'];
            $foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;  
          ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card mx-auto" style="width: 100%;" id="Publicidad">
              <img src="<?php echo $foto ?>" class="card-img-top" alt="Curso">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($masvendidoss['Nombre']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($masvendidoss['Descripcion']); ?></p>
                <a href="index.php?control=curso&accion=verinfo&id=<?php echo $masvendidoss['IdCUrso']; ?>" class="btn btn-primary">Ver curso</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>


    

    <!--carrucel productos 3-->

    <div class="container" id="carousel2"  >
      <h1>Mejores calificados</h1>
      <div class="row align-items-center" id="Opciones">

          <div class="col-XS-6" id="Login">
          <ul>
            <?php foreach($MasCalificados as $mascalificados):?>
            <div class="col-XS-6" id="Login">
              <div class="card" style="width: 18rem;" id="Publicidad">
                <img src="imagenes/Partes-de-un-escenario.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $mascalificados['Nombre']; ?></h5>
                  <p class="card-text"><?php echo $mascalificados['Descripcion']; ?></p>
                  <a href="#" class="btn btn-primary">Ver Curso</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </ul>
          </div>

      </div>

  </div>

  
    <!--basado en historial-->

    <div class="container" id="carousel3">
      <h1 class="mb-4">Publicados recientemente</h1>
      <div class="row justify-content-center g-3">
        <?php foreach($MasRecientes as $masrecientes): ?>
          <?php 
            $fotoBase64 = base64_encode($masrecientes['Foto']);
            $extension = $masrecientes['Extension'];
            $foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;  
          ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card mx-auto" style="width: 100%;" id="Publicidad">
              <img src="<?php echo $foto; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($masrecientes['Nombre']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($masrecientes['Descripcion']); ?></p>
                <a href="index.php?control=curso&accion=verinfo&id=<?php echo $masrecientes['IdCurso']; ?>" class="btn btn-primary">Ver curso</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>


    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Notificaciones</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            No hay notificaciones nuevas
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>
    
    

    <footer>
        <div class="footer-content">
            <h3>Choose and Enjoy</h3>
            <p> Si lo deseas, lo obtienes.
            </p>
            <ul class="socials">
                <li><a href="https://www.facebook.com/julio.morfin.750/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2020 Fenix Corp. designed by <span>DOGGIE</span></p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

