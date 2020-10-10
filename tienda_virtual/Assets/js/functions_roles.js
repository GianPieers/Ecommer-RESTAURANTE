//NUEVO ROL
var formRol=document.querySelector('#formRo1')
formRol.onsubmit = function(e) {
    e.preventDefault();

    var strNombre = document.querySelector('#txtNombre').Value;
    var strDescripcion = document.querySelector('#txtDescripcion').Value;
    var intStatus = document.querySelector('#listStatus').Value;
    if(strNombre == '' || strDescripcion == '' || intStatus == '')
    {
        swal("Atencion", "Todos los campos son obligatorios", "ERROR");
        return false; 
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url +'/Roles/setRol';
    var formData = new formData(formRol);
    request.open("POST", ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

    
    if(request.readyState == 4 && request.status == 200){
        var objData= JSON.parse(request.responseText);
        if(objData.status)
        {
            $('#modalFormRol').modal("hide");
            formRol.reset();
            swal("Roles de usuario", objData.msg, "success");
            tableRoles.api().ajax.reload(function(){

            });
        }else{
            swal("Error", objData.msg, "error");
        }
    }
}

}