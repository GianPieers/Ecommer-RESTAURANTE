<?php

    class UsuariosModel extends Mysql
    {
        public $strDNI;
        public $strNombres;
        public $strApPaterno;
        public $strApMaterno;
        public $strDireccion;
        public $strTelefono;
        public $strPassword;

        public function __construct()
        {
           parent::__construct();//cargar el metodo construct de mysql
        }
        
        public function selectUsuarios()
        {
            $sql = "CALL SP_C_usuario(0)";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectUsuario(string $dni)
        {
            //buscar usuario
            $this->strDNI = $dni;
            $sql = "CALL SP_C_usuario('{$this->strDNI}')";
            $request = $this->select($sql);

            return $request;
        }

        public function insertUsuario(string $DNI, string $nombres, string $apPaterno, string $apMaterno, string $direccion, string $telefono, string $password)
        {
            $this->strDNI = $DNI;
            $this->strNombres = $nombres;
            $this->strApPaterno = $apPaterno;
            $this->strApMaterno = $apMaterno;
            $this->strDireccion = $direccion;
            $this->strTelefono = $telefono;
            $this->strPassword = $password;
            $return = 0;

            //valida si ya existe un usuario con el mismo nombre
            $sql = "CALL SP_C_usuario('{$this->strDNI}')";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert = "CALL SP_A_usuario(?,?,?,?,?,?,?)";
                $arrData = array($this->strDNI, $this->strNombres, $this->strApPaterno, $this->strApMaterno, $this->strDireccion, $this->strTelefono, $this->strPassword);
                $request_insert = $this->insert($query_insert,$arrData);
                return $request_insert;
            }else{
                $return = "exist";
            }

            return $return;
        }

        public function updateUsuario(string $DNI, string $nombres, string $apPaterno, string $apMaterno, string $direccion, string $telefono, string $password){
            $this->strDNI = $DNI;
            $this->strNombres = $nombres;
            $this->strApPaterno = $apPaterno;
            $this->strApMaterno = $apMaterno;
            $this->strDireccion = $direccion;
            $this->strTelefono = $telefono;
            $this->strPassword = $password;

            $sql = "CALL SP_M_usuario(?,?,?,?,?,?,?)";
            $arrData = array($this->strNombres, $this->strApPaterno, $this->strApMaterno, $this->strDireccion, $this->strTelefono, $this->strPassword, $this->strDNI);
            $request = $this->update($sql, $arrData);

            return $request;
        }

        public function deleteUsuario(string $dni)
        {
            $this->strdni = $dni;

            $sql = "CALL SP_M_usuario(?,?)";
            $arrData = array(0,$this->strdni);
            $request = $this->update($sql, $arrData);
            if($request)
            {
                $request = 'ok';
            }else{
                $request = 'error';
            }

            return $request;
        }
    }
?>
