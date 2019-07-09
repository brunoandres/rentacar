<?php  
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorReservas();
$reservas = $new->listarReservas(1);

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
                <th>N°</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th width="10%">Desde</th>
                <th>Hora</th>
                <th>Retira</th>
                <th>Vuelo</th>
                <th>Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php
              foreach ($reservas as $reserva => $value) { ?>

              <tr>                                     
                <td><?php echo $value['id_reserva'];?></td>
                <td><?php echo $value['nombre'];?></td>
                <td><?php echo $value['categoria'];?></td>
                <td><?php echo date("d/m/Y", strtotime($value['fecha']));?></td>
                <td><?php echo $value['hdesde'];?></td>
                <td><?php echo $value['retiro'];?></td>
                <td><?php echo $value['vuelo']; ?></td>
                <td width="20%">

                  <button type="button" name="view" id="<?php echo $value["id_reserva"];?>" class="btn btn-info btn-sm view_data"><i class="fa fa-eye" aria-hidden="true"></i></button>

                  <button type="button" name="edit" value="Edit" id="<?php echo $value["id_reserva"];?>" class="btn btn-warning btn-sm edit_data"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>

                  <a href="anular_reserva.php?reserva=<?php echo $value["id_reserva"];?>"onclick="return confirm('Estás seguro que deseas anular la reserva?');"><button type="button" class="btn btn-sm btn-danger">Anular</button></a>

                </td>      
              </tr>
              <?php } ?>                    
                                      
              </tbody>
              <tfoot>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th width="10%">Desde</th>
                  <th>Hora</th>
                  <th>Retira</th>
                  <th>Vuelo</th>
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