<?php


$new = new ControladorReservas();
$newCat = new ControladorCategorias();
$categorias = $newCat->listarCategorias();
$data = $new->ingresarReserva();

?>
<h2>Ingrese las fechas para buscar disponibilidad</h2>
<div class="container-fluid">
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
      <input type="text" id="datepicker" class="form-control" name="fecha_desde" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Fecha hasta</label>
      <input type="text" id="datepicker2" class="form-control" name="fecha_hasta" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Hora desde</label>
      <input type="text" id="timepicker" name="hora_desde" class="form-control timepicker" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Hora hasta</label>
      <input type="text" id="timepicker" name="hora_hasta" class="form-control timepicker" autocomplete="off">
    </div>
    <input type="submit" name="formFechas" value="Buscar disponibilidad..." class="btn btn-primary">
  </form>
</div>
