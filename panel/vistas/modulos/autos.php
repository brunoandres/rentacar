<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$new2 = new ControladorCategorias();
$autos = $new->listarAutos();
$categorias = $new2->listarCategorias();
$editar = $new->editarAuto();

//var_dump($_SESSION['mensaje_editado']);
if (isset($_SESSION['auto_ok'])) {
  echo "<script>
 toastr.success('Auto guardado correctamente', 'Listo!', {timeOut: 4000})
 </script>";
 unset($_SESSION['auto_ok']);
 
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Autos
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
            <table id="autos" class="table table-bordered table-striped tablas" style="width:100%">
              <thead>
              <tr>
                <th align="center">Marca</th>
                <th align="center">Modelo</th>
                <th align="center">Categoria</th>
                <th align="center">Patente</th>
                <th align="center">Habilitado</th>
                <th align="center">Habilitado Chile</th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($autos as $auto) {

              ?>

              <tr>
                <td><?php echo $auto['marca'];?></td>
                <td><?php echo $auto['modelo'];?></td>
                <td><?php echo $auto['nombre'];?></td>
                <td><?php echo $auto['patente'];?></td>
                <td><?php if ($auto['estado']==1) {
                  echo "<span class='label label-success'>Activo</span>";
                }else{
                  echo "<span class='label label-danger'>Inactivo</span>";
                };?></td>
                <td><?php if ($auto['viaja_chile']==1) {
                  echo "<span class='label label-success'>Si</span>";
                }else{
                  echo "<span class='label label-danger'>No</span>";
                };?></td>
                
              
                <td align="left">

                  <button class="btn btn-warning btnEditarAuto" idAuto="<?php echo $auto['id']; ?>" data-toggle="modal" data-target="#modalEditarAuto"><i class="fa fa-pencil"></i></button>


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th align="center">Marca</th>
                  <th align="center">Modelo</th>
                  <th align="center">Categoria</th>
                  <th align="center">Patente</th>
                  <th align="center">Habilitado</th>
                  <th align="center">Habilitado Chile</th>
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
MODAL EDITAR AUTO
======================================-->

<div id="modalEditarAuto" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

         <a href="categorias"><button type="button" class="close" data-dismiss="">&times;</button></a>

          <h4 class="modal-title">Editar Auto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label for="categoria">Marca</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="marca" id="marcaAuto" required autocomplete="off" placeholder="Nombre de marca">

                 <input type="hidden"  name="id_auto" id="idAuto" required>

              </div>  

            </div>

            <div class="form-group">
              <label for="categoria">Modelo</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="modelo" id="modeloAuto" required autocomplete="off" placeholder="Nombre de modelo">

              </div>

            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" id="select_categoria" name="categoria" style="width: 100%;">
                  <?php foreach ($categorias as $categoria) {?>
                    <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                  <?php } ?>
                </select>
              </div>

            <div class="form-group">
              <label for="categoria">Patente</label>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="patente" id="patente" minlength="6" maxlength="7" autocomplete="off" placeholder="Nº de patente: ABC123 - AD123AB" required="">

              </div>

            </div>

            <div class="form-group">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Ingrese alguna observación adicional..."></textarea>
            </div>

            <div class="input-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="habilitado" id="habilitado">
                  ¿Auto habilitado?
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="habilitado_chile" id="habilitadoChile">
                  ¿Habilitado Chile?
                </label>
              </div>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <a href="autos"><button type="button" class="btn btn-default pull-left" data-dismiss="">Salir</button></a>
          <button type="submit" class="btn btn-primary" name="editarAuto">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
