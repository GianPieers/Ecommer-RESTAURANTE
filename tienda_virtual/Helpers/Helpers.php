<?php
    //Retorna la url del proyecto
    function base_url()
    {
        return BASE_URL;
    }

    //Retorna la url de Assets
    function media()
    {
        return BASE_URL."Assets";
    }

    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once($view_header);
    }

    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once($view_footer);
    }

    function dep($data)//mostrar los array formateadas
    {
        $format=print_r('<pre>');
        $format=print_r($data);
        $format=print_r('</pre>');
        return $format;
    }

    function getModal(string $nameModal, $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;
    }

    //elimina exceso de espacios entre palabras
    function strClean($strCadena)
    {
        //$string= preg_replace('/\s\s+/', ' ', $strCadena);
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''],$strCadena);
        $string = trim($string);//elimina espacios en blanco al ini y end
        $string= stripslashes($string);//elimina las \ inveritdas
        $string= str_ireplace("<script>","",$string);
        $string= str_ireplace("</script>","",$string);
        $string= str_ireplace("<script src>","",$string);
        $string= str_ireplace("<script type=>","",$string);
        $string= str_ireplace("SELECT*FROM","",$string);
        $string= str_ireplace("DELETE FROM","",$string);
        $string= str_ireplace("INSERT INTO","",$string);
        $string= str_ireplace("SELECT COUNT(*)FROM","",$string);
        $string= str_ireplace("DROP TABLE","",$string);
        $string= str_ireplace("OR '1'= '1","",$string);
        $string= str_ireplace('OR "1"= "1"',"",$string);
        $string= str_ireplace('OR ´1´= ´1´',"",$string);
        $string= str_ireplace("is NULL; --","",$string);
        $string= str_ireplace("is NULL; --","",$string);
        $string= str_ireplace("LIKE '","",$string);
        $string= str_ireplace('LIKE "',"",$string);
        $string= str_ireplace("LIKE ´","",$string);
        $string= str_ireplace("OR 'a'= 'a","",$string);
        $string= str_ireplace('OR "a"= "a',"",$string);
        
        $string= str_ireplace("OR ´a´= ´a","",$string);
        $string= str_ireplace("OR ´a´= ´a","",$string);
        $string= str_ireplace("--","",$string);
        $string= str_ireplace("^","",$string);
        $string= str_ireplace("[","",$string);
        $string= str_ireplace("]","",$string);
        $string= str_ireplace("==","",$string);
        return $string;
    
    }
    //genera contra de 10 cara
    function passGenerator($legth = 10)
    {

        $pass="";
        $longitudPass=$legth;
        $cadena="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass;$i++)
        {

            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);

        }
        return $pass;


    }
    //genera un token
    function token()
    {

        $r1= bin2hex(random_bytes(10));
        $r2= bin2hex(random_bytes(10));
        $r3= bin2hex(random_bytes(10));
        $r4= bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;//recuperar contra
    }
    //formato a dinero
    function formatMoney($cantidad)
    {   
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;

    }
    //html de un formulario
?>