<?php 
  headerAdmin($data);
  getModal('modalPromociones',$data);
?>
    <!-- <div id="contentAjax"></div> -->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-minus" aria-hidden="true"></i> <?= $data['page_title'] ?>
            <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa fa-plus" aria-hidden="true"></i>Nueva Promoción</button>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>Promociones"><?= $data['page_title']?></a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaPromociones">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descuento</th>
                      <th>Stock</th>
                      <th>Producto</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php footerAdmin($data);?>