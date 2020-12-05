<?php

    class PedidosModel extends Mysql
    {
        public $intIDPedido;
        public $strcliDNI;
        public $dblPrecioTotal;
        public $strFecha;

        public function __construct()
        {
           parent::__construct();//cargar el metodo contru de mysql
        }
        
        public function selectPedidos()
        {
            $sql = "SELECT * FROM pedido WHERE pedEstado != 0";  //inactivo=eliminado
            //$sql = "CALL SP_C_producto(0)";
            $request = $this->select_all($sql);
            //$request = "CALL SP_C_producto(?)";
            return $request;
        }

        public function selectPedido(int $IDPedido)
        {
            //buscar Pedido
            $this->intIDPedido = $IDPedido;
            $sql = "SELECT * FROM pedido WHERE IDPedido = $this->intIDPedido";
            //$sql = "CALL SP_C_producto($this->intIDProducto)";  no funca
            $request = $this->select($sql);

            return $request;
        }

        public function insertPedido(string $clidni, float $preciototal, string $fecha)
        {
            $return = "";
            $this->strCliDNI = $clidni;
            $this->dblPrecioTotal = $preciototal;
            $this->strFecha = $fecha;

            /*valida si ya existe un pedido con el mismo nombre
            $sql = "SELECT * FROM pedido WHERE ped? = '{$this->strNombre}'";
            $request = $this->select_all($sql);*/

            //if(empty($request))
            //{
                $query_insert = "CALL SP_A_pedido(?,?,?)";
                $arrData = array($this->strCliDNI, $this->dblPrecioTotal, $this->strFecha);
                $request_insert = $this->insert($query_insert,$arrData);
                //return 1; //devuelve el mensaje correcto (producto añadido) pero da un error interno
                return $request_insert;   //esto es la manera correcta pero devuelve el mensaje incorrecto
            //}else{
                //$return = "exist";
            //}

            return $return; //ya no va
        }

        public function updatePedido(int $IDPedido, string $cliDNI, float $precioTotal, string $fecha){
            $this->intIDPedido = $IDPedido;
            $this->strcliDNI = $cliDNI;
            $this->dblPrecioTotal = $precioTotal;
            $this->strFecha = $fecha;

            /*$sql = "SELECT * FROM pedido WHERE proNombre = '$this->strNombre' AND IDProducto != $this->intIDProducto";
            $request = $this->select_all($sql);

            if(empty($request))
            {*/
                $sql = "UPDATE pedido SET DNI = ?, pedPrecioTotal = ?, pedFecha = ? WHERE IDPedido = $this->intIDPedido";
                $arrData = array($this->strcliDNI, $this->dblPrecioTotal, $this->strFecha);
                $request = $this->update($sql, $arrData);
            /*}else{
                $request = "exist";
            }*/

            return $request;
        }

        public function deletePedido(int $IDPedido)
        {
            $this->intIDPedido = $IDPedido;

            //lo comentado es cuando otra tabla depende de esta (como categoria de producto)
            $sql = "SELECT * FROM detallepedido WHERE IDPedido = $this->intIDPedido";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE pedido SET pedEstado = ? WHERE IDPedido = $this->intIDPedido";
                $arrData = array(0);
                $request = $this->update($sql, $arrData);
                if($request)
                {
                    $request = 'ok';
                }else{
                    $request = 'error';
                } //quedarse solo con esto en caso no detalle
            }else{
                $request = "exist";
            }

            return $request;
        }
    }
?>
