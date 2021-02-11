<?php

$ctrConfiguraciones = new ControladorConfiguraciones();
$ctrReservas = new ControladorReservas();

//Cargo mi combo dinamico con los lugares
$lugares = $ctrConfiguraciones->listarLugares();

//Cargo mi combo dinamico con los adicionales
$adicionales = $ctrConfiguraciones->listarAdicionales();

//Cargo los adicionales para mostrar en ventana modal
$adicionales_modal = $ctrConfiguraciones->listarAdicionales();

if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}else{
  $categoria = $_SESSION['categoria'];
  echo "<script>
 toastr.success('En las fechas indicadas hay autos disponibles!', 'Reserva Disponible', {timeOut: 8000})
 </script>";

  echo "<script>
 toastr.info('Recuerde que debe abonar obligatoriamente el 50 % de su Reserva, de lo contrario se dará de baja la misma.', 'Aviso Importante :', {timeOut: 30000})
 </script>";
}

//$patente = $_SESSION['patente'];

//Tarifa

//Cargo mi arreglo de tarifa según la categoria
$tarifa = $ctrReservas->tarifaReserva($_SESSION['categoria'],$_SESSION['fecha_desde']);

  if (!empty($tarifa)) {
    //Cargo permito promociones por categoria
    $permite_promociones = $tarifa[3];
    //var_dump($permite_promociones);


    //Busco lugares habilitados para mostrar
    $lugares = $ctrConfiguraciones->listarLugares();
    // Lugares
    $lugar_retiro = $ctrConfiguraciones->listarLugares($_SESSION['retiro']);
    $lugar_entrega = $ctrConfiguraciones->listarLugares($_SESSION['entrega']);

    //Tarifa diaria
    $tarifa_diaria = $tarifa[0];
    //Tarifa semanal
    $tarifa_semanal = $tarifa[1];

    //echo "TARIFA DIARIA : ".$tarifa_diaria;
    //echo "<br>TARIFA SEMANAL : ".$tarifa_semanal;
    //Separo nombre de categoria para mostrar ej (A)
    $categoria_seleccionada = explode(" ", $tarifa[3]);

  //Verifico si la categoria acepta promociones
  if (intval($tarifa[2] == 1)) {

    $promo = $ctrConfiguraciones->diasParaPromociones();
    $promo = $promo['dias'];

    if ($promo==null) {
      $promo = 7;
    }

    $diasSinPromo = ($_SESSION['total_dias']%$promo);
    //echo "<br> Cantidad de promos:";

    $cantidadPromociones = (($_SESSION['total_dias']-$diasSinPromo)/$promo);
    //Precio de la promocion
    $precio_promo = ($tarifa_semanal*$cantidadPromociones);
    //Precio por dia
    $precio_diario = ($tarifa_diaria*$diasSinPromo);
    //Total reserva
    $total = ($precio_diario+$precio_promo);
    //echo "<br>Total : ".$total;
  }else{
    $total = $_SESSION['total_dias']*$tarifa_diaria;
  }
}

?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Búsqueda</a></li>
    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
    <li class="breadcrumb-item"><a href="#">Confirmación</a></li>
  </ol>
</nav>

