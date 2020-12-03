<?php
    class Promociones extends Controllers{

        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'login');
            }
        }

        public function promociones()
        {
            /*if(empty($_SESSION['permisosMod']['r'])){
                header("Location:".base_url().'dashboard');
            }*/
            $data['page_tag']="Promociones";
            $data['page_title']="Promociones de venta <small>Tienda virtual</small>";
            $data['page_name']="promociones";
            $data['page_functions_js']= "functions_promociones.js";
            
            $this->views->getView($this,"promociones",$data);
        }

        public function getPromociones()
        {
            $arrData = $this->model->selectPromociones();
            
            for($i=0; $i<count($arrData); $i++){
                if($arrData[$i]['promEstado'] == 1)
                {
                    $arrData[$i]['promEstado'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['promEstado'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                $arrData[$i]['opciones'] = '<div class="text-center">
                    <button class="btn btn-secondary btn-sm btnEditPromociones" onClick="fntEditPromocion('.$arrData[$i]['IDPromocion'].')" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm btnDelPromociones" onClick="fntDelPromocion('.$arrData[$i]['IDPromocion'].')" title="Eliminar"><i class="fa fa-trash"></i></button>
                </div>';
            }

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        /*public function getSelectPromociones(){
            $htmlOptions = "";
            $arrData = $this->model->selectPromociones();
            if(count($arrData) > 0){
                for($i=0; $i<count($arrData); $i++){
                    $htmlOptions .= '<option value="'.$arrData[$i]['IDPromocion'].'">'.$arrData[$i]['promNombre'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function getProductoPrecio($idproducto){
            $idProducto = $idproducto;
            $htmlPrecio = "";
            $arrData = $this->model->selectProducto($idProducto);          
            $htmlPrecio .= '<value ="'.$arrData['proPrecioPropuesto'].'">';
            echo $htmlPrecio;
            die();
        }*/

        public function getPromocion(int $idpromocion)
        {
            $intIdpromocion = intval(strClean($idpromocion));
            if($intIdpromocion > 0)
            {
                $arrData = $this->model->selectPromocion($intIdpromocion);
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

        public function setPromocion(){
            //dep($_POST);
            $intIdpromocion = intval($_POST['IDPromocion']);
            $strNombre = strClean($_POST['txtNombre']);
            $dblPrecio = floatval($_POST['txtPrecio']);
            $intStock = intval($_POST['txtStock']);
            $intProducto = intval($_POST['listProducto']);

            if($intIdpromocion == 0)
            {
                //crea
                $request_promocion = $this->model->insertPromocion($strNombre, $dblPrecio, $intStock, $intProducto);
                $option = 1;
            }else{
                //actualiza
                $request_promocion = $this->model->updatePromocion($intIdpromocion, $strNombre, $dblPrecio, $intStock, $intProducto);
                $option = 2;
            }

            if($request_promocion > 0)
            {
                if($option == 1)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
                
            }else if($request_promocion == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '!Atención¡ La promoción ya existe.');
            }else{
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delPromocion()
        {
            if($_POST){
                $intIdpromocion = intval($_POST['IDPromocion']);
                $requestDelete = $this->model->deletePromocion($intIdpromocion);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la promoción.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar la promoción.'); //para evitar eliminar si otros elementos dependen de este
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una promoción activa.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>