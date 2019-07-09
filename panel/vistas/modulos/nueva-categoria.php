<?php
$new = new ControladorCategorias();
$new->nuevaCategoria();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Nueva Categoria
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Carga de Categorias</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form role="form" method="post">
            <div class="box-body">
              <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Ingrese el nombre de la categoria" autocomplete="off" required> 
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkActiva" class="flat-red" checked>
                  ¿Categoria activa?
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="1" name="checkPromo" class="flat-red" checked>
                  ¿Permite promoción?
                </label>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="nuevaCategoria" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
