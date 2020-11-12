
<!-- Modal-->
<div class="modal fade" id="ModalFormUsuario" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form id="formUsuario" name="formUsuario" class="form-horizontal">
                <p class="text-primary">Todos los campos son obligatorios.</p>
                <p class="text-primary">Apellido Materno es opcional.</p>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtDNI">DNI</label>
                        <input type="text" class="form-control" id="txtDNI" name="txtDNI" placeholder="Número de identificación" required="">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="txtNombres">Nombres</label>
                        <input type="text" class="form-control" id="txtNombres" name="txtNombres" placeholder="Nombres del Usuario" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtApPaterno">Apellido Paterno</label>
                        <input type="text" class="form-control" id="txtApPaterno" name="txtApPaterno" placeholder="Apellido Paterno del Usuario" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtApMaterno">Apellido Materno</label>
                        <input type="text" class="form-control" id="txtApMaterno" name="txtApMaterno" placeholder="Apellido Materno del Usuario">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtTelefono">Teléfono</label>
                        <input type="number" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Teléfono del Usuario" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtDireccion">Dirección</label>
                        <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección del Usuario" required="">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtPassword">Password</label>
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Contraseña del Usuario" required="">
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Foto de Perfil</label>
                  <input class="form-control" type="file">
                </div>

                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                </div>
              </form>
      </div>
    </div>
  </div>
</div>