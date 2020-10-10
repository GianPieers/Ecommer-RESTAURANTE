
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
            { "data": "IDUsuario" },
            { "data": "usuNombre" },
            { "data": "usuPassword" },
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });

    //Nuevo rol
    var formProducto = document.querySelector("#formUsuarios");
    formProducto.onsubmit = function(e){
        e.preventDefault();
        
        var intIDProducto = document.querySelector('#IDUsuarios').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var dblPrecio = document.querySelector('#txtPassword').value;
        
        if(strNombre == '' || intIDUsuario==0 || strusuPassword== '' )
        {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'Usuarios/setUsuarios';
        var formData = new FormData(formProducto);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                //console.log(request.responseText);
                var objData = JSON.parse(request.responseText);
                //console.log(objData);
                if(objData.status)
                {     //ModalFormAddProducto
                    $('#modalFormAddUsu').modal("hide");
                    formProducto.reset();
                    swal("Usuarios a añadir", objData.msg ,"success");
                    tableRoles.api().ajax.reload(function(){
                        //fntEditProducto();
                        //fntDelProducto();
                    });
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
        }

    }
});

$('#tablaProductos').DataTable();

function openModal(){

    document.querySelector('#IDProducto').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector('#formProducto').reset();
    
    $('#ModalFormAddProd').modal('show'); //ModalFormAddProducto
}

window.addEventListener('load', function(){
    fntEditProducto();
}, false);

function fntEditProducto(){
    console.log();
    var btnEditProducto = document.querySelectorAll(".btnEditProducto");
    btnEditProducto.forEach(function(btnEditProducto){
        console.log();
        btnEditProducto.addEventListener('click', function(){
            document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML = "Actualizar";

            var idproducto = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'Productos/getProducto/'+idproducto;
            request.open("GET",ajaxUrl,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);
                    var objData = JSON.parse(request.responseText);

                    if(objData.estado)
                    {
                        document.querySelector("#IDProducto").value = objData.data.IDProducto;
                        document.querySelector("#txtNombre").value = objData.data.proNombre;
                        document.querySelector("#txtPrecio").value = objData.data.proPrecioPropuesto;
                        document.querySelector("#txtStock").value = objData.data.proStock;
                        document.querySelector("#listCategoria").value = objData.data.IDCategoria;

                        if(objData.data.estado == 1)
                        {
                            var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                        }else{
                            var optionSelect = '<option value="0" selected class="notBlock">Inactivo</option>';
                        }

                        var htmlSelect = `${optionSelect}
                                        <option value="1">Activo</option>
                                        <option value="1">Inactivo</option>
                                        `;
                        //document.querySelector("#listStatus").innerHTML = htmlSelect;
                        $('#ModalFormAddProd').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }

            //$('#ModalFormAddProd').modal('show'); //ModalFormAddProducto
        });
    });
}