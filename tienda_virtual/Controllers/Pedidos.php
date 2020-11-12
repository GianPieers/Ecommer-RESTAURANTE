<?php
    class Pedidos extends Controllers{

        public function __construct()
        {
            parent::__construct();
        }

        public function pedidos()//para la pagina web
        {   
            //$data['page_id'] = 1;
            $data['page_tag']="Pedidos";
            $data['page_title']="Pedidos <small>Tienda Virtual</small>";
            $data['page_name']="pedidos";
            $data['page_functions_js']= "functions_pedidos.js";

            $this->views->getView($this,"pedidos",$data);
        }

        public function getPedidos()
        {
            $arrData = $this->model->selectPedidos();
            
            for($i=0; $i<count($arrData); $i++){
                /*if($arrData[$i]['pedEstado'] == 1)
                {
                    $arrData[$i]['pedEstado'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['pedEstado'] = '<span class="badge badge-danger">Inactivo</span>';
                }*/

                $arrData[$i]['opciones'] = '<div class="text-center">
                    <button class="btn btn-info btn-sm btnVisualizarPedido" onClick="fntVisualizarPedido('.$arrData[$i]['IDPedido'].')" title="Visualizar"><i class="fa fa-eye"></i></button>
                    <button class="btn btn-secondary btn-sm btnEditPedido" onClick="fntEditPedido('.$arrData[$i]['IDPedido'].')" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm btnDelPedido" onClick="fntDelPedido('.$arrData[$i]['IDPedido'].')" title="Eliminar"><i class="fa fa-trash"></i></button>
                </div>';
            }

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getPedido(int $idpedido)
        {
            $intIdpedido = intval(strClean($idpedido));
            if($intIdpedido > 0)
            {
                $arrData = $this->model->selectPedido($intIdpedido);
                if(empty($arrData))
                {
                    $arrResponse = array('pedEstado' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('pedEstado' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setPedido(){
            //dep($_POST);
            $intIdpedido = intval($_POST['txtIDPedido']);
            $strClienteDNI = strClean($_POST['txtDNI']);
            $dblPrecioTotal = floatval($_POST['txtPrecioTotal']);
            $strFecha = strClean($_POST['txtFecha']);

            if($intIdpedido == 0)
            {
                //crea
                $request_pedido = $this->model->insertPedido($strClienteDNI, $dblPrecioTotal, $strFecha);
                $option = 1;
            }else{
                //actualiza
                $request_pedido = $this->model->updatePedido($intIdpedido, $strClienteDNI, $dblPrecioTotal, $strFecha);
                $option = 2;
            }

            if($request_pedido >= 0)
            {
                if($option == 1)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
                
            }else if($request_pedido == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '!Atención¡ El Pedido ya existe.');
            }else{
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delPedido()
        {
            if($_POST){
                $intIdpedido = intval($_POST['IDPedido']);
                $requestDelete = $this->model->deletePedido($intIdpedido);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el pedido');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el pedido.'); //para evitar eliminar si otros elementos dependen de este
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el pedido.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>