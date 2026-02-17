<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("Model/CursoModel.php");

$cursoModel = new CursoModel();

if (!isset($_SESSION['cursos'])) {
    $cursos = $cursoModel->Busqueda('', 1, NULL, NULL, NULL);
    $_SESSION['cursos'] = $cursos;
} 
else {
    $cursos = $_SESSION['cursos'];
}

class Busqueda{
    private $cursoModel;
    public $vista;

    public function __construct() {
        $this->cursoModel = new CursoModel(); // Inicializa el modelo del curso
    }

    public function buscar(){
        $this->vista = 'resultado-busqueda';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['BtnBuscar'])) {
            $busqueda = $_POST['busqueda'] ?? '';
            $tipoBusqueda = $_POST['tipoBusqueda'] ?? 1;
            $categorias = isset($_POST['categorias']) ? implode(',', $_POST['categorias']) : '';
            $fechaMin = $_POST['fechaMinima'];
            $fechaMax = $_POST['fechaMaxima'];
        
            if($categorias === "") {
                $categorias = NULL;
            }
            if($fechaMin === "") {
                $fechaMin = NULL;
            }
            if($fechaMax === "") {
                $fechaMax = NULL;
            }
        
            $cursos = $this->cursoModel->Busqueda($busqueda, $tipoBusqueda, $categorias, $fechaMin, $fechaMax);
            $_SESSION['cursos'] = $cursos;
        }
        else {
            $cursos = $this->cursoModel->Busqueda('', 1, NULL, NULL, NULL);
            $_SESSION['cursos'] = $cursos;
        }
    }
}



require_once("View/resultado-busqueda.php");

?>