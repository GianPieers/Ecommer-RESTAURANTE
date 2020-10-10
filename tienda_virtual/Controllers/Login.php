<?php
    class Login extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function login()//para la pagina web
        {   
          
            $data['page_tag']="Login - Mishki Mikuy Wanka";
            $data['page_title']="Mishki Mikuy Wanka";
            $data['page_name']="login";
            $data['page_functions_js']= "functions_login.js";
            $this->views->getView($this,"login",$data);
        }

        
    }
    
?>