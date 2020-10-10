<?php
    class Usuarios extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function Usuarios()//para la pagina web
        {   
           
            $data['page_tag']="Usuarios";
            $data['page_title']="USUARIOS <small>Tienda Virtual</small>";
            $data['page_name']="usuarios";
            $data['page_functions_js']= "functions_usuarios.js";
            $this->views->getView($this,"usuarios",$data);
        }
        
    }
?>