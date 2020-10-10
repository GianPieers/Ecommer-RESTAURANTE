<?php
    class Home extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function home()//para la pagina web
        {   
            $data['page_id'] = 1;
            $data['page_tag']="Home";
            $data['page_title']="Pagina principal";
            $data['page_name']="home";
            $data['page_content']= "lorem dsdsdsdsdsdsdsdsdsd";
            $this->views->getView($this,"home",$data);
        }
        
    }
?>