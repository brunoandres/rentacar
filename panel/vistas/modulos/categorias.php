<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorCategorias();
$categorias = $new->listarCategorias(null,1);
$editarCategoria = $new-> editarCategoria();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Categorias
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
                <th align="center">Categoria</th>
                <th align="center" width="10%">Cantidad Autos</th>
                <th align="center">Estado Categoria</th>
                <th align="center">Permite Promociones</th>
                <th align="center">Opciones <i class="fa fa-gears"></i></th>
              </tr>
              </thead>
              <tbody>

              <?php
              $new = new ModeloCategorias();
              foreach ($categorias as $value) {

                
                $cantidad_por_categoria = $new::autosPorCategoria($value['id'],null,null);

                if (!empty($cantidad_por_categoria)) {
                  $total = $cantidad_por_categoria['total'];
                }else{
                  $total = '<span class="label label-danger">Sin Autos habilitados</span>';
                }
                  

              ?>

              <tr>
                <td><?php echo $value['nombre'];?></td>
                <td><?php echo $total; ?></td>
                <td><?php if ($value['activa']==1) {
                  echo "<span class='label label-success'>Vigente</span>";
                }else{
                  echo "<span class='label label-warning'>Inactiva</span>";
                };?></td>
                <td><?php if ($value['promo']==1) {
                  echo "<span class='label label-success'>Permite</span>";
                }else{
                  echo "<span class='label label-warning'>No permite</span>";
                };?></td>
                <td align="left">

                  <button class="btn btn-info btnEditarCategoria" idCategoria="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>


                </td>

              </tr>
              <?php

              } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th align="center">Categoria</th>
                  <th align="center" width="10%">Cantidad Autos</th>
                  <th align="center">Estado Categoria</th>
                  <th align="center">Permite Promociones</th>
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

<div id="modalEditarCategoria" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

         <a href="categorias"><button type="button" class="close" data-dismiss="">&times;</button></a>

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

                <input type="text" class="form-control input-lg" name="nombreEditar" id="nombreEditar" required autocomplete="off" placeholder="Nombre de categoria">

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

              </div>

              <div class="input-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="activaEditar" id="activaEditar">
                    ¿Categoria activa?
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="promoEditar" id="promoEditar">
                    ¿Permite promoción?
                  </label>
                </div>
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <a href="categorias"><button type="button" class="btn btn-default pull-left" data-dismiss="">Salir</button></a>
          <button type="submit" class="btn btn-primary" name="editarCategoria">Guardar cambios</button>

        </div>



      </form>

    </div>

  </div>

</div>
