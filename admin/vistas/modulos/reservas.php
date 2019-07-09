<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">   
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reservas Austral Rent a Car</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped" style="width:100%">

                <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Cat.</th>
                  <th>Desde</th>
                  <th>Hora</th>
                  <th>Retira</th>
                  <th>Vuelo</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                
                <?php  

                $reservas = new ControladorReservas();
                $reservas = $reservas->listarReservas(1);
                foreach ($reservas as $key => $value) {

                ?>
                <tr>
                  <td><?php echo $value['id_reserva']; ?></td>
                  <td><?php echo $value['nombre']; ?></td>
                  <td><?php echo $value['vehiculo']; ?></td>
                  <td><?php echo $value['fdesde']; ?></td>
                  <td><?php echo $value['hdesde']; ?></td>
                  <td><?php echo $value['retiro']; ?></td>
                  <td><?php echo $value['vuelo']; ?></td>
                  <td>
                    
                  <a href="detalle?nro=<?php echo $value['id_reserva']; ?>"><i class="fa fa-eye"></i></a>
                  <i class="fa fa-th-list"></i>
                  <i class="fa fa-times"></i>

                  </td>
                </tr>
                  
                <?php } ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Cat.</th>
                  <th>Desde</th>
                  <th>Hora</th>
                  <th>Retira</th>
                  <th>Vuelo</th>
                  <th>Opciones</th>
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