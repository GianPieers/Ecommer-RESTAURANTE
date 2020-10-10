
<!-- Modal            ModalFormAddProducto-->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form id="formUsuario" name="formUsuario" class="form-horizontal">
                <input type="hidden" id="IDUsuario" name="IDUsuario" value="">
                <p class="text-primary"> Todos los campos son obligatorios</p>
                
                <!-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtIdentificacion">Identificacion</label>
                        <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion"  required="">
                    </div>
                </div> -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" class="form-control" id="txtNombre" name="txtNombre"  required="">
                    </div>
                </div>
               

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtPassword">Password</label>
                        <input type= "text" class="form-control" id="txtPassword" name="txtPassword">
                               
                        </input>
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                  
                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                  <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
      </div>
    </div>
  </div>
</div>