<?php

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="/View/css/KardexCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/81e957327f.js" crossorigin="anonymous"></script>
</head>

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
