<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$lugares = $new->listarLugares();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lugares de retiro y entrega
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
            <table id="categorias" class="table table-bordered table-striped tablas" style="width:100%">

              <thead>
              <tr>
                <th align="center">Nombre</th>          
                <th align="center">Activo</i></th>
                <th align="center">Observaciones</i></th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($lugares as $lugar) {

              ?>

              <tr>
                <td width="50%"><?php echo $lugar['lugar'];?></td>
                
                <td><?php if ($lugar['activo']==1) {
                  echo "<span class='label label-success'>Si</span>";
                }else{
                  echo "<span class='label label-danger'>No</span>";
                };?></td>
                <td width="20%"><?php echo $lugar['observaciones'];?></td>
                <td width="50%" align="left">

                  <button class="btn btn-warning btnEditarLugar" idLugar="<?php echo $lugar['id']; ?>" data-toggle="modal" data-target="#modalEditarLugares"><i class="fa fa-pencil"></i></button>


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                <th align="center">Nombre</th>          
                <th align="center">Activo</i></th>
                <th align="center">Observaciones</i></th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
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

<div id="modalEditarLugares" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar lugar</h4>

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

                <input type="text" class="form-control input-lg" name="nombreLugar" id="nombreLugar" required autocomplete="off" placeholder="Nombre Lugar">

                 <input type="hidden"  name="id_lugar" id="idLugar" required>

              </div>
            </div>

            <div class="form-group">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" value="1" name="checkActiva" class="flat-red" checked>
                ¿Lugar activo?
              </label>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="editarConfiguracion">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
