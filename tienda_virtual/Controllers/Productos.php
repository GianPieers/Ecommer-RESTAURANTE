<?php
    class Productos extends Controllers{

        public function __construct()
        {
            parent::__construct();
        }

        public function productos()//para la pagina web
        {
            $data['page_id'] = 4;
            $data['page_tag']="Productos";
            $data['page_title']="Productos en venta <small>Tienda virtual</small>";
            $data['page_name']="productos";
            
            $this->views->getView($this,"productos",$data);
        }

        public function getProductos()
        {
            $arrData = $this->model->selectProductos();
            
            for($i=0; $i<count($arrData); $i++){
                if($arrData[$i]['estado'] == 1)
                {
                    $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                $arrData[$i]['opciones'] = '<div class="text-center">
                    <button class="btn btn-secondary btn-sm btnEditProducto" rl="'.$arrData[$i]['IDProducto'].'" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm btnDelProducto" rl="'.$arrData[$i]['IDProducto'].'" title="Eliminar"><i class="fa fa-trash"></i></button>
                </div>';
            }

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getProducto(int $idproducto)
        {
            $intIdproducto = intval(strClean($idproducto));
            if($intIdproducto > 0)
            {
                $arrData = $this->model->selectProducto($intIdproducto);
                if(empty($arrData))
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('estado' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setProducto(){
            //dep($_POST);
            $intIdproducto = intval($_POST['IDProducto']);
            $strNombre = strClean($_POST['txtNombre']);
            $dblPrecio = floatval($_POST['txtPrecio']);
            $intStock = intval($_POST['txtStock']);
            $intCategoria = intval($_POST['listCategoria']);

            if($intIdproducto == 0)
            {
                //crea
                $request_producto = $this->model->insertProducto($strNombre, $dblPrecio, $intStock, $intCategoria);
                $option = 1;
            }else{
                //actualiza
                $request_producto = $this->model->updateProducto($intIdproducto, $strNombre, $dblPrecio, $intStock, $intCategoria);
                $option = 2;
            }

            if($request_producto > 0)
            {
                if($option == 1)
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente.');
                }else{
                    $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente.');
                }
                
            }else if($request_producto == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '!Atención¡ El Producto ya existe.');
            }else{
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delProducto()
        {
            if($_POST){
                $intIdproducto = intval($_POST['IDProducto']);
                $requestDelete = $this->model->deleteProducto($intIdproducto);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el Producto.'); //para evitar eliminar si otros elementos dependen de este
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>