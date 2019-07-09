<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$temporadas = $new->temporadas();
$date = date('d/m/Y H:i:s');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Temporadas
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
      En el siguiente listado figuran las temporadas y si estan activas o no, dependiendo su estado, se puden cargar las tarifas.
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="temporadas" class="table table-bordered table-striped tablas" style="width:100%">

              <thead>
              <tr>
                <th align="center">id</th>
                <th align="center">Fecha desde</th>
                <th align="center">Fecha hasta</th>
                <th align="center">Estado</th>
                <th align="center">Detalle</th>
                <th align="center"><i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($temporadas as $temp) {

              ?>

              <tr>
                <td><?php echo $temp['id'];?></td>
                <td><?php echo fechaCastellano($temp['fecha_desde']);?></td>
                <td><?php echo fechaCastellano($temp['fecha_hasta']);?></td>
                <td><?php if ($temp['activa']==1) {
                  echo "<span class='label label-success'>Vigente</span>";
                }else{
                  echo "<span class='label label-danger'>Inactiva</span>";
                };?></td>
                <td><?php echo $temp['detalle'];?></td>
                <td align="center">

                  <button class="btn btn-warning btnEditarCategoria" idCategoria="<?php echo $temp['id']; ?>" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th align="center">id</th>
                  <th align="center">Fecha desde</th>
                  <th align="center">Fecha hasta</th>
                  <th align="center">Estado</th>
                  <th align="center">Detalle</th>
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
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nombreCategoria" id="editarCategoria" required autocomplete="off">

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="editarCategoria">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
