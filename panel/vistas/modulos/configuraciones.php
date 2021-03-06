<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$configuraciones = $new->listarConfiguraciones();
$editar = $new->editarConfiguracion();
/*$editarConfiguracion = new ControladorConfiguraciones();
$editarConfiguracion -> editarConfiguracion();

*/

if (isset($_SESSION['configuracion_ok'])) {
  echo "<script>
 toastr.success('configuración guardada correctamente', 'Listo!', {timeOut: 4000})
 </script>";
 unset($_SESSION['configuracion_ok']);
 
}
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
                <th align="center">Nombre</th>
                <th align="center">Valor</i></th>
                <th align="center">Estado</i></th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($configuraciones as $value) {

              ?>

              <tr>
                <td width="50%"><?php echo $value['nombre'];?></td>
                <td width="20%"><?php echo $value['valor'];?></td>
                <td><?php if ($value['activa']==1) {
                  echo "<span class='label label-success'>Activa</span>";
                }else{
                  echo "<span class='label label-danger'>Inactiva</span>";
                };?></td>
                <td width="50%" align="left">

                  <button class="btn btn-warning btnEditarConfiguracion" idConfig="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarConfig"><i class="fa fa-pencil"></i></button>

                  <?php if ($_SESSION['is_admin']==1): ?>
                    <button class="btn btn-danger btnEliminarConfiguracion" idConfiguracion="<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></button>
                  <?php endif ?>
                  


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                <th align="center">Nombre</th>
                <th align="center">Valor</i></th>
                <th align="center">Estado</i></th>
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

<div id="modalEditarConfig" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar configuración</h4>

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

                <input type="text" class="form-control input-lg" name="nombreConfig" id="nombreConfig" required autocomplete="off" placeholder="Nombre de configuración">

                 <input type="hidden"  name="id_configuracion" id="idConfiguracion" required>

              </div>
            </div>

            <div class="form-group">
              <label>Valor</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="valorConfig" id="valorConfig" required autocomplete="off" placeholder="Valor de configuración">

              </div>
            </div>

            <div class="input-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="activaEditar" id="activaEditar">
                  ¿Configuración activa?
                </label>
              </div>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <a href="configuraciones"><button type="button" class="btn btn-default pull-left" data-dismiss="">Salir</button></a>

          <button type="submit" class="btn btn-primary" name="editarConfiguracion">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
