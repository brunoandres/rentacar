<?php
$new = new ControladorConfiguraciones();
$new->nuevoAdicional();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nuevo Adicional
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Carga de Adicionales</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form id="form" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="categoria">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre_adicional" placeholder="Ingrese el nombre..." autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="categoria">Tarifa 1</label>
                <input type="number" class="form-control" id="tarifa" name="tarifa" step="0.01" autocomplete="off" placeholder="Ingrese la tarifa..." required>
              </div>
              <div class="form-group">
                <label for="categoria">Tarifa 2</label>
                <input type="number" class="form-control" id="tarifa" name="tarifa2" step="0.01" autocomplete="off" placeholder="Ingrese la tarifa extra...">
              </div>

              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" name="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="check" class="flat-red" checked>
                  ¿Adicional habilitado?
                </label>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkDiario" class="flat-red" checked>
                  ¿Tarifa diaria?
                </label>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="nuevoAdicional" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
