<?php
$new = new ControladorCategorias();
$categorias = $new->listarCategorias();
$new2 = new ControladorConfiguraciones();
$nuevo = $new2->nuevoAuto();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nuevo Auto
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-info" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> A tener en cuenta:</h4>
      Formulario de carga de autos, seleccionando la categoria correspondiente, importante ingresar la patente, si está habilitado para circular por Argentina y si está habilitado a salir al exterior.
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Carga de Autos</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form id="form" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="categoria">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" placeholder="Nombre de marca" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="categoria">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Nombre del modelo" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" id="select_categoria" name="categoria" style="width: 100%;">
                        <?php foreach ($categorias as $categoria) {?>
                          <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                        <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="categoria">Patente</label>
                <input type="text" class="form-control" id="patente" name="patente" maxlength="7" autocomplete="off" placeholder="Nº de patente: ABC123 - AD123AB" required>
              </div>
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" name="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkHabilitado" class="flat-red" checked="">
                  ¿Auto habilitado?
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkChile" class="flat-red">
                  ¿Habilitado Chile?
                </label>
              </div>
            </div>

            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="nuevoAuto" class="btn btn-primary">Guardar</button>
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
