<?php

$new = new ControladorConfiguraciones();

//Cargo mi combo dinamico con los lugares
$lugares = $new->listarLugares();

//Cargo mi combo dinamico con los adicionales
$adicionales = $new->listarAdicionales();

//Cargo los adicionales para mostrar en ventana modal
$adicionales_modal = $new->listarAdicionales();

if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}else{
  $categoria = $_SESSION['categoria'];
}

?>
<section id="portfolio" class="wow fadeInDown">
  <div class="container">
    <div class="center">
      <h2><div class="alert alert-success" role="alert">
      <?php echo $_SESSION['mensaje']; ?>
      </div></h2>
      <p class="lead">Complete el siguiente formulario para continuar con su reserva desde el <?php echo date("d/m/Y", strtotime($_SESSION['fecha_desde'])); ?> hasta el <?php echo date("d/m/Y", strtotime($_SESSION['fecha_hasta'])); ?></p>
      <p># Código reserva : <?php echo $_SESSION['codigo']; ?></p>
      <p><?php echo $_SESSION['categoria']; ?></p>
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
          <form class="needs-validation" novalidate method="post" action="confirma">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nombre</label>
                <input type="text" class="form-control" maxlength="50" id="firstName" name="nombre" placeholder="Ingrese nombre" value="" required>
                <input type="hidden" name="id_categoria" value="<?php echo $categoria; ?>">
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
                <label for="country">Lugar de entrega</label>
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
            <p class="text-justify">Los adicionales están sujetos a disponibilidad.</p>
              <select class="form-control select2" multiple="multiple" id="adicionales" name="adicionales[]" data-placeholder="Seleccionar adicionales..." style="width: 100%;">
                <?php foreach ($adicionales as $adicional) {?>
                  <option value="<?php echo $adicional['id']; ?>"><?php echo $adicional['nombre'].' $ '.$adicional['tarifa']; ?></option>
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
        <strong>* Adicionales</strong>
        <p>Todos los adicionales añaden un costo al total de la reserva, en caso de rotura ó robo de los mismos, se deberan abonar con los siguientes valores.</p>
        <ul>
          <?php foreach ($adicionales_modal as $ad) { ?>  
          <li><?php echo $ad['nombre']; ?> : <?php echo '$'.$ad['tarifa']; ?></li>
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