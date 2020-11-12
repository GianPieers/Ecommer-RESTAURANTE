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
            //$sql = "SELECT * FROM usuario WHERE estado != 0";  //inactivo=eliminado
            $sql = "CALL SP_C_usuario(0)";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectUsuario(string $dni)
        {
            //buscar usuario
            $this->strDNI = $dni;
            $sql = "SELECT * FROM usuario WHERE DNI = $this->strDNI";
            //$sql = "CALL SP_C_usuario('{$this->strDNI}')";
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
            $sql = "SELECT * FROM usuario WHERE DNI = '{$this->strDNI}'";
            //$sql = "CALL SP_C_usuario('{$this->strDNI}')";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert = "CALL SP_A_usuario(?,?,?,?,?,?,?)";
                //$query_insert = "INSERT INTO usuario VALUES"
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

            //$sql = "SELECT * FROM usuario WHERE DNI = '{$this->strDNI}' AND usuNombres != '{$this->strNombres}'";
            //$request = $this->select_all($sql);
            
            //if(empty($request))
            //{                                                                                                     //para validar que no se repitan datos con otro usuario
                /*if($this->strPassword != "")                                                                      //cuando se encripta el password y no encriptar lo encriptado
                {
                    $sql = "UPDATE usuario SET usuNombres = ?, usuApPaterno = ?, usuApMaterno = ?, usuDireccion = ?, usuTelefono = ? WHERE DNI = '{$this->strDNI}'";
                    $arrData = array($this->strNombres, $this->strApPaterno, $this->strApMaterno, $this->strDireccion, $this->strTelefono);
                }else{*/
                    $sql = "UPDATE usuario SET usuNombres = ?, usuApPaterno = ?, usuApMaterno = ?, usuDireccion = ?, usuTelefono = ?, usuPassword = ? WHERE DNI = '{$this->strDNI}'";
                    $arrData = array($this->strNombres, $this->strApPaterno, $this->strApMaterno, $this->strDireccion, $this->strTelefono, $this->strPassword);
                //}
                $request = $this->update($sql, $arrData);
            /*}else{
                $request = "exist";
            }*/

            return $request;
        }

        public function deleteUsuario(string $dni)
        {
            $this->strdni = $dni;

            //lo comentado es cuando otra tabla depende de esta (como categoria de producto)
            //$sql = "SELECT * FROM producto WHERE IDProducto = $this->intIDProducto";
            //$request = $this->select_all($sql);

            //if(empty($request))
            //{
                $sql = "UPDATE usuario SET estado = ? WHERE DNI = $this->strdni";
                $arrData = array(0);
                $request = $this->update($sql, $arrData);
                if($request)
                {
                    $request = 'ok';
                }else{
                    $request = 'error';
                }
            //}else{
                //$request = "exist";
            //}

            return $request;
        }
    }
?>