<?php

    class ProductosModel extends Mysql
    {
        public $intIDProducto;
        public $strNombre;
        public $dblPrecio;
        public $intStock;
        public $intCategoria;

        public function __construct()
        {
           parent::__construct();//cargar el metodo contru de mysql
        }
        
        public function selectProductos()
        {
            //$sql = "SELECT * FROM producto WHERE estado != 0";  //inactivo=eliminado
            $sql = "CALL SP_C_producto(0)";
            $request = $this->select_all($sql);
            //$request = "CALL SP_C_producto(?)";
            return $request;
        }

        public function selectProducto(int $IDProducto)
        {
            //buscar producto
            $this->intIDProducto = $IDProducto;
            $sql = "SELECT * FROM producto WHERE IDProducto = $this->intIDProducto";
            //$sql = "CALL SP_C_producto($this->intIDProducto)";  no funca
            $request = $this->select($sql);

            return $request;
        }

        public function insertProducto(string $nombre, float $precio, int $stock, int $idcategoria)
        {
            $return = "";
            $this->strNombre = $nombre;
            $this->dblPrecio = $precio;
            $this->intStock = $stock;
            $this->intCategoria = $idcategoria;

            //valida si ya existe un producto con el mismo nombre
            $sql = "SELECT * FROM producto WHERE proNombre = '{$this->strNombre}'";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert = "CALL SP_A_producto(?,?,?,?)";
                $arrData = array($this->strNombre, $this->dblPrecio, $this->intStock, $this->intCategoria);
                $request_insert = $this->insert($query_insert,$arrData);
                //return 1; //devuelve el mensaje correcto (producto añadido) pero da un error interno
                return $request_insert;   //esto es la manera correcta pero devuelve el mensaje incorrecto
            }else{
                $return = "exist";
            }

            return $return;
        }

        public function updateProducto(int $IDProducto, string $nombre, float $precio, int $stock, int $idcategoria){
            $this->intIDProducto = $IDProducto;
            $this->strNombre = $nombre;
            $this->dblPrecio = $precio;
            $this->intStock = $stock;
            $this->intCategoria = $idcategoria;

            $sql = "SELECT * FROM producto WHERE proNombre = '$this->strNombre' AND IDProducto != $this->intIDProducto";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE producto SET proNombre = ?, proPrecioPropuesto = ?, proStock = ?, IDCategoria = ? WHERE IDProducto = $this->intIDProducto";
                $arrData = array($this->strNombre, $this->dblPrecio, $this->intStock, $this->intCategoria);
                $request = $this->update($sql, $arrData);
            }else{
                $request = "exist";
            }

            return $request;
        }

        public function deleteProducto(int $IDProducto)
        {
            $this->intIDProducto = $IDProducto;

            //lo comentado es cuando otra tabla depende de esta (como categoria de producto)
            //$sql = "SELECT * FROM producto WHERE IDProducto = $this->intIDProducto";
            //$request = $this->select_all($sql);

            //if(empty($request))
            //{
                $sql = "UPDATE producto SET estado = ? WHERE IDProducto = $this->intIDProducto";
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


<?php

    /*class homeModel extends Mysql
    {

        public function __construct()
        {
           parent::__construct();//cargar el metodo contru de mysql
        }
        public function setUser(string $nombre, int $edad)
        {
            //$query_insert = "INSERT INTO usuario(nombre,edad) values (?,?)";
            $query_insert = "CALL SP_A_usuario(?,?)";
            $arrData = array($nombre, $edad);
            $request_insert = $this->insert($query_insert,$arrData);
            return $request_insert;

        }
        public function getUser($id)
        {
            //$sql = "SELECT*FROM usuario WHERE id=$id";
            $sql = "CALL SP_C_usuario($id)";
            
            
            $request = $this->select($sql);
            return $request;

        }
        public function updateUser(int $id, string $nombre,int $edad)
        {
            //$sql = "UPDATE usuario SET nombre=?,edad=?WHERE id=$id";
            $sql = "CALL SP_M_usuario(?,?,$id)";
            
            $arrData = array($nombre, $edad);
            $request = $this->update($sql,$arrData);
            return $request;

        }
        public function getUsers()
        {
            //$sql = "SELECT*FROM usuario ";
            $sql = "CALL mostrar()";
            
            
            $request = $this->select_all($sql);
            return $request;

        }
        public function delUser($id)
        {
            $sql = "DELETE FROM usuario WHERE id=$id";
            //$sql = "CALL eliminar($id)";
            
            
            $request = $this->delete($sql);
            return $request;

        }
       
    }*/
?>
