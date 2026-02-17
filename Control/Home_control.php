<?php
    //soy un controlador para el home :v
    require_once("Model/CursoModel.php");
    
    class Home{
        
        public $vista;
       
        public function Ver(){
            $cursoModel = new CursoModel();
            $this->vista = 'home';
            $MasVendidos = $cursoModel->GetMasVendidos();
            return $MasVendidos;
            
    
        
        }
    }
?>