<?php  
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorReservas();
$newConf = new ControladorConfiguraciones();

$date = date('Y-m-d');     
$reservas = $new->listarReservas(1,"fecha_desde = '$date'");

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reservas confirmadas para hoy <?php echo date("d/m/Y"); ?>
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
                  <th width="8%">N° RESERVA</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Retira en</th>
                  <th>Entrega en</th>
                  <th>Hora retiro</th>
                  <th>Nº Vuelo</th>
                  <th>Reserva</th>
                  <th>Adicionales</th>
                  <th>Ver / Editar</th>
                </tr>
              </thead>
              <tbody>

              <?php
              foreach ($reservas as $reserva => $value) { 

                $adicionales = NULL;
                $tiene_adicionales = $newConf->buscarAdicionales($value['ID_RESERVA']);
                if (!empty($tiene_adicionales)) {
                  $adicionales = $tiene_adicionales['adicionales'];
                }

              ?>

              <tr>                                     
                <td align="left"><?php echo $value['ID_RESERVA'];?></td>
                <td><?php echo $value['NOMBRE_APELLIDO'];?></td>
                <td><?php echo $value['CATEGORIA'];?></td>
                <td><?php echo date("d/m/Y", strtotime($value['FECHA_DESDE']));?></td>
                <td><?php echo date("d/m/Y", strtotime($value['FECHA_HASTA']));?></td>
                <td><?php echo $value['LUGAR_RETIRO'];?></td>
                <td><?php echo $value['LUGAR_ENTREGA'];?></td>
                <td><?php echo $value['HORA_DESDE'];?></td>
                <td><?php echo $value['NRO_DE_VUELO'];?></td>
                <td><?php if ($value['ORIGEN_RESERVA']==1) {
                    echo "<span class='label label-success'>desde la web</span>";
                }else{
                  echo "<span class='label label-info'>desde el panel</span>";
                }?>
                  
                </td>
                <td><?php echo $adicionales;?></td>

                <td>

                  <button type="button" name="view_data" value="" id="<?php echo $value['ID_RESERVA']; ?>" class="btn btn-info btn-xs view_data"><i class="fa fa-eye" aria-hidden="true"></i></button>

                  <button type="button" name="view_data" value="" id="<?php echo $value['ID_RESERVA']; ?>" class="btn btn-warning btn-xs view_data"><i class="fa fa-eye" aria-hidden="true"></i></button>

                </td>
                  
              </tr>
              <?php } ?>                    
                                      
              </tbody>
              <tfoot>
                  <th width="8%">N° RESERVA</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Retira en</th>
                  <th>Entrega en</th>
                  <th>Hora retiro</th>
                  <th>Nº Vuelo</th>
                  <th>Reserva</th>
                  <th>Adicionales</th>
                  <th>Ver / Editar</th>
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

<div id="dataModal" class="modal fade">
  <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Detalle de Reserva</h4>
        </div>
        <div class="modal-body" id="detalles">
        </div>
        <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
     </div>
  </div>
</div>