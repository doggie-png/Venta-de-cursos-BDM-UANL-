<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Curso</title>
    <link rel="stylesheet" href="View/css/pagocurso.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .check-container {
            margin-top: 10px;
        }
        .check-container label {
            display: block;
        }
        .product-info, .levels-info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container" id="all">
        <div class="row align-items-start">

            <!-- Columna izquierda con el curso y niveles -->
            <div class="col-md-6 col-xl-4" id="cont-producto"> 
                <div class="Producto">
                    <div class="card" id="tarjeta">
                        <img src="data:image/<?php echo $InfoCurso['curso']['Extension']; ?>;base64,<?php echo base64_encode($InfoCurso['curso']['Foto']); ?>" class="card-img-top" alt="Curso">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($InfoCurso['curso']['Nombre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($InfoCurso['curso']['Descripcion']); ?></p>
                            <p>$<?php echo htmlspecialchars($InfoCurso['curso']['Costo']); ?></p>
                            <div id="precio-curso" data-precio="<?php echo $InfoCurso['curso']['Costo']; ?>" style="display:none;"></div>

                            <!-- Checkbox para seleccionar el curso completo -->
                            <div class="check-container">
                                <input type="checkbox" id="check-curso-completo">
                                <label for="check-curso-completo">Comprar curso completo</label>
                            </div>

                            <!-- Niveles del curso -->
                            <div class="levels-info">
                                <div id="levels-section">
                                <h5>Niveles</h5>
                                <?php 
                                if(!empty($InfoCurso['detalles_niveles'])) {
                                    foreach ($InfoCurso['detalles_niveles'] as $index => $nivel) {
                                        ?>
                                        <div class="check-container">
                                            <input type="checkbox" class="check-nivel" id="nivel-<?php echo $nivel['IdNivel']; ?>" value="<?php echo $nivel['IdNivel']; ?>" data-precio="<?php echo $nivel['PrecioIndividual']; ?>">
                                            <label for="nivel-<?php echo $nivel['IdNivel']; ?>"><?php echo $nivel['NumNivel'] + 1 ?>. <?php echo $nivel['NombreNivel']; ?> - $<?php echo number_format($nivel['PrecioIndividual'], 2); ?></label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna derecha con el ticket de compra -->
            <div class="col-md-6 col-xl-4">
                <div class="ticket">
                    <h1>Ticket de compra</h1>
                    <br>
                    <h3 id="ticket-total">Total: $0</h3>
                </div>
            </div>

            <!-- Columna para la tarjeta de pago -->
            <div class="col-md-12 col-xl-4" id="contenedor-tarjeta">
                <div class="tarjeta">
                    <form id="pagarCurso" method="POST">
                        <!-- ID del curso -->
                        <input type="text" name="id-curso" id="id-curso" value="<?php echo $InfoCurso['curso']['IdCurso']; ?>">

                        <!-- IDs de los niveles seleccionados -->
                        <input type="text" name="niveles" id="niveles-seleccionados">

                        <!-- Selección de tarjeta: Débito o Crédito -->
                        <div class="data-tarjeta">
                            <h3>Seleccionar tipo de tarjeta</h3>
                            <label>
                                <input type="radio" name="tipo-tarjeta" value="debito" id="tipo-debito" checked> Débito
                            </label>
                            <label>
                                <input type="radio" name="tipo-tarjeta" value="credito" id="tipo-credito"> Crédito
                            </label>
                        </div>

                        <!-- Información de la tarjeta -->
                        <div class="data-tarjeta">
                            <h3>Nombre del titular</h3>
                            <input type="text" placeholder="juan perez" id="datanombre">
                        </div>
                        <div class="data-tarjeta">
                            <h3>Numero de tarjeta</h3>
                            <input type="text" placeholder="2345 6545 9565 3455" id="datanum">
                        </div>
                        <div class="vence">
                            <div id="exp-cont">
                                <h3>Expiración</h3>
                                <input type="text" placeholder="03/25" id="dataexp">
                            </div>
                            <div id="exp-cont">
                                <h3>CVV</h3>
                                <input type="text" placeholder="432" id="datacod">
                            </div>
                        </div>
                        <button name="BtnComprar" id="btn-pagar">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="View/js/Pago.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>