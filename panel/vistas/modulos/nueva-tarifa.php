<?php
$new = new ControladorCategorias();
$new2 = new ControladorConfiguraciones();
$categorias=$new->listarCategorias();
$temporadas=$new2->listarTemporadas(null,1);
$new2->nuevaTarifa();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nueva Tarifa
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-info" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> Tarifas:</h4>
      <p class="h4">En el siguiente formulario se podran cargar nuevas tarifas, seleccionando una categoria y definiendo a que temporada (cargada previamente y que esté en estado activa) corresponden los nuevos valores.</p>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">

          <form role="form" method="post">
            <div class="box-body">
              <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" id="select" name="select_categoria" data-placeholder="Seleccione una categoria..." style="width: 100%;">
                  <?php foreach ($categorias as $categoria) {?>
                    <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                
                <label>Temporadas activas</label>
                <?php if (empty($temporadas)) {
                  echo '<div class="alert alert-danger" role="alert">
                    No existen temporadas activas! Cargar nueva <a href="nueva-temporada">Temporada.</a>
                  </div>';
                } ?>
                <select class="form-control" style="width: 100%;" name="select_temporada" data-placeholder="Selecione una temporada..." required="">
                    <?php foreach ($temporadas as $temporada) {?>
                      <option value="<?php echo $temporada['id']; ?>"><?php echo $temporada['nombre'].' # '.date('d/m/Y', strtotime($temporada['fecha_desde'])).' al '.date('d/m/Y', strtotime($temporada['fecha_hasta'])); ?></option>
                    <?php } ?>
                </select>


                </select>
              </div>

              <div class="form-group">
                <label for="categoria">Precio por dia</label>
                <input type="number" step="0.1" class="form-control" id="valor_diario" name="valor_diario" placeholder="0.00" autocomplete="off" required>
              </div>

              <div class="form-group">
                <label for="categoria">Precio por semana</label>
                <input type="number" step="0.1" class="form-control" id="valor_semanal" name="valor_semanal" placeholder="0.00" autocomplete="off" required>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkTarifa" class="flat-red" checked>
                  ¿Tarifa actual?
                </label>
              </div>


            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="nuevaTarifa" class="btn btn-primary">Guardar</button>
              <a href="inicio"> <button type="button" class="btn btn-default" name="button">Cancelar</button> </a>
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
