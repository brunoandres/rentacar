<?php

$new = new ControladorConfiguraciones();
$lugares = $new->listarLugares();

if (isset($_POST['checkout'])) {

?>
<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Detalle Reserva</h2>
      <p class="lead">Complete el siguiente formulario para continuar con su reserva desde el <?php echo $_SESSION['fecha_desde']; ?> hasta el <?php echo $_SESSION['fecha_hasta']; ?></p>
      <p># Código reserva : <?php echo $_SESSION['codigo']; ?></p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Detalle Reserva</span>
            <!--<span class="badge badge-secondary badge-pill">3</span>-->
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$12</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$8</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Third item</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$20</strong>
            </li>
          </ul>

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h3 class="mb-3">Datos Personales</h3>
          <form class="needs-validation" novalidate method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nombre</label>
                <input type="text" class="form-control" id="firstName" placeholder="Ingrese nombre" value="" required>
                <div class="invalid-feedback">
                  Complete el campo con su nombre.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Apellido</label>
                <input type="text" class="form-control" id="lastName" placeholder="Ingrese apellido" value="" required>
                <div class="invalid-feedback">
                  Complete el campo con su apellido.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">N° de Teléfono</label>
              <div class="input-group">
                <!--<div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>-->
                <input type="number" class="form-control" id="username" placeholder="Ingrese su número de teléfono" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Complete el campo con su número de teléfono
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Dirección de Email</label>
              <input type="email" class="form-control" id="email" placeholder="juanperez@example.com">
              <div class="invalid-feedback">
                Complete el campo con su dirección de email válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">N° de Vuelo</label>
              <input type="text" class="form-control" id="address" placeholder="AR1694">
              <div class="invalid-feedback">
                Complete el campo con su n° de vuelo.
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Lugar de retiro</label>
                <select class="form-control" id="select_categoria" name="select_categoria" data-placeholder="Seleccionar adicionales..." style="width: 100%;">
                          <?php foreach ($lugares as $lugar) {?>
                            <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                          <?php } ?>
                  </select>
                <div class="invalid-feedback">
                  Seleccione un lugar de retiro.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="country">Lugar de entrega</label>
                <select class="form-control" id="select_categoria" name="select_categoria" data-placeholder="Seleccionar adicionales..." style="width: 100%;">
                          <?php foreach ($lugares as $lugar) {?>
                            <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['lugar']; ?></option>
                          <?php } ?>
                  </select>
                <div class="invalid-feedback">
                  Seleccione un lugar de entrega.
                </div>
              </div>
              <!--<div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>-->
            </div>
            <hr class="mb-4">
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
            </div>
            <div class="row">
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
            </div>
            <div class="row">
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
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        </div>
      </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->
<?php }else{
  echo "NO POST";
} ?>
