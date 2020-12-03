<?php

    class PromocionesModel extends Mysql
    {
        public $intIDPromocion;
        public $strNombre;
        public $dblPrecio;
        public $intStock;
        public $intProducto;

        public function __construct()
        {
           parent::__construct();//cargar el metodo contru de mysql
        }
        
        public function selectPromociones()
        {
            $sql = "CALL SP_C_promocion(0)";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPromocion(int $IDPromocion)
        {
            $this->intIDPromocion = $IDPromocion;
            $sql = "CALL SP_C_producto('{$this->intIDProducto}')";
            $request = $this->select($sql);
            return $request;
        }

        public function insertPromocion(string $nombre, float $precio, int $stock, int $idproducto)
        {
            $return = "";
            $this->strNombre = $nombre;
            $this->dblPrecio = $precio;
            $this->intStock = $stock;
            $this->intProducto = $idproducto;

            //valida si ya existe un producto con el mismo nombre
            $sql = "SELECT * FROM promocion WHERE promNombre = '{$this->strNombre}'";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                //$query_insert = "CALL SP_A_promocion(?,?,?,?)";
                $query_insert = "INSERT INTO promocion(promNombre,promPrecio,promStock,promIDproducto) VALUES(?,?,?,?)";
                $arrData = array($this->strNombre, $this->dblPrecio, $this->intStock, $this->intProducto);
                $request_insert = $this->insert($query_insert,$arrData);
                //return 1; //devuelve el mensaje correcto (producto añadido) pero da un error interno
                return $request_insert;   //esto es la manera correcta pero devuelve el mensaje incorrecto
            }else{
                $return = "exist";
            }

            return $return;
        }

        public function updatePromocion(int $IDPromocion, string $nombre, float $precio, int $stock, int $idproducto){
            $this->intIDPromocion = $IDPromocion;
            $this->strNombre = $nombre;
            $this->dblPrecio = $precio;
            $this->intStock = $stock;
            $this->intProducto = $idproducto;

            $sql = "SELECT * FROM promocion WHERE promNombre = '$this->strNombre' AND IDPromocion != $this->intIDPromocion";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE promocion SET promNombre = ?, promPrecio = ?, promStock = ?, promIDproducto = ? WHERE IDPromocion = $this->intIDPromocion";
                $arrData = array($this->strNombre, $this->dblPrecio, $this->intStock, $this->intProducto);
                $request = $this->update($sql, $arrData);
            }else{
                $request = "exist";
            }

            return $request;
        }

        public function deletePromocion(int $IDPromocion)
        {
            $this->intIDPromocion = $IDPromocion;

            //lo comentado es cuando otra tabla depende de esta (como categoria de producto)
            $sql = "SELECT * FROM promocion WHERE IDPromocion = $this->intIDPromocion AND promEstado = 1";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE promocion SET promEstado = ? WHERE IDPromocion = $this->intIDPromocion";
                $arrData = array(2);
                $request = $this->update($sql, $arrData);
                if($request)
                {
                    $request = 'ok';
                }else{
                    $request = 'error';
                }
            }else{
                $request = "error";
            }

            return $request;
        }
    }
?>
