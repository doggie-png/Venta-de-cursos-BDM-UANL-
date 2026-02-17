<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['Usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['Usuario'];
$fotoBase64 = base64_encode($usuario['Foto']);
$extension = $usuario['Extension'];
$foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;
$rolUser = $usuario['Rol'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="/View/css/KardexCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81e957327f.js" crossorigin="anonymous"></script>
</head>
<body>
<header class="nav-bar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark"  id="barra">
            <div class="container-fluid">
              <div class="navbar-brand">
                <img src= "<?php echo $foto; ?>" alt="" id="img-nav">
                <a class="navbar-brand" href="/view/home.php">Usuario</a> <!--una vez logeado deberia mandar a la ventana de perfil-->
              </div>
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                  <li class="nav-item">
                    <a class="nav-link" href="/view/perfil.php">Perfil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/view/Cursos.php">Cursos</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="/view/mensajes.php">Mensajes</a>
                  </li>
                  <?php
                    if($rolUser == 3){
                      echo '<li class="nav-item">
                        <a class="nav-link" href="reporte.html">Reporte</a>
                      </li>';
                    }
                    
                    if($rolUser==2){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="registro-cursos.php">Vender</a>
                      </li>';
                    }

                    if($rolUser == 1){
                        echo '<li class="nav-item">
                          <a class="nav-link" href="/html/Kardex.php">Kardex</a>
                        </li>';
                    }  
                  ?>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Notificaciones</a>
                  </li>
                  
                </ul>
                <form class="d-flex" role="search" action="resultado-busqueda.html">
                  <input class="form-control me-2" type="search" placeholder="Que necesitas?" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
              </div>
            </div>
          </nav>
    </header>
    <a href="/html/Cursos-alumno.html"><div class="backArrow">
      <i class="fa-solid fa-angles-left"></i>
  </div></a>
    <div class="container" id="contenedor">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="cont-reporte">
                    <img src="/view/imagenes/certificado.jpg" alt="" style="width: 80%;height: 90%;margin-left: 100px;">
                    <div class="Valoracion"> 
                      <h2>Deja tu Valoracion</h2> 
                      <form>
                        <p class="clasificacion">
                          <input id="radio1" type="radio" name="estrellas" value="5"><!--
                          --><label for="radio1">★</label><!--
                          --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                          --><label for="radio2">★</label><!--
                          --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                          --><label for="radio3">★</label><!--
                          --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                          --><label for="radio4">★</label><!--
                          --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                          --><label for="radio5">★</label>
                        </p>
                      </form>
                    </div>
                </div>
                
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script src="/js/reporte.js"></script> 
</body>
</html>