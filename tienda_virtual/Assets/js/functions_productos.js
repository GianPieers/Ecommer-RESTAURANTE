var tablaProductos;

document.addEventListener('DOMContentLoaded', function(){
    tablaProductos = $('#tablaProductos').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " "+base_url+"Productos/getProductos",
            "dataSrc":""
        },
        "columns": [
            { "data": "IDProducto" },
            { "data": "proNombre" },
            { "data": "proPrecioPropuesto" },
            { "data": "proStock" },
            { "data": "IDCategoria" },
            { "data": "estado" },
            { "data": "opciones" },
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });

    //Nuevo producto
    var formProducto = document.querySelector("#formProducto");
    formProducto.onsubmit = function(e){
        e.preventDefault();
        
        var intIDProducto = document.querySelector('#IDProducto').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var dblPrecio = document.querySelector('#txtPrecio').value;
        var intStock = document.querySelector('#txtStock').value;
        var intCategoria = document.querySelector('#listCategoria').value;
        if(strNombre == '' || dblPrecio == 0 || intStock == 0 || intCategoria == '')
        {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'Productos/setProducto';
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
                    $('#ModalFormAddProd').modal("hide");
                    formProducto.reset();
                    swal("Productos a añadir", objData.msg ,"success");
                    tablaProductos.api().ajax.reload(function(){
                        fntEditProducto();
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
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector('#formProducto').reset();
    
    $('#ModalFormAddProd').modal('show'); //ModalFormAddProducto
}

window.addEventListener('load', function(){
    fntEditProducto();
    fntDelProducto();
}, false);

function fntEditProducto(){
    //console.log();
    var btnEditProducto = document.querySelectorAll(".btnEditProducto");
    btnEditProducto.forEach(function(btnEditProducto){
        //console.log();
        btnEditProducto.addEventListener('click', function(){
            document.querySelector('#titleModal').innerHTML = "Actualizar Producto";
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
                    //console.log(request.responseText);
                    var objData = JSON.parse(request.responseText);

                    if(objData.estado)
                    {
                        document.querySelector("#IDProducto").value = objData.data.IDProducto;
                        document.querySelector("#txtNombre").value = objData.data.proNombre;
                        document.querySelector("#txtPrecio").value = objData.data.proPrecioPropuesto;
                        document.querySelector("#txtStock").value = objData.data.proStock;
                        document.querySelector("#listCategoria").value = objData.data.IDCategoria;

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
                        $('#ModalFormAddProd').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
        });
    });
}

function fntDelProducto(){
    var btnDelProducto = document.querySelectorAll(".btnDelProducto")
    btnDelProducto.forEach(function(btnDelProducto){
        btnDelProducto.addEventListener('click', function(){
            var idproducto = this.getAttribute("rl");
            console.log(idproducto);
            //alert(idproducto);
            swal({
                title: "Eliminar Producto",
                text: "¿Realmente desa eliminar el producto?",
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
                    var ajaxUrl = base_url+'Productos/delProducto';
                    var strData = "IDProducto="+idproducto;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            //console.log(request.responseText);
                            var objData = JSON.parse(request.responseText);
                            //console.log(objData);
                            if(objData.status)
                            {
                                swal("Eliminar", objData.msg ,"success");
                                tablaProductos.api().ajax.reload(function(){
                                    fntEditProducto();
                                    fntDelProducto();
                                });
                            }else{
                                swal("Atención", objData.msg , "error");
                            }
                        }
                    }
                }
            });
        });
    });
}