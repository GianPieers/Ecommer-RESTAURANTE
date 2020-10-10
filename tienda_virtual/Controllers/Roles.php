<?php
    class Roles extends Controllers{

        public function __construct()
        {
            parent::__construct();

        }
        public function Roles()//para la pagina web
        {   
            $data['page_id'] = 3;
            $data['page_tag']="Roles Usuario";
            $data['page_name']="rol_usuarios";
            $data['page_title']="Roles Usuario <small> Tienda Virtual </small>";
            $data['page_functions_js']= "functions_roles.js";
            $this->views->getView($this,"roles",$data);
        }
        
        PUBLIC function setRol(){
            $intIdrol = intval($_POST['idRol']);
            $strRol = strClean($_POST['txtNombre']);
            $strDescripcion = strClean($_POST['txtDescripcion']);
            $intStatus = intval($_POST['listStatus']);
            $request_rol = $this -> model->insertRol($strRol, $strDescripcion,$intStatus);

            if($intIdrol == 0)
            {
                $request_rol = $this->model->insertRol($strRol, $strDescripcion,$intStatus);
                $option=1;
            }

            else
            {
                $request_rol = $this->model->updateRol($strRol, $strDescripcion,$intStatus);
                $option=2;
            }
            if($request_rol > 0)
            {
                if($option ==1){
                $arrResponse = array('status'=>true,'msg'=>'Datos guardados correctamente');
                }else{
                    $arrResponse=array('status'=>true,'msg'=>'Datos actualizados correctamente');

                }
                
            }else if ($request_rol == 'exist'){
                $arrResponse=array('status'=>true,'msg'=>'El rol ya existe');
            }else{
                $arrResponse=array('status'=>true,'msg'=>'No es posible almacenar los datos');

            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();

        }
    }
?>