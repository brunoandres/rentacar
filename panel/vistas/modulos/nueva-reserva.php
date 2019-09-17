<?php
$_SESSION['page' ] = 'nueva-reserva';
$new = new ControladorConfiguraciones();
$new2 = new ControladorCategorias();
$adicionales = $new->listarAdicionales();
$categorias = $new2->listarCategorias();
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nueva Reserva
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Formulario de reserva</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Seleccione Fecha Desde, Fecha Hasta, Hora de retiro y entrega para comprobar Disponibilidad.</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form id="form" method="post">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="categoria">
                  <?php foreach ($categorias as $categoria) { ?>
                    <option value="<?php echo $categoria['id']; ?>" <?php if (isset($_POST['categoria']) && $categoria['id']==$_POST['categoria']) {
                      echo "selected";
                    } ?>><?php echo $categoria['nombre']; ?></option>
                  <?php } ?>
                </select>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha desde:</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right fechadesde" name="fecha_desde" autocomplete="off" readonly="" placeholder="Seleccione una fecha...">
                    </div>
                </div>
              </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Fecha Hasta:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right fechahasta" name="fecha_hasta" autocomplete="off" readonly="" placeholder="Seleccione una fecha...">
                  </div>
              </div>
              <!--<div class="form-group">
                <label>Adicionales</label>
                <select class="form-control select2" multiple="multiple" id="select" name="select" data-placeholder="Seleccionar adicionales..."
                        style="width: 100%;">
                        <?php foreach ($adicionales as $adicional) {?>
                          <option value="<?php echo $adicional['id']; ?>"><?php echo $adicional['nombre']; ?></option>
                        <?php } ?>
                </select>
              </div>
               /.form-group -->

              <!-- /.form-group -->
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Hora desde</label>
                <input type="time" id="single-input" name="hora_desde" max="23:59" class="form-control timepicker" placeholder="Selecciona una hora" autocomplete="off" value="<?php if(isset($_POST['hora_desde'])){ echo $_POST['hora_desde']; }?>" required="">
              </div>
            </div>

          </div>
          <button type="submit" class="btn btn-success">Buscar disponibilidad</button>
          <!-- /.row -->
          </form>
        </div>

        </div>



      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

  <?php
  /*$new = new ControladorReservas();
  $new->crearReserva();*/

  ?>
