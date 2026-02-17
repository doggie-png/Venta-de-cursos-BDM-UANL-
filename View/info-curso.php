<?php
    include_once("Model/CursoModel.php");
    $cursoModel = new CursoModel();
    $idCurso = $_GET['id'];
    $MasVendedor = $cursoModel->GetMasVendedor($idCurso);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link rel="stylesheet" href="View/css/info-curso.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>


    <div class="container">
        <div class="row" style="margin-top: 5%;" >
        <div class="col-md-6 col-lg-6">
            <div class="imagenes">
                <!-- Mostrar la foto del curso -->
                <img 
                    src="data:image/<?php echo $InfoCurso['curso']['Extension']; ?>;base64,<?php echo base64_encode($InfoCurso['curso']['Foto']); ?>" 
                    class="d-block w-100" 
                    alt="Imagen del curso"
                    style="max-height: 450px; width:auto;">
            </div>
        </div>

            <div class="col-md-6 col-lg-6">
                <div class="info-curso" style="background-color: aqua;">
                <h1><?php echo htmlspecialchars($InfoCurso['curso']['Nombre']); ?></h1>
                        <br>
                        <h2>Niveles totales: <?php echo htmlspecialchars($InfoCurso['niveles']['TotalNiveles']); ?></h2>
                        <br>
                        <h2>Precio: $<?php echo htmlspecialchars($InfoCurso['curso']['Costo']); ?></h2>
                        <br>
                        <div class="calificacion">
                            <h2>Calificación: </h2>
                            <?php
                            // Código de estrellas dinámicas
                            $calificacion = $InfoCurso['curso']['Calificacion'];
                            $estrellasCompletas = floor($calificacion);
                            $mediaEstrella = ($calificacion - $estrellasCompletas >= 0.5) ? 1 : 0;
                            $estrellasVacias = 5 - ($estrellasCompletas + $mediaEstrella);

                            for ($i = 0; $i < $estrellasCompletas; $i++) {
                                echo '<i class="fa fa-star" style="color: gold;"></i>';
                            }
                            if ($mediaEstrella) {
                                echo '<i class="fa fa-star-half-stroke" style="color: gold;"></i>';
                            }
                            for ($i = 0; $i < $estrellasVacias; $i++) {
                                echo '<i class="fa fa-star-o" style="color: gray;"></i>';
                            }
                            ?>
                        </div>
                        <br>
                        <h2>Descripcion:</h2>
                        <p><?php echo htmlspecialchars($InfoCurso['curso']['Descripcion']); ?></p>
                        <!-- <div class="envio-datos">
                            <button class="btn-p" type="submit" id="btn-comprar">Comprar</button>
                        </div> -->
                        <?php if($_SESSION['Usuario']['Rol'] == '1'): ?>
                            <a href="index.php?control=curso&accion=comprarcurso&id=<?php echo $InfoCurso['curso']['IdCurso']; ?>" class="btn-p" id="btn-comprar" style="color: black;">Comprar</a>
                        <?php endif; ?>         
                </div>
            </div>
        </div>

        <div class="row" id="caracteristicas" style="margin-top: 5%;">
            <div class="col-md-12">
                <div class="caracteristicas">
                    <!-- Características del curso -->
                    <div class="caract">
                        <h3>Niveles</h3>
                        <ul class="niveles-lista">
                        <?php
                        if (!empty($InfoCurso['detalles_niveles'])) {
                            foreach ($InfoCurso['detalles_niveles'] as $index => $nivel) {
                                echo '<li class="list-group-item">';
                                echo '<strong>Nivel ' . ($index + 1) . ':</strong> ' . htmlspecialchars($nivel['NombreNivel']);
                                echo '</li>';
                            }
                        }   
                        else {
                        echo '<li class="list-group-item">No hay niveles disponibles para este curso.</li>';
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="Segundo-bloque-publicidad" style="margin-top: 5%;">
            <div class="col-md-12">
                <div class="productos-del-vendedor" id="vendedor">
                    <!--productos del vendedor-->
                    <h3>Mas cursos del instructor</h3>
                    <div>
                        <ul id="moreVendedor">
                        <?php foreach($MasVendedor as $MasVendedorr):?>
                        <div class="col-XS-6" id="Login">
                        <div class="card" style="width: 18rem;" id="Publicidad">
                            <img src="imagenes/Partes-de-un-escenario.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title"><?php echo $MasVendedorr['Nombre']; ?></h5>
                            <p class="card-text"><?php echo $MasVendedorr['Descripcion']; ?></p>
                            <a href="#" class="btn btn-primary">Ver Curso</a>
                            </div>
                        </div>
                        </div>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="P-R" style="margin-top: 5%;">
            <h3>Comentarios</h3>

            <div class="col-md-12">
                <div class="PRR">
                    <div class="PR">
                        <h4>Tu pregunta xd xd</h4>
                        <p>La respuesta del vendedor</p>
                    </div>
    
                    <div class="PR">
                        <h4>El producto viene con cargador europeo?</h4>
                        <p>El producto cuenta con ambos cargadores, tanto mexicano como europeo</p>
                    </div>
    
                    <div class="PR">
                        <h4>El producto viene con cargador europeo?</h4>
                        <p>El producto cuenta con ambos cargadores, tanto mexicano como europeo</p>
                    </div>
    
                    <div class="PR">
                        <h4>El producto viene con cargador europeo?</h4>
                        <p>El producto cuenta con ambos cargadores, tanto mexicano como europeo</p>
                    </div>
    
                    <div class="PR">
                        <h4>El producto viene con cargador europeo?</h4>
                        <p>El producto cuenta con ambos cargadores, tanto mexicano como europeo</p>
                    </div>
    
                </div>
            </div>
            
        </div>

    </div>

    <!--quien documenta todo?-->

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
</body>
</html>