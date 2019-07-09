<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$configuraciones = $new->listarConfiguraciones();

/*$editarConfiguracion = new ControladorConfiguraciones();
$editarConfiguracion -> editarConfiguracion();

*/
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Configuraciones del Sistema
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
                <th align="center">Id</th>
                <th align="center">Nombre</th>
                <th align="center">Valor</i></th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($configuraciones as $value) {

              ?>

              <tr>
                <td><?php echo $value['id'];?></td>
                <td width="50%"><?php echo $value['nombre'];?></td>
                <td width="50%"><?php echo $value['valor'];?></td>
                <td width="50%" align="center">

                  <button class="btn btn-warning btnEditarConfig" idConfig="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarConfig"><i class="fa fa-pencil"></i></button>


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                <th align="center">Id</th>
                <th align="center">Nombre</th>
                <th align="center">Valor</i></th>
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
