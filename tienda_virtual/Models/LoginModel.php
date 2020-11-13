<?php
        class LoginModel extends Mysql
        {
            private $intIdUsuario;
            private $strUsuario;
            private $strPassword;
            private $strToken;
    
            public function __construct()
            {
               parent::__construct();//cargar el metodo contru de mysql
            }
            
            public function loginUser(string $usuario, string $password)
            {
                $this->strUsuario = $usuario;
                $this->strPassword = $password;
                $sql = "CALL SP_login(?,?)";
                $arrdata = array('$this->strUsuario','$this->strPassword');
                $request = $this->select($sql);
                return $request;
                }
        }
?>


