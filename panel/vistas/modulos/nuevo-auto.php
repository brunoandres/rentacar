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
                <input type="text" class="form-control" id="marca" name="marca" placeholder="Ingrese la marca..." autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="categoria">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ingrese el modelo..." autocomplete="off" required>
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
                <input type="text" class="form-control" id="patente" name="patente" autocomplete="off" placeholder="Ingrese la patente..." required>
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
