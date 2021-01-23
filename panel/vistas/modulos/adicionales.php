<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$adicionales = $new->listarAdicionales(null,1);
$date = date('d/m/Y H:i:s');
$editarAdicional = $new->editarAdicional();

if (isset($_SESSION['adicional_ok'])) {
  echo "<script>
 toastr.success('Adicional guardado correctamente.', 'Listo', {timeOut: 4000})
 </script>";
 unset($_SESSION['adicional_ok']);
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Adicionales
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-info" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> Adicionales:</h4>
      En el siguiente listado figuran los adicionales con sus precios y si estan activos o no.
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="adicionales" class="table table-bordered table-striped tablas" style="width:100%">

              <thead>
              <tr>
                <th align="center">Nombre</th>
                <th align="center">Tarifa 1</th>
                <th align="center">Tarifa 2</th>
                <th align="center">Valor diario</th>
                <th align="center">Estado</th>
                <th align="center">Observaciones</th>
                <th align="center"><i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($adicionales as $adicional) {

              ?>

              <tr>
                <td><?php echo $adicional['nombre'];?></td>
                <td><?php echo '$ '.$adicional['tarifa'];?></td>
                <td><?php echo '$ '.$adicional['tarifa2'];?></td>
                <td><?php if ($adicional["tarifa_diaria"] == 1) {
                  echo "<span class='label label-success'>Si</span>";
                }else{
                  echo "<span class='label label-danger'>No</span>";
                } ?></td>
                <td><?php if ($adicional['habilitado']==1) {
                  echo "<span class='label label-success'>Habilitado</span>";
                }else{
                  echo "<span class='label label-danger'>No habilitado</span>";
                };?></td>
                <td><?php echo $adicional['observaciones'];?></td>
                <td align="center">

                  <button class="btn btn-warning btnEditarAdicional" idAdicional="<?php echo $adicional['id']; ?>" data-toggle="modal" data-target="#modalEditarAdicional"><i class="fa fa-pencil"></i></button>


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th align="center">Nombre</th>
                  <th align="center">Tarifa</th>
                  <th align="center">Tarifa 2</th>
                  <th align="center">Valor diario</th>
                  <th align="center">Estado</th>
                  <th align="center">Observaciones</th>
                  <th align="center"><i class="fa fa-gears"></i></th>
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
MODAL EDITAR ADICIONAL
======================================-->

<div id="modalEditarAdicional" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

         <a href="adicionales"><button type="button" class="close" data-dismiss="">&times;</button></a>

          <h4 class="modal-title">Editar adicional</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label>Nombre</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nombreAdicional" id="nombreAdicional" required autocomplete="off" placeholder="Nombre de adicional">

                 <input type="hidden"  name="idAdicional" id="idAdicional" required>

              </div>
            </div>
            <div class="form-group">
              <label>Tarifa 1</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control" id="tarifaAdicional" name="tarifaAdicional" autocomplete="off" placeholder="Tarifa de adicional 1" required>

              </div>
            </div>

            <div class="form-group">
              <label>Tarifa 2</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control" id="tarifaAdicional2" name="tarifaAdicional2" step="0.01" autocomplete="off" placeholder="Tarifa de adicional 2">

              </div>
            </div>

            <div class="form-group">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
            </div>

            <div class="input-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="activaAdicional" id="activaAdicional">
                  ¿Adicional habilitado?
                </label>
              </div>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" value="1" name="activaDiario" id="activaDiario">
                ¿Tarifa diaria?
              </label>
            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <a href="adicionales"><button type="button" class="btn btn-default pull-left" data-dismiss="">Salir</button></a>
          <button type="submit" class="btn btn-primary" name="editarAdicional">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
