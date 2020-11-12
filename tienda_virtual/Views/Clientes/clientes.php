<?php 
  headerAdmin($data);
  getModal('modalClientes',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-list" aria-hidden="true"></i> <?= $data['page_title'] ?>
            <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa fa-plus" aria-hidden="true"></i>Nuevo Cliente</button>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>Clientes"><?= $data['page_title']?></a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaClientes">
                  <thead>
                    <tr>
                      <th>DNI</th>
                      <th>Nombres</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Dirección</th>
                      <th>Correo Electrónico</th>
                      <th>Celular</th>
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