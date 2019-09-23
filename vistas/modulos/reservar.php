<?php

$new = new ControladorReservas();
$newCat = new ControladorCategorias();
$categorias = $newCat->listarCategorias();
$data = $new->buscarDisponibilidad('web');

if (isset($_SESSION['reserva_error'])) {

  echo "<script>
 toastr.error('Se ha producido un error al intentar reservar, por favor intente nuevamente.', 'Error al Reservar', {timeOut: 3000})
 </script>";

 unset($_SESSION['reserva_error']);

}

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Búsqueda</li>
    <li class="breadcrumb-item"><a href="#">Checkout</a></li>
    <li class="breadcrumb-item"><a href="#">Confirmación</a></li>
  </ol>
</nav>

<section id="portfolio" class="wow fadeInDown">
  <div class="container">
    <div class="center">
      <h2>Reservas On-line</h2>
      <div class="alert alert-warning" role="alert">
          La devolución del vehiculo debe ser dentro de las 24hs. De lo contrario se cobrará un adicional extra.
          </div>
      <p class="lead">Seleccione una categoria e ingrese las fechas para buscar disponibilidad.</p>
    </div>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-sm-6 col-sm-offset-3">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputPassword1">Categoria</label>
            <select class="form-control" name="categoria">
              <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria['id']; ?>" <?php if (isset($_POST['categoria']) && $categoria['id']==$_POST['categoria']) {
                  echo "selected";
                } ?>><?php echo $categoria['nombre']; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Fecha desde</label>
            <div class="input-group">
              <input type="text" class="form-control fechadesde" name="fecha_desde" placeholder="YYYY / MM / DD" id="fechadesde" autocomplete="off" value="<?php if(isset($_POST['fecha_desde'])){ echo $_POST['fecha_desde']; }else{ echo date('Y-m-d'); } ?>">
              <span class="input-group-btn">
            <!--<button class="btn btn-default" type="button" id="datepicker-btn"><i class="fa fa-calendar" aria-hidden="true"></i></button>-->
            </span>
            </div>
            <!-- /input-group -->
          </div>

          <div class="form-group">
            <label>Fecha hasta</label>
            <div class="input-group">
              <input type="text" class="form-control fechahasta" name="fecha_hasta" placeholder="YYYY / MM / DD" id="fechahasta" autocomplete="off" value="<?php if(isset($_POST['fecha_hasta'])){ echo $_POST['fecha_hasta']; }else{ echo date('Y-m-d'); } ?>">
              <span class="input-group-btn">
            <!--<button class="btn btn-default" type="button" id="datepicker-btn"><i class="fa fa-calendar" aria-hidden="true"></i></button>-->
            </span>
            </div>
            <!-- /input-group -->
          </div>

          <div class="form-group">
            <label>Hora desde</label>
            <input type="time" id="single-input" name="hora_desde" max="23:59" class="form-control timepicker" placeholder="Selecciona una hora" autocomplete="off" value="<?php if(isset($_POST['hora_desde'])){ echo $_POST['hora_desde']; }?>" required="">
          </div>
          
          <div class="form-group">
            <label>Hora hasta</label>
            <input type="time" id="single-input2" name="hora_hasta" max="23:59" class="form-control timepicker" placeholder="Selecciona una hora" autocomplete="off" value="<?php if(isset($_POST['hora_hasta'])){ echo $_POST['hora_hasta']; }?>" required="">
          </div>
          <button type="submit" name="buscarDisponibilidad" class="btn btn-success btn-lg">Buscar Disponibilidad <i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->


