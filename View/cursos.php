<?php
// Archivos necesarios
include_once("Model/CursoModel.php");
include_once("Model/SessionControl.php");

$usuarioInfo = new SessionControl();
$cursoModel = new CursoModel();
$idUsuario = $usuarioInfo->SessionGetID();
if (isset($_SESSION['Usuario'])) {

    $rolUser = $usuario['Rol'];
   
}
if($rolUser==1){
    $cursosAdquiridos = $cursoModel->ObtenerCursosComprados($idUsuario); // Para rol 2
}
if($rolUser==2){
    $cursosImpartidos = $cursoModel->ObtenerCursosImpartidos($idUsuario); // Para rol 2
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="View/css/Compras.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div class="container text-center" id="perfil">
    <div class="row align-items-center">
        <!-- Encabezado dinámico -->
        <?php
        if ($rolUser == 1) echo '<h1 class="mb-4">Cursos adquiridos</h1>';
        if ($rolUser == 2) echo '<h1 class="mb-4">Cursos impartidos</h1>';
        if ($rolUser == 3) echo '<h1 class="mb-4">Cursos pendientes a aprobar</h1>';
        ?>

        <div class="col-md-12 col-lg-12" id="listass">
            <div class="row">
                <?php if ($rolUser == 1): ?>
                    <!-- Cursos adquiridos (rolUser 1) -->
                    <div class="row">
                        <?php foreach ($cursosAdquiridos as $curso): ?>
                            <div class="col-12">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $curso['NombreCurso']?></h5>
                                        <p class="card-text">
                                            <strong>Descripcion:</strong> <?= $curso['Descripcion']; ?><br>
                                            <strong>Niveles completados:</strong> <?= $curso['ProgresoTotal']; ?><br>                                           
                                            <strong>Fecha de inscripción:</strong> <?= date('d/m/Y', strtotime($curso['FechaComprado'])); ?><br>
                                        </p>
                                        <form action="index.php?control=curso&accion=verinfo" method="post">
                                            <input type="hidden" name="id" value="<?= $curso['CursoPagado']; ?>">
                                            <button type="submit" class="btn btn-primary">Ver Curso</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>            
                <?php elseif ($rolUser == 2): ?>
                    <!-- Cursos impartidos (rolUser 2) -->
                    <?php if (!empty($cursosImpartidos)): ?>
                        <?php foreach ($cursosImpartidos as $curso): ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <?php   $fotoBase64 = base64_encode($curso['Foto']);
                                            $extension = $curso['Extension'];
                                            $foto = 'data:image/' . $extension . ';base64,' . $fotoBase64;?>
                                    <img src="<?php echo $foto?>" class="card-img-top img-fluid" alt="Imagen del curso">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($curso['NombreCurso']); ?></h5>
                                        <p class="card-text">
                                            <strong>Alumnos totales:</strong> <?php echo htmlspecialchars($curso['NumeroAlumnos']); ?><br>
                                            <strong>Fecha de Creacion:</strong> <?php echo htmlspecialchars($curso['FechaCreacion']); ?><br>
                                            <strong>Calificacion:</strong> <?php echo htmlspecialchars($curso['Calificacion']); ?><br>
                                            <strong>Costo del Curso Completo:</strong> <?php echo htmlspecialchars($curso['Costo']); ?><br>
                                            <strong>Total de ingresos:</strong> $<?php echo htmlspecialchars($curso['GananciasTotales']); ?>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <form action="index.php?control=curso&accion=verinfo&id=<?php echo htmlspecialchars($curso['IdCurso'])?>" method="post">
                                            <input type="hidden" name="idCurso" value="<?php echo htmlspecialchars($curso['IdCurso']); ?>">
                                            <button type="submit" class="btn btn-primary">Ver detalles</button>
                                        </form>
                                        <form action="index.php?control=curso&accion=detallesVentaCurso" method="post">
                                            <input type="hidden" name="idCurso" value="<?php echo htmlspecialchars($curso['IdCurso']); ?>">
                                            <button type="submit" class="btn btn-secondary" style="margin-top:10px;" name="verAlumnos">Ver Alumnos</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12 mt-4">
                            <div class="total">
                                <?php 
                                $ingresosTotales = array_sum(array_column($cursosImpartidos, 'GananciasTotales'));
                                echo "<h4>Total de ingresos: $" . htmlspecialchars($ingresosTotales) . "</h4>"; 
                                ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-muted">No tienes cursos impartidos aún.</p>
                        </div>
                    <?php endif; ?>
                <?php elseif ($rolUser == 3): ?>
                    <!-- Cursos pendientes a aprobar (rolUser 3) -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Curso de programación web</h5>
                                <p class="card-text">
                                    <strong>Niveles totales:</strong> 3<br>
                                    <strong>Calificación:</strong> Sin opiniones<br>
                                    <strong>Precio:</strong> $200
                                </p>
                                <form action="" method="post">
                                    <input type="hidden" name="idcurso" value="60">
                                    <button type="submit" name="aprobar" class="btn btn-success">Aprobar curso</button>
                                    <button type="submit" name="rechazar" class="btn btn-danger">Rechazar curso</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
