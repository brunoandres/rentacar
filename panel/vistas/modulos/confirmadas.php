<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorReservas();
$newConf = new ControladorConfiguraciones();
$reservas = $new->listarReservas(NULL,1,NULL);
//Cargo mi combo dinamico con los lugares
$lugares = $newConf->listarLugares();

$autos = $newConf->listarAutos();

$editarReserva = $new->editarReserva();


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
            <table id="confirmadas" class="table table-bordered table-striped tablas" style="width:100%">

              <thead>
                <tr>
                  <th width="8%">N° RESERVA</th>
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Retira en</th>
                  <th>Devuelve en</th>
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
                }else{
                  $adicionales = 'No tiene';
                }

              ?>

              <tr>
                <td align="left"><?php echo $value['ID_RESERVA'];?></td>
                <td><?php echo $value['NOMBRE_APELLIDO'];?></td>
                <td><?php echo $value['CATEGORIA'];?></td>
                <td><?php echo date("d/m/Y", strtotime($value['FECHA_DESDE']));?></td>
                <td><?php echo date("d/m/Y", strtotime($value['FECHA_HASTA']));?></td>
                <td><?php echo $value['LUGAR_RETIRO'].'::'.$value['HORA_DESDE'];?></td>
                <td><?php echo $value['LUGAR_ENTREGA'].'::'.$value['HORA_HASTA'];?></td>
                <td><?php echo $value['NRO_DE_VUELO'];?></td>
                <td><?php if ($value['ORIGEN_RESERVA']==1) {
                    echo "<span class='label label-success'>desde la web</span>";
                }else{
                  echo "<span class='label label-info'>desde el panel</span>";
                }?>

                </td>
                <td><?php echo "<span class='badge badge-secondary'>".$adicionales."</span></h6>"?></td>

                <td>

                  <button type="button" id="<?php echo $value['ID_RESERVA']; ?>" class="btn btn-info btn-xs view_data"><i class="fa fa-eye" aria-hidden="true"></i></button>

                  <button class="btn btn-warning btn-xs btnEditarReserva" idReserva="<?php echo $value['ID_RESERVA']; ?>" data-toggle="modal" data-target="#modalEditarReserva"><i class="fa fa-pencil"></i></button>

                  <button type="button" name="view_data" value="" idReserva="<?php echo $value['ID_RESERVA']; ?>" class="btn btn-danger btn-xs btnEliminarReserva"><i class="fa fa-times" aria-hidden="true"></i></button>

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

<?php

if (isset($_GET['idReserva'])) {

  $borrar = $new->eliminarReserva($_GET['idReserva']);

}

?>

<!--=====================================
MODAL EDITAR RESERVA
======================================-->

<div id="modalEditarReserva" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Reserva </h4>



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
                <input type="text" class="form-control input-lg" name="nombre" id="nombre" required autocomplete="off" placeholder="Nombre">
                <input type="hidden" name="idReserva" id="idReserva" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="apellido" id="apellido" autocomplete="off" placeholder="Apellido">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="telefono" id="telefono" autocomplete="off" placeholder="N° de Teléfono">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="email" class="form-control input-lg" name="email" id="email" required autocomplete="off" placeholder="Correo Electrónico">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="vuelo" id="vuelo" autocomplete="off" placeholder="N° de Vuelo">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" step="0.1" class="form-control input-lg" name="tarifa" id="tarifa" required autocomplete="off" placeholder="Ingreso monto de tarifa">
              </div>
            </div>

            <div class="form-group">
              <label for="country">Lugar de retiro</label>
                <select class="form-control" id="retiro" name="retiro" style="width: 100%;">
                  <?php foreach ($lugares as $lugar) {?>
                    <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                  <?php } ?>
                </select>
            </div>

            <div class="form-group">
              <label for="country">Lugar de devolución</label>
                <select class="form-control" id="devolucion" name="devolucion" style="width: 100%;">
                  <?php foreach ($lugares as $lugar) {?>
                    <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                  <?php } ?>
                </select>
            </div>

            <div class="form-group">
              <label for="country">Auto</label>
                <select class="form-control" id="idAuto" name="idAuto" style="width: 100%;">
                  <option value="">LIBRE</option>
                  <?php foreach ($autos as $auto) {?>
                    <option value="<?php echo $auto['id']; ?>"><?php echo $auto['nombre'].' :: '.$auto['marca'].' '.$auto['modelo'].' Pat:: '.$auto['patente']; ?></option>
                  <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" name="editarReserva">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
