<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$tarifas = $new->listarTarifas();
$new2 = new ControladorCategorias();
$categorias=$new2->listarCategorias();
$temporadas=$new->listarTemporadas();
$editar = $new->editarTarifa();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tarifas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-info" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> A tener en cuenta:</h4>
      En la siguiente tabla figuran las tarifas por cada categoria y a la temporada que corresponde.
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tarifas" class="table table-bordered table-striped tablas" style="width:100%">

              <thead>
              <tr>
                <th>Categoria</th>
                <th>Por dia</th>
                <th>Semanal</th>
                <th>Temporada</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($tarifas as $value) {

              ?>
              <tr>
                <td><?php echo $value['nombre']; ?></td>
                <td><?php echo '$ '.$value['por_dia']; ?></td>
                <td><?php echo '$ '.$value['por_semana']; ?></td>
                <td><?php echo $value['temporada'].' '.mostrarFecha($value['fecha_desde'])." - ".mostrarFecha($value['fecha_hasta']); ?></td>
                <td>
                  <button class="btn btn-warning btnEditarTarifa" idCategoria="<?php echo $value['id_categoria']; ?>" idTarifa="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarTarifa"><i class="fa fa-pencil"></i></button>
                </td>
              </tr>

              <?php } ?>

              </tbody>
              <tfoot>
              <tr>
                <th>Categoria</th>
                <th>Por dia</th>
                <th>Semanal</th>
                <th>Temporada</th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!--=====================================
MODAL EDITAR TARIFA
======================================-->

<div id="modalEditarTarifa" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

         <a href="tarifas"><button type="button" class="close" data-dismiss="">&times;</button></a>

          <h4 class="modal-title">Editar tarifa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              <label>Categoria</label>
              <select class="form-control" id="select_categoria" name="select_categoria" data-placeholder="Seleccione una categoria..." style="width: 100%;">
                      <?php foreach ($categorias as $categoria) {?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                      <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Temporada</label>
              <select class="form-control" id="select_temporada" name="select_temporada" data-placeholder="Selecione una temporada..." style="width: 100%;" style="width: 100%;">
                      <?php foreach ($temporadas as $temporada) {?>
                        <option value="<?php echo $temporada['id']; ?>"><?php echo $temporada['nombre'].' # '.date('d/m/Y', strtotime($temporada['fecha_desde'])).' - '.date('d/m/Y', strtotime($temporada['fecha_hasta'])); ?></option>
                      <?php } ?>
              </select>
              <input type="hidden"  name="id_tarifa" id="idTarifa" required>
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
                <input type="checkbox" value="1" name="checkTarifa" id="activaTarifaActual">
                ¿Tarifa actual?
              </label>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <a href="tarifas"><button type="button" class="btn btn-default pull-left" data-dismiss="">Salir</button></a>
          <button type="submit" class="btn btn-primary" name="editarTarifa" onclick="return confirm('Confirma modificar las tarifas?')">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
