
<?php 
    include_once("Model/CursoModel.php");
    $cursoModel = new CursoModel();
    //$reporteA = $cursoModel->ReporteA();
    if(isset($GET['ReporteA'])){
        $reporteA = $GET['ReporteA'];
    }

    if(isset($GET['ReporteI'])){
        $reporteI = $GET['ReporteI'];
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="View/css/reporte.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    
    <div class="container" id="contenedor">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="cont-reporte">
                    <div class="btn-group dropend" role="group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="desplegar-categoria">
                          Reporte tipo
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="index.php?control=curso&accion=instructor" >Instructor</a></li>
                          <li><a class="dropdown-item" href="index.php?control=curso&accion=alumnos"> Alumno</a></li>
                          
                        </ul>
                        
                    </div>

                    <div class="reporte-body">
                        <?php
                            if(isset($_GET['accion'])){
                                $tipo = $_GET['accion'];
                                if($tipo=='alumnos'){
                                echo '<h1>Reporte de '.$tipo.'</h1>';
                                }
                                if($tipo=='instructor'){
                                    echo '<h1>Reporte de '.$tipo.'</h1>';
                                }
                            }

                        ?>
                        
                        <div class="card-reporte">
                                <div class = "dato">
                                    <p>Usuario</p>
                                    
                                </div>
                                <div class = "dato">
                                    <p>Nombre</p>
                                    
                                </div>
                                <div class = "dato">
                                    <p>Fecha Registro</p>
                                    

                                </div>
                                <div class = "dato">
                                    <?php
                                        if(isset($_GET['accion'])){
                                            $tipo = $_GET['accion'];
                                            if($tipo=='alumnos'){
                                            echo '<p>Cursos Totales</p>';
                                            }
                                            if($tipo=='instructor'){
                                                echo '<p>Total de ventas</p>';
                                            }
                                        }
                                        
                                    ?>    
                                
                                    

                                </div>
                                <div class = "dato">
                                <?php
                                        if(isset($_GET['accion'])){
                                            $tipo = $_GET['accion'];
                                            if($tipo=='alumnos'){
                                            echo '<p>Cursos Aprobados</p>';
                                            }
                                            if($tipo=='instructor'){
                                                echo '<p>Total de ventas</p>';
                                            }
                                        }
                                        
                                    ?>   
                                    

                                </div>
                                
                        </div>

                        <?php if(isset($reporteA)):?>
                        <?php foreach ($reporteA as  $reporteAlumno):?>
                        <div class="cont-reportes">
                            <div class="card-reporte">
                                <div class = "dato">
                                    
                                    <p><?php echo $reporteAlumno['NomUsuario'];?></p>
                                </div>
                                <div class = "dato">
                                    
                                    <p><?php echo $reporteAlumno['Nombres'];?></p>
                                </div>
                                <div class = "dato">
                                    
                                    <p><?php echo $reporteAlumno['FechaReg'];?></p>

                                </div>
                                <div class = "dato">
                                   
                                    <p><?php echo $reporteAlumno['TotalCursos'];?></p>

                                </div>
                                <div class = "dato">
                                   
                                    <p><?php echo $reporteAlumno['CursosCompletados'];?></p>

                                </div>
                                
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif?>

                        <?php if(isset($reporteI)):?>
                        <?php foreach ($reporteI as  $reporteAlumno):?>
                        <div class="cont-reportes">
                            <div class="card-reporte">
                                <div class = "dato">
                                    
                                    <p><?php echo $reporteAlumno['NomUsuario'];?></p>
                                </div>
                                <div class = "dato">
                                    
                                    <p><?php echo $reporteAlumno['Nombres'];?></p>
                                </div>
                                <div class = "dato">
                                    
                                    <p><?php echo $reporteAlumno['FechaReg'];?></p>

                                </div>
                                <div class = "dato">
                                   
                                    <p><?php echo $reporteAlumno['CursosTotales'];?></p>

                                </div>
                                <div class = "dato">
                                   
                                    <p><?php echo $reporteAlumno['TotalVentas'];?></p>

                                </div>
                                
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif?>

                    </div>

                    

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script src="View/js/reporte.js"></script> 
