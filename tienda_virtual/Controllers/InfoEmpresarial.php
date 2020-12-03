<?php
    class InfoEmpresarial extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function infoEmpresarial()//para la pagina web
        {
            $data['page_tag']="InformacionEmpresarial";
            $data['page_title']="Información Empresarial";
            $data['page_name']="infoEmpresarial";
            $this->views->getView($this,"infoEmpresarial",$data);
        }
        
    }
?>