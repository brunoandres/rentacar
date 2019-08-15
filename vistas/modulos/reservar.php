<?php

$new = new ControladorReservas();
$newCat = new ControladorCategorias();
$categorias = $newCat->listarCategorias();
$data = $new->nuevaReserva();

?>

<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Reservas On-line</h2>
      <p class="lead">Seleccione una categoria e ingrese las fechas para buscar disponibilidad.</p>
    </div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
        <form method="post">
          <div class="form-group">
            <label for="exampleInputPassword1">Categoria</label>
            <select class="form-control" name="categoria">
              <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Fecha desde</label>
            <input type="text" id="datepicker" class="form-control" name="fecha_desde" placeholder="Seleccione una fecha" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Fecha hasta</label>
            <input type="text" id="datepicker2" class="form-control" name="fecha_hasta" placeholder="Seleccione una fecha" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Hora desde</label>
            <input type="text" id="single-input" name="hora_desde" class="form-control timepicker" placeholder="Selecciona una hora" autocomplete="off" value="<?php echo "15:00"; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Hora hasta</label>
            <input type="text" id="single-input2" name="hora_hasta" class="form-control timepicker" placeholder="Selecciona una hora" autocomplete="off" value="<?php echo "15:00"; ?>" readonly>
          </div>
          <input type="submit" name="buscarDisponibilidad" value="Buscar disponibilidad" class="btn btn-success">
        </form>
      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->
