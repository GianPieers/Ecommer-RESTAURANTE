<?php
    class Login extends Controllers{

        public function __construct()
        {   
            session_start();
            
            if(isset($_SESSION['login']))
            {
                header('Location: '.base_url().'/dashboard');
            }
            parent::__construct();

        }
        public function login()//para la pagina web
        {   
           
            $data['page_tag']="Login - Tienda Virtual";
            $data['page_title']="Tienda Virtual";
            $data['page_name']="login";
            $data['page_functions_js']= "functions_login.js";
            $this->views->getView($this,"login",$data);
        }
        public function loginUser()
        {
            //dep($_POST);
            if($_POST)
            {
                if(empty($_POST['txtEmail'])|| empty ($_POST['txtPassword']))
                {
                    $arrResponse = array('estado'=>false,'msg'=>'Error de datos');

                }else{
                    $strUsuario = strtolower(strClean($_POST['txtEmail']));
                    $strPassword = strClean($_POST['txtPassword']);
                    $requestUser=$this->model->loginUser($strUsuario,$strPassword);
                    //dep($requestUser);
                    if(empty($requestUser))
                    {
                        $arrResponse = array('status'=> false,'msg'=>'El usuario o la contraseña es incorrecta');

                    }else{
                        $arrData=$requestUser;
                        if($arrData['cliEstado']==1)
                        {
                            $_SESSION['idUser']=$arrData['DNI'];
                            $_SESSION['login']=true;
                            $arrResponse = array('status'=> true,'msg'=>'ok');

                        }else{
                            $arrResponse = array('status'=> false,'msg'=>'Usuario inactivo');

                        }
                    }
                
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        
    }
?>