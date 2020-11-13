<?php

    class ClientesModel extends Mysql
    {
        public $strDNI;
        public $strNombre;
        public $strApPaterno;
        public $strApMaterno;
        public $strDireccion;
        public $strCorreo;
        public $strCelular;
        public $strPassword;

        public function __construct()
        {
           parent::__construct();//cargar el metodo construct de mysql
        }
        
        public function selectClientes()
        {
            $sql = "CALL SP_C_cliente(0)";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectCliente(string $dni)
        {
            //buscar cliente
            $this->strDNI = $dni;
            $sql = "CALL SP_C_cliente('{$this->strDNI}')";
            $request = $this->select($sql);

            return $request;
        }

        public function insertCliente(string $DNI, string $nombre, string $apPaterno, string $apMaterno, string $direccion, string $correo, string $celular, string $password)
        {
            $this->strDNI = $DNI;
            $this->strNombre = $nombre;
            $this->strApPaterno = $apPaterno;
            $this->strApMaterno = $apMaterno;
            $this->strDireccion = $direccion;
            $this->strCorreo = $correo;
            $this->strCelular = $celular;
            $this->strPassword = $password;
            $return = 0;

            //valida si ya existe un cliente con el mismo nombre
            $sql = "SELECT * FROM cliente WHERE DNI = '{$this->strDNI}'";
            //$sql = "CALL SP_C_cliente('{$this->strDNI}')";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert = "CALL SP_A_cliente(?,?,?,?,?,?,?,?)";
                //$query_insert = "INSERT INTO cliente VALUES"
                $arrData = array($this->strDNI, $this->strNombre, $this->strApPaterno, $this->strApMaterno, $this->strDireccion, $this->strCorreo, $this->strCelular, $this->strPassword);
                $request_insert = $this->insert($query_insert,$arrData);
                return $request_insert;
            }else{
                $return = "exist";
            }

            return $return;
        }

        public function updateCliente(string $DNI, string $nombre, string $apPaterno, string $apMaterno, string $direccion, string $correo, string $celular, string $password){
            $this->strDNI = $DNI;
            $this->strNombres = $nombre;
            $this->strApPaterno = $apPaterno;
            $this->strApMaterno = $apMaterno;
            $this->strDireccion = $direccion;
            $this->strCorreo = $correo;
            $this->strCelular = $celular;
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
                    $sql = "UPDATE cliente SET cliNombre = ?, cliApPaterno = ?, cliApMaterno = ?, cliDireccion = ?, cliCorreo = ?, cliCelular = ?, cliPassword = ? WHERE DNI = '{$this->strDNI}'";
                    $arrData = array($this->strNombres, $this->strApPaterno, $this->strApMaterno, $this->strDireccion, $this->strCorreo, $this->strCelular, $this->strPassword);
                //}
                $request = $this->update($sql, $arrData);
            /*}else{
                $request = "exist";
            }*/

            return $request;
        }

        public function deleteCliente(string $dni)
        {
            $this->strdni = $dni;

            //lo comentado es cuando otra tabla depende de esta (como categoria de producto)
            //$sql = "SELECT * FROM producto WHERE IDProducto = $this->intIDProducto";
            //$request = $this->select_all($sql);

            //if(empty($request))
            //{
                $sql = "UPDATE cliente SET cliEstado = ? WHERE DNI = $this->strdni";
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
