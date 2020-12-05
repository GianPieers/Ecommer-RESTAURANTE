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
                $sql = "SELECT DNI,cliEstado FROM cliente WHERE cliCorreo = '$this->strUsuario' and
                 cliPassword = '$this->strPassword' and 
                 cliEstado !=0 ";
                $arrdata = array('$this->strUsuario','$this->strPassword');
                $request = $this->select($sql);
                return $request;
                }
        }
?>


