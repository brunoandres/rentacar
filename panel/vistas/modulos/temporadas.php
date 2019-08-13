<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$temporadas = $new->listarTemporadas();
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
                <th align="center">Nombre</th>
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
                <td><?php echo $temp['nombre'];?></td>
                <td><?php echo fechaCastellano($temp['fecha_desde']);?></td>
                <td><?php echo fechaCastellano($temp['fecha_hasta']);?></td>
                <td><?php if ($temp['activa']==1) {
                  echo "<span class='label label-success'>Vigente</span>";
                }else{
                  echo "<span class='label label-danger'>Inactiva</span>";
                };?></td>
                <td><?php echo $temp['observaciones'];?></td>
                <td align="center">

                  <a href="index.php?ruta=editar-temporada&id=<?php echo $temp['id']; ?>"> <button type="button" class="btn btn-warning">Editar</button> </a>

                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th align="center" width="20%">Nombre</th>
                  <th align="center">Fecha desde</th>
                  <th align="center">Fecha hasta</th>
                  <th align="center">Estado</th>
                  <th align="center" width="40%">Detalle</th>
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