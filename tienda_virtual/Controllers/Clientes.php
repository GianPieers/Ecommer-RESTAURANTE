<?php
    class Clientes extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function clientes()//para la pagina web
        {   
            //$data['page_id'] = 6;
            $data['page_tag']="Clientes";
            $data['page_title']="Clientes <small>Tienda Virtual</small>";
            $data['page_name']="clientes";
            $data['page_functions_js']= "functions_clientes.js";

            $this->views->getView($this,"clientes",$data);
        }
        
        public function setCliente(){
            if($_POST){
                if(empty($_POST['txtDNI']) || empty($_POST['txtNombre']) || empty($_POST['txtApPaterno']) ||
                    empty($_POST['txtDireccion']) || empty($_POST['txtCorreo']) || empty($_POST['txtCelular']) || empty($_POST['txtPassword']))
                {
                    $arrResponse = array("estado" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $strDNI = strClean($_POST['txtDNI']);
                    $strNombre = ucwords(strClean($_POST['txtNombre']));
                    $strApPaterno = ucwords(strClean($_POST['txtApPaterno']));
                    $strApMaterno = ucwords(strClean($_POST['txtApMaterno']));
                    $strDireccion = strClean($_POST['txtDireccion']);
                    $strCorreo = strClean($_POST['txtCorreo']);
                    $strCelular = strClean($_POST['txtCelular']);
                    $strPassword = strClean($_POST['txtPassword']);
                    //$strPassword = hash("SHA256",$_POST['txtPassword']); //encrypta //v1
                    //https://youtu.be/yloI2aEnn3k?list=PL3b9xmg86NTKWP3Xzu-1DCwaeO5sftK4V&t=332

                    $arrData = $this->model->selectCliente($strDNI);
                    //dep($_POST);
                    //die();
                    //us="'.$arrData[$i]['DNI'].'" -- $this->$_GET["DNI"] -- this.getAttribute("us") -- isset
                    if($strDNI == $arrData['DNI'])
                    {
                        $option = 2;
                        $request_cliente = $this->model->updateCliente($strDNI, $strNombre, $strApPaterno, $strApMaterno, $strDireccion, $strCorreo, $strCelular, $strPassword);
                    }else{
                        $option = 1;
                        $request_cliente = $this->model->insertCliente($strDNI, $strNombre, $strApPaterno, $strApMaterno, $strDireccion, $strCorreo, $strCelular, $strPassword);
                    }
                    /*if($strDNI == $arrData['DNI'])
                    {
                        $option = 2;
                        $request_cliente = $this->model->updateCliente($strDNI, $strNombre, $strApPaterno, $strApMaterno, $strDireccion, $strCorreo, $strCelular, $strPassword);
                    }else{
                        $option = 1;
                        $request_cliente = $this->model->insertCliente($strDNI, $strNombre, $strApPaterno, $strApMaterno, $strDireccion, $strCorreo, $strCelular, $strPassword);
                    }*/
                    
                    if($request_cliente >= 0)
                    {
                        if($option == 1)
                        {
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        }else{
                            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                        }
                        
                    }else if($request_cliente == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => '!Atención¡ El DNI ya existe, ingrese otro.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                    }
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getClientes()
        {
            $arrData = $this->model->selectClientes();
            
            for($i=0; $i<count($arrData); $i++){
                /*if($arrData[$i]['estado'] == 1)
                {
                    $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                }*/

                $arrData[$i]['opciones'] = '<div class="text-center">
                    <button class="btn btn-secondary btn-sm btnEditCliente" onClick="fntEditCliente('.$arrData[$i]['DNI'].')" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm btnDelCliente" onClick="fntDelCliente('.$arrData[$i]['DNI'].')" title="Eliminar"><i class="fa fa-trash"></i></button>
                </div>';
            }

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getCliente(int $dni)
        {
            $strdni = strClean($dni);
            if($strdni > 0)
            {
                $arrData = $this->model->selectCliente($strdni);
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

        public function delCliente()
        {
            if($_POST){
                $strDNI = strClean($_POST['DNI']);
                $requestDelete = $this->model->deleteCliente($strDNI);
                if($requestDelete)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el cliente');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el Cliente.'); //para evitar eliminar si otros elementos dependen de este
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el cliente.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>