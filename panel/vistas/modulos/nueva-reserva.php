<?php
$_SESSION['page' ] = 'nueva-reserva';
$ctrCategoria = new ControladorCategorias();
$categorias = $ctrCategoria->listarCategorias();

$ctrReservas = new ControladorReservas();
$buscarDisponiblidad = $ctrReservas->buscarDisponibilidad('panel');


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
          <form id="" method="post">
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
                      <input type="text" class="form-control pull-right fechadesde" name="fecha_desde" autocomplete="off" readonly="" value="<?php if(isset($_POST['fecha_desde'])){
                        echo $_POST['fecha_desde'];
                      } ?>" placeholder="Seleccione una fecha..." required="">
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
                    <input type="text" class="form-control pull-right fechahasta" name="fecha_hasta" autocomplete="off" readonly="" value="<?php if(isset($_POST['fecha_hasta'])){
                        echo $_POST['fecha_hasta'];
                      } ?>" placeholder="Seleccione una fecha..." required="">
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
                <label>Hora Desde</label>
              
                <select class="form-control" name="hora_desde" required="">
                  <option value="00:00">00:00hs</option>
                  <option value="01:00">01:00hs</option>
                  <option value="02:00">02:00hs</option>
                  <option value="03:00">03:00hs</option>
                  <option value="04:00">04:00hs</option>
                  <option value="05:00">05:00hs</option>
                  <option value="06:00">06:00hs</option>
                  <option value="07:00">07:00hs</option>
                  <option value="08:00">08:00hs</option>
                  <option value="09:00">09:00hs</option>
                  <option value="10:00">10:00hs</option>
                  <option value="11:00">11:00hs</option>
                  <option value="12:00">12:00hs</option>
                  <option value="13:00">13:00hs</option>
                  <option value="14:00">14:00hs</option>
                  <option value="15:00" selected="">15:00hs</option>
                  <option value="16:00">16:00hs</option>
                  <option value="17:00">17:00hs</option>
                  <option value="18:00">18:00hs</option>
                  <option value="19:00">19:00hs</option>
                  <option value="20:00">20:00hs</option>
                  <option value="21:00">21:00hs</option>
                  <option value="22:00">22:00hs</option>
                  <option value="23:00">23:00hs</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Hora Hasta</label>
              
                <select class="form-control" name="hora_hasta" required="">
                  <option value="00:00">00:00hs</option>
                  <option value="01:00">01:00hs</option>
                  <option value="02:00">02:00hs</option>
                  <option value="03:00">03:00hs</option>
                  <option value="04:00">04:00hs</option>
                  <option value="05:00">05:00hs</option>
                  <option value="06:00">06:00hs</option>
                  <option value="07:00">07:00hs</option>
                  <option value="08:00">08:00hs</option>
                  <option value="09:00">09:00hs</option>
                  <option value="10:00">10:00hs</option>
                  <option value="11:00">11:00hs</option>
                  <option value="12:00">12:00hs</option>
                  <option value="13:00">13:00hs</option>
                  <option value="14:00">14:00hs</option>
                  <option value="15:00" selected="">15:00hs</option>
                  <option value="16:00">16:00hs</option>
                  <option value="17:00">17:00hs</option>
                  <option value="18:00">18:00hs</option>
                  <option value="19:00">19:00hs</option>
                  <option value="20:00">20:00hs</option>
                  <option value="21:00">21:00hs</option>
                  <option value="22:00">22:00hs</option>
                  <option value="23:00">23:00hs</option>
                </select>
              </div>
            </div>

          </div>
          <button type="submit" class="btn btn-success" name="buscarDisponibilidad">Buscar disponibilidad</button>
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
