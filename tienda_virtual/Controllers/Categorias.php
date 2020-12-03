<?php
    class Categorias extends Controllers{

        public function __construct()
        {
            parent::__construct();
            session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'login');
            }
        }

        public function Categorias()
        {
            $data['page_tag']="Categorias";
            $data['page_title']="Categorias de productos <small>Tienda virtual</small>";
            $data['page_name']="categorias";
            $data['page_functions_js']= "functions_categorias.js";
            
            $this->views->getView($this,"categorias",$data);
        }

        public function getCategorias()
        {
            $arrData = $this->model->selectCategorias();
            /*dep($arrData);
            exit;*/
            for($i=0; $i<count($arrData); $i++){
                if($arrData[$i]['catEstado'] == 1)
                {
                    $arrData[$i]['catEstado'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['catEstado'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                $arrData[$i]['opciones'] = '<div class="text-center">
                    <button class="btn btn-secondary btn-sm btnEditCategoria" onClick="fntEditCategoria('.$arrData[$i]['IDCategoria'].')" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm btnDelCategoria" onClick="fntDelCategoria('.$arrData[$i]['IDCategoria'].')" title="Eliminar"><i class="fa fa-trash"></i></button>
                </div>';
            }

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getCategoria(int $idcategoria)
        {
            $intIdcategoria = intval(strClean($idcategoria));
            if($intIdcategoria > 0)
            {
                $arrData = $this->model->selectProducto($intIdcategoria);
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

        public function getSelectCategorias(){
            $htmlOptions = "";
            $arrData = $this->model->selectCategorias();
            if(count($arrData) > 0){
                for($i=0; $i<count($arrData); $i++){
                    $htmlOptions .= '<option value="'.$arrData[$i]['IDCategoria'].'">'.$arrData[$i]['catNombre'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }

        public function setCategoria(){
            /*dep($_POST);
            dep($_FILES);
            exit();*/

            if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']))
            {
                $arrResponse = array("status" => false, "msg" => "Datos incorrectos");
            }else{
                $intIdcategoria = intval($_POST['idCategoria']);
                $strNombre = strClean($_POST['txtNombre']);
                $strDescripcion = strClean($_POST['txtDescripcion']);

                $foto = $_FILES['foto'];
                $nombre_foto = $foto['name'];
                $type = $foto['type'];
                $url_temp = $foto['tmp_name'];
                $fecha = date('ymd');
                $hora = date('Hms');
                $imgPortada = 'portada_categoria.png';

                if($nombre_foto != ''){
                    $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }

                if($intIdcategoria == 0)
                {
                    //crea
                    $request_categoria = $this->model->insertCategoria($strNombre, $strDescripcion, $imgPortada);
                    $option = 1;
                }else{
                    //actualiza
                    $request_categoria = $this->model->updateCategoria($intIdcategoria, $strNombre, $strDescripcion, $imgPortada);
                    $option = 2;
                }

                if($request_categoria > 0)
                {
                    if($option == 1)
                    {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }
                    }else{
                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                    }
                    
                }else if($request_categoria == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '!Atención¡ La cateogoría ya existe.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            die();
        }

        public function delCategoria()
        {
            if($_POST){
                $intIdcategoria = intval($_POST['IDCategoria']);
                $requestDelete = $this->model->deleteCategoria($intIdcategoria);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría.');
                }else if($requestDelete == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar la categoría.'); //para evitar eliminar si otros elementos dependen de este
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>