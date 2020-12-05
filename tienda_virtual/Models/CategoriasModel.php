<?php

    class CategoriasModel extends Mysql
    {
        public $intIdcategoria;
        public $strCategoria;
        public $strDescripcion;
        public $boolEstado;
        public $strPortada;

        public function __construct()
        {
           parent::__construct();//cargar el metodo contru de mysql
        }

        public function insertCategoria(string $nombre, string $descripcion, string $portada)
        {
            $return = 0;
            $this->strCategoria = $nombre;
            $this->strDescripcion = $descripcion;
            $this->strPortada = $portada;

            //valida si ya existe un producto con el mismo nombre
            $sql = "CALL SP_C_producto('{$this->strCategoria}')";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert = "CALL SP_A_categoria(?,?,?)";
                //INSERT INTO categoria(catNombre,catDescripcion,portada) VALUES(nombre,descripcion,porta)
                $arrData = array($this->strCategoria, $this->strDescripcion, $this->strPortada);
                $request_insert = $this->insert($query_insert,$arrData);
                return $request_insert;   //esto es la manera correcta pero devuelve el mensaje incorrecto
            }else{
                $return = "exist";
            }
            return $return;
        }

        public function selectCategorias()
        {
            $sql = "SELECT * FROM categoria WHERE catEstado != 0";  //inactivo=eliminado
            //$sql = "CALL SP_C_categoria(0)";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectProducto(int $IDCategoria)
        {
            //buscar producto
            $this->intIDCategoria = $IDCategoria;
            $sql = "SELECT * FROM categoria WHERE IDCategoria = $this->intIDCategoria";
            //$sql = "CALL SP_C_producto('{$this->intIDProducto}')";
            /*if($mysqli->query("CALL SP_C_producto(".$this->intIDProducto.")")){
                echo "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }*/
            $request = $this->select($sql);
            return $request;
        }

        public function updateCategoria(int $IDCategoria, string $nombre, string $descripcion, string $portada){
            $this->intIDCategoria = $IDCategoria;
            $this->strNombre = $nombre;
            $this->strDescripcion = $descripcion;
            $this->strPortada = $portada;

            $sql = "SELECT * FROM categoria WHERE catNombre = '$this->strNombre' AND IDCategoria != $this->intIDCategoria";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE categoria SET catNombre = ?, catDescripcion = ?, portada = ? WHERE IDCategoria = $this->intIDCategoria";
                $arrData = array($this->strNombre, $this->strDescripcion, $this->strPortada);
                $request = $this->update($sql, $arrData);
            }else{
                $request = "exist";
            }

            return $request;
        }

        public function deleteCategoria(int $IDCategoria)
        {
            $this->intIDCategoria = $IDCategoria;

            //lo siguiente y el "exist" es cuando otra tabla depende de esta (como producto de categoria)
            $sql = "SELECT * FROM producto WHERE IDCategoria = $this->intIDCategoria";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE categoria SET catEstado = ? WHERE IDCategoria = $this->intIDCategoria";
                $arrData = array(0);
                $request = $this->update($sql, $arrData);
                if($request)
                {
                    $request = 'ok';
                }else{
                    $request = 'error';
                }
            }else{
                $request = "exist";
            }
            return $request;
        }
    }
?>
