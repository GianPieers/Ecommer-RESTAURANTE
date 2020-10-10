<?php
    class Dashboard extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function dashboard()//para la pagina web
        {   
            $data['page_id'] = 2;
            $data['page_tag']="Dashboard - Tienda Virtual";
            $data['page_title']="Dashboard - Tienda Virtual";
            $data['page_name']="dashboard";
            //$data['page_content']= "lorem dsdsdsdsdsdsdsdsdsd";
            $this->views->getView($this,"dashboard",$data);
        }
        
    }
?>