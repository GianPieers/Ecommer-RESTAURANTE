var tablaUsuarios;

document.addEventListener('DOMContentLoaded', function(){
    tablaUsuarios = $('#tablaUsuarios').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " "+base_url+"Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns": [
            { "data": "DNI" },
            { "data": "usuNombres" },
            { "data": "usuApPaterno" },
            { "data": "usuApMaterno" },
            { "data": "usuDireccion" },
            { "data": "usuTelefono" },
            { "data": "estado" },
            { "data": "opciones" },
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });

    //Nuevo usuario
    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e){
        e.preventDefault();
        
        var strDNI = document.querySelector('#txtDNI').value;
        var strNombres = document.querySelector('#txtNombres').value;
        var strApPaterno = document.querySelector('#txtApPaterno').value;
        var strApMaterno = document.querySelector('#txtApMaterno').value;
        var strDireccion = document.querySelector('#txtDireccion').value;
        var strTelefono = document.querySelector('#txtTelefono').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if(strDNI == '' || strNombres == '' || strApPaterno == '' || strDireccion == '' || strTelefono =='' || strPassword == '') //telef==0
        {
            swal("Atención", "Rellene los campos obligatorios.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'Usuarios/setUsuario';
        var formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#ModalFormUsuario').modal("hide");
                    formUsuario.reset();
                    swal("Usuarios", objData.msg ,"success");
                    tablaUsuarios.api().ajax.reload(function(){});
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
        }

    }
}, false);

window.addEventListener('load', function(){
    //fntEditUsuario();
    //fntDelUsuario();
}, false);

function fntEditUsuario(DNI){
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var dni = DNI;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'Usuarios/getUsuario/'+dni;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);

            if(objData.estado)
            {
                var estadoUsuario = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#txtDNI").value = objData.data.DNI;
                document.querySelector("#txtNombres").value = objData.data.usuNombres;
                document.querySelector("#txtApPaterno").value = objData.data.usuApPaterno;
                document.querySelector("#txtApMaterno").value = objData.data.usuApMaterno;
                document.querySelector("#txtDireccion").value = objData.data.usuDireccion;
                document.querySelector("#txtTelefono").value = objData.data.usuTelefono;
                document.querySelector("#txtPassword").value = objData.data.usuPassword;

                //no va porque no hay esa lista en nuestro form
                /*if(objData.data.estado == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="0" selected class="notBlock">Inactivo</option>';
                }

                var htmlSelect = `${optionSelect}
                                <option value="1">Activo</option>
                                <option value="1">Inactivo</option>
                                `;
                document.querySelector("#listStatus").innerHTML = htmlSelect;*/
                $('#ModalFormUsuario').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntDelUsuario(DNI){
    var dni = DNI;
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente desa eliminar el usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm){
        if(isConfirm)
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'Usuarios/delUsuario';
            var strData = "DNI="+dni;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar", objData.msg ,"success");
                        tablaUsuarios.api().ajax.reload(function(){});
                    }else{
                        swal("Atención", objData.msg , "error");
                    }
                }
            }
        }
    });
}

function openModal(){

    document.querySelector('#txtDNI').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector('#formUsuario').reset();
    
    $('#ModalFormUsuario').modal('show');
}
