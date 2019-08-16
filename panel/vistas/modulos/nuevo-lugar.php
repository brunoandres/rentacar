<?php
$new = new ControladorConfiguraciones();
$new->nuevoLugar();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nuevo Lugar
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
            <h3 class="box-title">Para retiro o entrega</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form role="form" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="categoria">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre_lugar" placeholder="Ingrese el nombre..." autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" name="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkActiva" class="flat-red" checked>
                  ¿Lugar activo?
                </label>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="nuevoLugar" class="btn btn-primary">Guardar</button>
              <a href="inicio"> <button type="button" class="btn btn-default">Cancelar</button> </a>
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
