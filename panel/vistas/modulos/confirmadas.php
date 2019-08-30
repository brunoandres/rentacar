<?php  
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorReservas();
$reservas = $new->listarReservas();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reservas confirmadas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="confirmadas" class="table table-bordered table-striped" style="width:100%">

              <thead>
              <tr>
                <th>N° RESERVA</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Retira</th>
                <th>Entrega</th>
                <th>Vuelo</th>
                <th>Adicionales</th>
                <th>Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php
              foreach ($reservas as $reserva => $value) { ?>

              <tr>                                     
                <td><?php echo $value['ID_RESERVA'];?></td>
                <td><?php echo $value['NOMBRE_APELLIDO'];?></td>
                <td><?php echo $value['CATEGORIA'];?></td>
                <td><?php echo date("d/m/Y", strtotime($value['FECHA_DESDE']));?></td>
                <td><?php echo date("d/m/Y", strtotime($value['FECHA_HASTA']));?></td>
                <td><?php echo $value['LUGAR_RETIRO'];?></td>
                <td><?php echo $value['LUGAR_ENTREGA'];?></td>
                <td><?php echo $value['NRO_DE_VUELO'];?></td>
                <td><?php echo $value['ADICIONALES'];?></td>
                <td><?php echo $value['OBSERVACIONES']; ?></td>
                  
              </tr>
              <?php } ?>                    
                                      
              </tbody>
              <tfoot>
                <tr>
                  <th>N° RESERVA</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Retira</th>
                <th>Entrega</th>
                <th>Vuelo</th>
                <th>Adicionales</th>
                <th>Opciones <i class="fa fa-gears"></i></th>
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
<!-- /.content-wrapper -->