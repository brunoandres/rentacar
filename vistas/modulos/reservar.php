<?php

unset($_SESSION['codigo']);
unset($_SESSION['fecha_desde']);
unset($_SESSION['fecha_hasta']);
unset($_SESSION['hora_desde']);
unset($_SESSION['hora_hasta']);
unset($_SESSION['categoria']);
unset($_SESSION['total_dias']);
unset($_POST['confirmaReserva']);


$new = new ControladorReservas();
$newCat = new ControladorCategorias();
$categorias = $newCat->listarCategorias();
$data = $new->buscarDisponibilidad('web');

if (isset($_SESSION['reserva_error'])) {

  echo "<script>
 toastr.error('Se ha producido un error al intentar reservar, por favor intente nuevamente.', 'Error al Reservar', {timeOut: 6000})
 </script>";

 unset($_SESSION['reserva_error']);

}elseif (isset($_SESSION['reserva_error_codigo'])) {
  echo "<script>
 toastr.error('Error al procesar los datos de la Reserva, intente nuevamente.', 'Error al Reservar', {timeOut: 6000})
 </script>";
 unset($_SESSION['reserva_error_codigo']);
}

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Búsqueda</li>
    <li class="breadcrumb-item"><a href="#">Checkout</a></li>
    <li class="breadcrumb-item"><a href="#">Confirmación</a></li>
  </ol>
</nav>

<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Reservas On-line</h2>
      <div class="alert alert-warning" role="alert">
          La devolución del vehiculo debe ser dentro de las 24hs. De lo contrario se cobrará un adicional extra. Se deberá abonar dentro de las 48hs el 15 % del costo de la reserva, de lo contrario se dará de baja la misma.
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
            <label>Fecha Desde</label>
            <div class="input-group">
              <input type="text" class="form-control" name="fecha_desde" placeholder="YYYY / MM / DD" id="datepicker" autocomplete="off" value="<?php if(isset($_POST['fecha_desde'])){ echo $_POST['fecha_desde']; }else{ echo date('Y-m-d'); } ?>" required="required" readonly="readonly">
              <span class="input-group-btn">
            </span>
            </div>
          </div>

          <div class="form-group">
            <label>Fecha Hasta</label>
            <div class="input-group">
              <input type="text" class="form-control" name="fecha_hasta" placeholder="YYYY / MM / DD" id="datepicker2" autocomplete="off" value="<?php if(isset($_POST['fecha_hasta'])){ echo $_POST['fecha_hasta']; }else{ echo date('Y-m-d'); } ?>" required="required" readonly="readonly">
              <span class="input-group-btn">
            </span>
            </div>
          </div>

          <div class="form-group">
            <label>Hora desde</label>
              <select class="form-control" name="hora_desde" required="">
                <option value="">seleccionar hora...</option>
                <option value="00:00">00:00hs</option>
                <option value="01:00">01:00hs</option>
                <option value="02:00">02:00hs</option>
                <option value="03:00">03:00hs</option>
                <option value="04:00">04:00hs</option>
                <option value="05:00">05:00hs</option>
                <option value="06:00">06:00hs</option>
                <option value="07:00">07:00hs</option>
                <option value="08:00">08:00hs</option>
                <option value="09:00">09:00hs</option>
                <option value="10:00">10:00hs</option>
                <option value="11:00">11:00hs</option>
                <option value="12:00">12:00hs</option>
                <option value="13:00">13:00hs</option>
                <option value="14:00">14:00hs</option>
                <option value="15:00">15:00hs</option>
                <option value="16:00">16:00hs</option>
                <option value="17:00">17:00hs</option>
                <option value="18:00">18:00hs</option>
                <option value="19:00">19:00hs</option>
                <option value="20:00">20:00hs</option>
                <option value="21:00">21:00hs</option>
                <option value="22:00">22:00hs</option>
                <option value="23:00">23:00hs</option>
              </select>
          </div>

          <div class="form-group">
            <label>Hora hasta</label>
            <select class="form-control" name="hora_hasta" required="">
                <option value="">seleccionar hora...</option>
                <option value="00:00">00:00hs</option>
                <option value="01:00">01:00hs</option>
                <option value="02:00">02:00hs</option>
                <option value="03:00">03:00hs</option>
                <option value="04:00">04:00hs</option>
                <option value="05:00">05:00hs</option>
                <option value="06:00">06:00hs</option>
                <option value="07:00">07:00hs</option>
                <option value="08:00">08:00hs</option>
                <option value="09:00">09:00hs</option>
                <option value="10:00">10:00hs</option>
                <option value="11:00">11:00hs</option>
                <option value="12:00">12:00hs</option>
                <option value="13:00">13:00hs</option>
                <option value="14:00">14:00hs</option>
                <option value="15:00">15:00hs</option>
                <option value="16:00">16:00hs</option>
                <option value="17:00">17:00hs</option>
                <option value="18:00">18:00hs</option>
                <option value="19:00">19:00hs</option>
                <option value="20:00">20:00hs</option>
                <option value="21:00">21:00hs</option>
                <option value="22:00">22:00hs</option>
                <option value="23:00">23:00hs</option>
              </select>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información importante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $tolerancia = ModeloConfiguraciones::buscarConfiguracion("Tolerancia");
        $apertura = ModeloConfiguraciones::buscarConfiguracion("Apertura");
        $cierre = intval(ModeloConfiguraciones::buscarConfiguracion("Horas Oficina"));

        $time_apertura = intval($apertura).":00";
        $hora_aper = date("H:i",strtotime($time_apertura));

        $hora_cierre = date('H:i', strtotime($hora_aper."+$cierre hour"));

        ?>
        * Horarios :
        <p align="justify">El horario de entrega y devolución del vehículo deberán ser los mismos, de todas maneras se tendrá en cuenta la tolerancia de <?php echo intval($tolerancia); ?> hora/s de diferencia. En caso de no ser así, se cobrará un adicional por el tiempo excedido.
        Es importante saber que nuestro horario de atención para retiros y entregas es de <?php echo $hora_aper; ?>hs am a <?php echo $hora_cierre; ?>hs pm . Tenga en cuenta ésta información, ya que si su reserva está fuera de nuestro horario laboral, se cobrará un costo extra detallado en la reserva.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){
  $('#exampleModal').modal('show')
});

</script>
