<?php
    include_once("Modelos/HistorialComprasModel.php"); 
    $historialcompras= new HIstorialComprasModel();
    class CalificarProducto{
        public $vista;
        public function valorar(){
            $this->vista = 'CalificarProducto';
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Calificar'])) {
                $idregistro = $_POST['idregistro'];
                $usuario = $_SESSION['usuario'];
                $idusuario = $usuario['IdUsuario'];    
                $idproducto = $_POST['idproducto'];
                $calificacion = $_POST['cal'];
                $comentario = $_POST['com'];
                $historialcompras->CalificarProducto($idregistro,$idusuario,$idproducto,$calificacion,$comentario);
                echo "<script>
                            alert('Gracias por tu calificacion!');
                            window.location.href='../Paginas/Compras.php';
                            </script>";
                    exit();
            }else{
                echo "<script>
                            alert('Error!');
                            window.location.href='../Paginas/Compras.php';
                            </script>";
                    exit();
            }
        }
    }
    
    

?>