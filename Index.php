<?php
require_once("config.php");
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['Usuario'])) {
    $usuario = $_SESSION['Usuario'];
    $fotoBase64 = base64_encode($usuario['Foto']);
    $extension = $usuario['Extension'];
    $foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;
    $rolUser = $usuario['Rol'];
    $vistaP = 'home';
    
    
}else{
    
    $vistaP = default_view;
    
}

if (isset($_GET['vistaP'])) {
  $vistaP = $_GET['vistaP'];
}

?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php if (isset($_SESSION['Usuario'])):?>
    <header class="nav-bar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark"  id="barra">
            <div class="container-fluid">
              <div class="navbar-brand">
                <img src= "<?php echo $foto; ?>" alt="" id="img-nav" style="width: 45px; height: 45px; margin-right: 10px;">
                <a class="navbar-brand" href="index.php?control=Home&accion=ver">Home</a> <!--una vez logeado deberia mandar a la ventana de perfil-->
              </div>
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?control=user&accion=actualizar">Perfil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?control=curso&accion=Vercursos">Cursos</a>
                  </li>
                  <?php if($rolUser == 3){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="index.php?control=categoria&accion=AgregarCategoria">Crear categoria</a>
                    </li>';
                  }
                  ?>
                  <?php if($rolUser == 3){
                    echo '<li class="nav-item">
                    <a class="nav-link" href="index.php?control=categoria&accion=Editar">Ver Categorias </a>
                    </li>';
                  }
                  ?>
                  
                  
                  
                  <?php
                    if($rolUser == 1 || $rolUser == 2){
                      echo '<li class="nav-item">
                        <a class="nav-link" href="index.php?control=Mensajes&accion=GetMSJTotales">Mensajes</a>
                      </li>';
                    }

                    if($rolUser == 3){
                      echo '<li class="nav-item">
                        <a class="nav-link" href="index.php?control=reporte&accion=ver">Reporte</a>
                      </li>';
                    }
                    
                    if($rolUser==2){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="index.php?control=curso&accion=registrar">Vender</a>
                      </li>';
                    }

                    if($rolUser == 1){
                        echo '<li class="nav-item">
                          <a class="nav-link" href="index.php?control=kardex&accion=verkardex">Kardex</a>
                        </li>';
                    }  
                  ?>
             
                </ul>
                <form class="d-flex" role="search" action="index.php?control=curso&accion=Busqueda" method="POST" enctype="multipart/form-data">
                  <input type="hidden" value="0">
                  <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
              </div>
            </div>
        </nav>
    </header>
    <?php endif?>
    
    <?php
        // Controlador y acción
        if(!empty($_GET['control'])){
            $controlador = $_GET['control'];
        } else {
            $controlador = 'default_controller'; // Definir controlador por defecto
        }

        if(!empty($_GET['accion'])){
            $accion = $_GET['accion'];
        } else {
            $accion = 'default_action';
        }

        $controlador_archivo = 'Control/'.$controlador.'_control.php';
        if (is_file($controlador_archivo)){
            require_once($controlador_archivo);
            $contrlObj = new $controlador;
            $contrlObj->$accion();
            $vistaP = $contrlObj->vista;
        }

        require_once('View/'.$vistaP.'.php');
    ?>

</body>
</html>