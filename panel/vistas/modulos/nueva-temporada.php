<?php  
$new = new ControladorConfiguraciones();
$new->nuevaTempo();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nueva Temporada
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-warning" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> A tener en cuenta:</h4>
      A continuación, podrá cargar una nueva temporada o crear un rango de fechas personalizados que luego a continuacion le permitirá cargarle las tarifas por cada categoria. Asegurese de no interponer fechas con temporadas anteriores.
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
            <h3 class="box-title">Carga de Temporadas</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form id="form" method="post">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" name="nombre_temporada" required="" placeholder="Nombre de temporada" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                    <div class="form-group">
                    <label>Fecha hasta:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right fechahasta" name="fecha_hasta"required="" autocomplete="off" readonly="" value="<?php echo date("Y-m-d"); ?>" placeholder="Seleccione una fecha">
                    </div>
                    <!-- /.input group -->
                  </div>
                  </div>
                  
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Fecha desde:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right fechadesde" name="fecha_desde" required="" autocomplete="off" readonly="" value="<?php echo date("Y-m-d"); ?>" placeholder="Seleccione una fecha">
                    </div>
                    <!-- /.input group -->
                  </div>
                  
                </div>
              </div>
              <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" name="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="check" class="flat-red" checked>
                  ¿Temporada activa?
                </label>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="nuevaTemporada" class="btn btn-primary">Guardar</button>
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