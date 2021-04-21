<?php

if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}else{
  $categoria = $_SESSION['categoria'];
  echo "<script>
 toastr.success('En las fechas indicadas hay autos disponibles!', 'Reseva Disponible', {timeOut: 4000})
 </script>";
}

$ctrConfiguraciones = new ControladorConfiguraciones();

//Cargo mi combo dinamico con los lugares
$lugares = $ctrConfiguraciones->listarLugares();
//Cargo mi combo dinamico con los adicionales
$adicionales = $ctrConfiguraciones->listarAdicionales();

?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>
        Reserva Disponible

      </h2>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Búsqueda</a></li>
        <li><a href="#">Checkout</a></li>
        <li class="active">Confirmar</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Nota:</h4>
        <p class="lead">Complete el siguiente formulario para completar y confirmar la Reserva desde el <?php echo date("d/m/Y", strtotime($_SESSION['fecha_desde'])); ?> hasta el <?php echo date("d/m/Y", strtotime($_SESSION['fecha_hasta'])); ?></p>
      <p># Código Reserva : <strong class="h4"><?php echo $_SESSION['codigo']; ?></strong></p>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <form role="form" action="confirmacion" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" maxlength="50" id="nombre" name="nombre" placeholder="Complete el nombre" required="">
              <input type="hidden" name="id_categoria" value="<?php echo $categoria; ?>">
              <input type="hidden" name="hora_desde" value="<?php echo $_SESSION['hora_desde']; ?>">
              <input type="hidden" name="hora_hasta" value="<?php echo $_SESSION['hora_hasta']; ?>">
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input type="TEXT" class="form-control" maxlength="50" id="apellido" name="apellido" placeholder="Complete el apellido">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Complete el telefono de contacto">
            </div>

            <div class="form-group">
              <label for="telefono">Correo Electrónico</label>
              <input type="email" class="form-control" maxlength="50" id="email" name="email" placeholder="Complete el correo electrónico / Ingrese un correo válido para enviar comprobante de la Reserva" required="">
            </div>

            <div class="form-group">
              <label for="telefono">Nº de Vuelo / Transporte / Embarcación</label>
              <input type="text" class="form-control" id="vuelo" name="vuelo" placeholder="Complete el correo electrónico / Ingrese un correo válido para enviar comprobante de la Reserva">
            </div>

            <div class="form-group">
              <label for="retiro">Lugar de Retiro</label>
              <select class="form-control" id="retiro" name="retiro" style="width: 100%;">
                    <?php foreach ($lugares as $lugar) {?>
                      <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                    <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="devolucion">Lugar de Devolución</label>
              <select class="form-control" id="entrega" name="entrega" style="width: 100%;">
                    <?php foreach ($lugares as $lugar) {?>
                      <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                    <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="">Información Adicional</label>
              <textarea class="form-control" name="informacion" placeholder="Ingrese alguna Información adicional que desee agregar para su reserva."></textarea>
            </div>

            <div class="form-group">
      	    <p>Los adicionales están sujetos a disponibilidad.</p>
              <select class="form-control select2" multiple="multiple" id="adicionales_seleccionados" name="adicionales[]" data-placeholder="Seleccionar adicionales...">
                <?php foreach ($adicionales as $adicional) {?>
                  <option value="<?php echo $adicional['id']; ?>"><?php echo $adicional['nombre'].' $ '.$adicional['tarifa']; ?></option>
                <?php } ?>
              </select>
            </div>

          </div>
              <!-- /.box-body -->

          <div class="box-footer">
          	<a href="inicio"> <button type="button" class="btn btn-default"> Cancelar </button> </a>
            <button type="submit" class="btn btn-danger" name="checkout">Continuar Reserva</button>
          </div>
        </form>

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
