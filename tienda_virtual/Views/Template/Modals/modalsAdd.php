
<!-- Modal            ModalFormAddProducto-->
<div class="modal fade" id="ModalFormAddProd" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
            <!-- <h3 class="tile-title">Añadir producto</h3>-->
            <div class="tile-body">
              <form id="formProducto" name="formProducto">
                <input type="hidden" id="IDProducto" name="IDProducto" value="">
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del producto" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Precio</label>
                  <input class="form-control" id="txtPrecio" name="txtPrecio" type="number" placeholder="Precio propuesto" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Stock</label>
                  <input class="form-control" id="txtStock" name="txtStock" type="number" placeholder="Stock inicial" required="">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Categoría</label>
                    <select class="form-control" id="listCategoria" name="listCategoria" required="">
                      <option value="1">Parrilla</option>
                      <option value="2">Clásico</option>
                      <option value="3">Sopa</option>
                      <option value="4">Ensalada</option>
                      <option value="5">Bebida</option>
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Imagen del producto</label>
                  <input class="form-control" type="file">
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>