<section id="portfolio" class="">
  <div class="container">
    <div class="center">
      <!--<h2><div class="alert alert-success" role="alert">
      <?php //echo $_SESSION['mensaje']; ?>
      </div></h2>-->
      <p class="lead"><strong class="h3">Complete el siguiente formulario para continuar con su reserva desde el <?php echo date("d/m/Y", strtotime($_SESSION['fecha_desde'])); ?> hasta el <?php echo date("d/m/Y", strtotime($_SESSION['fecha_hasta'])); ?></strong></p>
      <p class="strong"># Código Reserva : <?php echo $_SESSION['codigo']; ?> # Tarifa sin adicionales <?php echo "$ : ".number_format($total,2); ?></p>


    </div>
    <div class="row h-100 justify-content-center align-items-center">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
      Ver más Info
    </button>
    </div>
      <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-8 order-md-1">
          <h3 class="mb-3">Datos Personales</h3>
          <form class="needs-validation" novalidate method="post" action="confirmacion" onsubmit="return checkForm(this);">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nombre</label>
                <input type="text" class="form-control" maxlength="50" id="firstName" name="nombre" placeholder="Ingrese nombre" value="" required>
                <input type="hidden" name="id_categoria" value="<?php echo $categoria; ?>">
                <!--<input type="hidden" name="patente" value="<?php echo $patente; ?>">-->
                <div class="invalid-feedback">
                  Complete el campo con su nombre.
                </div>
                <input type="hidden" name="hora_desde" value="<?php echo $_SESSION['hora_desde']; ?>">
                <input type="hidden" name="hora_hasta" value="<?php echo $_SESSION['hora_hasta']; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Apellido</label>
                <input type="text" class="form-control" maxlength="50" id="lastName" name="apellido" placeholder="Ingrese apellido" value="" required>
                <div class="invalid-feedback">
                  Complete el campo con su apellido.
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="username">N° de Teléfono</label>
                <div class="input-group">
                  <!--<div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>-->
                  <input type="number" class="form-control" maxlength="20" id="username" name="telefono" placeholder="Cod. Área + Nº" required>
                  <div class="invalid-feedback" style="width: 100%;">
                    Complete el campo con su número de teléfono
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="email">Dirección de Email</label>
                <input type="email" class="form-control" maxlength="80" id="email" name="email" placeholder="juanperez@example.com" required="">
                <div class="invalid-feedback">
                  Complete el campo con su dirección de email válido.
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="address">N° de Vuelo</label>
                <input type="text" class="form-control" maxlength="15" id="address" name="vuelo" placeholder="Ej: AR1694" minlength="0">
                <div class="invalid-feedback">
                  Complete el campo con su n° de vuelo.
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <label for="country">Lugar de retiro</label>
                  <select class="form-control" id="retiro" name="retiro" style="width: 100%;">
                    <?php foreach ($lugares as $lugar) {?>
                      <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                    <?php } ?>
                  </select>
                <div class="invalid-feedback">
                  Seleccione un lugar de retiro.
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <label for="country">Lugar de devolución</label>
                  <select class="form-control" id="entrega" name="entrega" style="width: 100%;">
                    <?php foreach ($lugares as $lugar) {?>
                      <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                    <?php } ?>
                  </select>
                <div class="invalid-feedback">
                  Seleccione un lugar de entrega.
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Información Adicional</label>
                  <textarea class="form-control" name="informacion" placeholder="Ingrese alguna Información adicional que desee agregar para su reserva."></textarea>
                </div>
              </div>
            </div>
            <p class="text-justify">Los adicionales están sujetos a disponibilidad y tienen un valor diario que se suman al total de la reserva.</p>
              <select class="form-control select2" multiple="multiple" id="adicionales" name="adicionales[]" data-placeholder="Seleccionar adicionales..." style="width: 100%;">
                <?php foreach ($adicionales as $adicional) {

                  if ($adicional['nombre'] == "SEGURO PREMIUM") {
                    $tarifa2 = " - $ ".$adicional['tarifa2'];
                  }else{
                    $tarifa2 = "";
                  }

                  ?>
                  <option value="<?php echo $adicional['id']; ?>"><?php echo $adicional['nombre'].' $ '.$adicional['tarifa'].' '.$tarifa2; ?></option>
                <?php } ?>
              </select>
            <!--
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>-->
            <!--<div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>-->
            <!--<div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>-->
            <hr class="mb-4">
            <input type="checkbox" name="acepta" required>Acepto los términos acerca del abono del 50 % de mi Reserva. <br>
            <button class="btn btn-info btn-lg btn-block" type="submit" name="checkout">Click para continuar</button>
          </form>
        </div>
      </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Información a tener en cuenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>* Entrega y devolución : </strong>
        <p>Las entregas y devoluciones de los vehículos se realizan en el Centro de Bariloche, Terminal de Omnibus y Aeropuerto, de ser necesario especifique su dirección en zona céntrica en el campo observación.</p>
        <strong>* Horarios : </strong>
        <p>El horario de devolución del vehículo deberá ser el mismo definido en la reserva, de lo contrario se cobrará el adicional como un día más de alquiler.
        <strong>Consulte!</strong></p>
        <strong>* Adicionales :</strong>
        <p>Todos los adicionales añaden un costo al total de la reserva, su valor es diario, en caso de rotura ó robo de los mismos, se deberan abonar. A continuación sus valores diarios.</p>
        <ul>
          <?php foreach ($adicionales_modal as $ad) {

            if ($ad['nombre'] == "SEGURO PREMIUM") {
              $tarifa2 = " - $ ".$ad['tarifa2'];
            }else{
              $tarifa2 = "";
            }

            ?>
          <li><?php echo $ad['nombre']; ?> : <?php echo '$'.number_format($ad['tarifa'],2, ",", ".").' '.$tarifa2;; ?></li>
          <?php } ?>
        </ul>
        <p>* Todos los vehículos cuentan con cubiertas de hielo y nieve.</p>
        <p>* Los precios estan expresados en pesos Argentinos.
        El pago se realiza directamente en <strong>efectivo</strong> o por medio de <strong>  transferencia bancaria.</p></strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function checkForm(form){

    if(!form.acepta.checked) {
      alert("Por favor acepte los términos y condiciones para continuar.");
      form.acepta.focus();
      return false;
    }
    return true;
  }

</script>
