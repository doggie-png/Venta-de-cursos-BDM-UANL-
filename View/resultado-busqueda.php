<?php
include_once("Model/CategoriaModel.php");
include_once("Model/CursoModel.php");
$categoriaModel = new CategoriaModel();
$categorias = $categoriaModel->GetCategorias();
$cursos=$_SESSION['cursos'];
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="View/css/resultado-busqueda.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



    <div class="container text-center" id="resultados">
        <div class="row align-items-start">
          <div class="col-sm-4 col-xl-4" id="filtros">
            <form action="index.php?control=curso&accion=buscar" method="POST" id="formBusqueda">
            <h1 style="margin-top: 15px;">Buscador</h1>
            <input class="form-control me-2" name="busqueda" type="search" placeholder="Que necesitas?" aria-label="Search" style="margin-top:15px; margin-bottom:15px;">
            <button class="btn btn-outline-success" name="BtnBuscar" type="submit">Buscar</button>
            <h2 style="margin-top: 15px;">Filtros disponibles</h2>
            <br>

            <div class="filtro-categorias">
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample" id="desplegar-categoria">
                Categorias
              </button>
              <div class="collapse" id="collapseExample3">
                <div id="Categoria">
                  <?php foreach ($categorias as $categoria): ?>
                    <div>
                      <input type="checkbox" name="categorias[]" value="<?php echo $categoria['IdCategoria']; ?>">
                      <label><?php echo htmlspecialchars($categoria['Nombre']); ?></label>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <br>

            <div class="filtro-precio">
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample" id="desplegar-categoria">
                Titulo o Nombre
              </button>
              <div class="collapse" id="collapseExample1">
                <div id="TitleOrName">
                  <select name="tipoBusqueda">
                    <option value="1">Por titulo</option>
                    <option value="2">Por nombre</option>
                  </select>
                </div>
              </div>
              
            </div>
            <br>

            <div class="contenedor-filtro" id="filtro-perfil-producto">
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="desplegar-categoria">
                Fecha de Publicacion
              </button>
              <div class="collapse" id="collapseExample">
                <div id="cont-producto-perfil">
                  <div id="Fecha-Min">
                    <h4>Fecha minima</h4>
                    <input type="date" name="fechaMinima" id="FechaMinima" style="margin-bottom: 15px;">
                  </div>

                  <div id="Fecha-Max">
                    <h4>Fecha maxima</h4>
                  <input type="date" name="fechaMaxima" id="FechaMaxima">
                  </div>

                </div>
              </div>
            </div>
            <br>
            </form>

          </div>

          <div class="col-sm-8 col-xl-8" >       
            <div class="row" >
            <?php
            $mostrados = [];
            foreach ($cursos as $curso):
                // Evitar cursos repetidos usando IdCurso
                if (in_array($curso['IdCurso'], $mostrados)) {
                    continue;
                }
                $mostrados[] = $curso['IdCurso'];
            ?>
            <div class="col-md-6 col-xl-4">
                <div class="card" id="tarjeta">
                    <img src="data:image/<?php echo $curso['Extension']; ?>;base64,<?php echo base64_encode($curso['Foto']); ?>" class="card-img-top" alt="Imagen del curso">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($curso['NombreCurso']); ?></h5>
                        <p class="card-text">Instructor: <?php echo htmlspecialchars($curso['UsuarioInstructor']); ?></p>
                        <p class="card-text">Costo: $<?php echo htmlspecialchars($curso['Costo']); ?></p>
                        <a href="index.php?control=curso&accion=verinfo&id=<?php echo $curso['IdCurso']; ?>" class="btn btn-primary">Ver curso</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            </div>
                
          </div>

        </div>
    </div>
  
  <!--boton y ventana modal-->
  <!--
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  -->

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
    <script src="js/main.js"></script>
</body>
</html>