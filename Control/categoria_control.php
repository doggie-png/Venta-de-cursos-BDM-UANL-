<?php
    include_once("Model/CategoriaModel.php");
    include_once("Model/SessionControl.php");
    date_default_timezone_set('America/Mexico_City');

    class categoria{
        public $vista;

        public function AgregarCategoria(){
            $this->vista = 'registroCat';
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AgregarCategoria'])) {
                $categoriaModel = new CategoriaModel();
                $sessionControl = new SessionControl();
                $nombreCat = $_POST['nombreCat'];
                $descripcionCat = $_POST['Descripcion'];
                $ID = $sessionControl->SessionGetID();
                $fechaHoy = new DateTime();
                $fechaMod = $fechaHoy->format('Y-m-d H:i:s');
        
                // Verifica si la categoría fue añadida correctamente
                if ($categoriaModel->AddCategoria($nombreCat, $descripcionCat, $fechaMod, $ID, 1)) {
                    echo "<script>
                            alert('Categoría agregada exitosamente.');
                            window.location.href='index.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Error al agregar categoría.');
                            window.location.href='index.php';
                          </script>";
                }
        
                // Cierra la conexión
                $categoriaModel->close();
                exit();
            }
        }
        public function Editar(){
            $this->vista = 'editarCat';
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['EditarCategoria'])) {
                $categoriaModel = new CategoriaModel();
                $sessionControl = new SessionControl();
                $nombreCat = $_POST['editNombCat'];
                $descripcionCat = $_POST['editDescCat'];
                $idCategoria=$_POST['editIdCat'];


        
                // Verifica si la categoría fue añadida correctamente
                if ($categoriaModel->editCategoria($idCategoria,$nombreCat, $descripcionCat)) {
                    echo "<script>
                            alert('Categoría actualizada exitosamente.');
                            window.location.href='index.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Error al actualizar categoría.');
                            window.location.href='index.php';
                          </script>";
                }
        

                $categoriaModel->close();
                exit();
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['EliminarCategoria'])) {
                $categoriaModel = new CategoriaModel();


                $idCategoria=$_POST['editIdCat'];

                if ($categoriaModel->eliminarCategoria($idCategoria)) {
                    echo "<script>
                            alert('Categoría eliminada exitosamente.');
                            window.location.href='index.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Error al eliminar categoría.');
                            window.location.href='index.php';
                          </script>";
                }
        

                $categoriaModel->close();
                exit();
            }
        }
        
        
    }



?>