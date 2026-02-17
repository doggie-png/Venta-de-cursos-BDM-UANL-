<?php
include_once("Model/CategoriaModel.php");
$categoriaModel = new CategoriaModel();
$categorias = $categoriaModel->GetCategorias();
include_once("Control/curso_control.php");

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Curso</title>
    <link rel="stylesheet" href="View/css/registro-cursos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="View/js/ImgPreview.js"></script>
    <script src="View/js/CursoRegistro2.js"></script>
    <style>
      #AgrNivel {
        display: block;
        margin: 0 auto;
      }
    </style>
</head>
    
  <form id="RegistarCurso" action="index.php?control=curso&accion=registrar" method="POST" enctype="multipart/form-data">
    <div class="container" id="cont-curso">
      <div class="row">
          <div class="col-md-6 col-lg-4">
              <h2>Nombre del Curso</h2>
              <input class="input-curso" type="text" name="nombre" id="nombre">
              <br>
              <h2>Descripcion del Curso</h2>
              <textarea class="input-curos" name="descripcion" id="descripcion" rows="3" style="width: 100%;"></textarea>
              <br>
              <h2>Imagen</h2>
              <input type="file" class="input-curso" id="img-curso" name="foto" accept="image/*" onchange="previewImage(event)">
              <br>
              <h2>Categoria</h2>
              <select name="categorias[]" id="categorias" style="text-align: center; width: 100%" multiple>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['IdCategoria']; ?>">
                    <?php echo $categoria['Nombre']; ?>
                    </option>
                <?php endforeach; ?>
              </select>
              <br>
              <h2>Precio</h2>
              <input class="input-curso" type="number" name="precio" id="precio" step="0.01" placeholder="0.00">
              <br>
              <button id="btn-curso" name="RegCurso" type="submit">Registrar Curso</button>
          </div>
        

        <div class="col-md-6 col-lg-8">
          <div class="img-curso">
            <img src="" class="d-block w-100" id="imgpreview" name="fotopreview" style="max-height: 500px;">
          </div>
        </div>
      </div>
      <div style="text-align:center;">
        <button id="AgrNivel" type="button" onclick="agregarNivel()">Agregar Nivel</button>
      </div>
    </div>

    <div class="container" style="margin-top: 15vh;">
      <h2>Niveles</h2>
      <div id="niveles-container" style="padding: 15px;">
        <div class="nivel" id="nivel-0" style="background-color: violet; margin-bottom: 20px; padding: 15px;">
            <h3>Nivel 1</h3>
            <h3>Nombre:</h3>
            <input type="text" class="input-curso" name="nivel[0][nombre]" placeholder="Nombre">
            <br>
            <h3>Precio del Nivel:</h3>
            <input type="number" class="input-curso" name="nivel[0][precio]" step="0.01" placeholder="0.00">
            <br>
            <h3>Video:</h3>
            <input type="file" id="video" class="input-curso" name="nivel[0][video]" accept="video/*">
            <br>
            <h3>Recurso adicional</h3>
            <select class="input-curso" id="tipoRecurso" name="nivel[0][tipo_recurso]" onchange="mostrarInputRecurso(this)" style="margin-bottom: 20px;">
                <option value="">Seleccione un tipo de recurso</option>
                <option value="imagen">Imagen</option>
                <option value="pdf">PDF</option>
                <option value="url">URL</option>
            </select>
            <div class="input-recurso-container"></div>
        </div>
      </div>
    </div>
  </form>

    

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
