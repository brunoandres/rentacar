<?php

if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}


$ctrReservas = new ControladorReservas();
//Si esta seteado mi formulario con los datos personales
if (isset($_POST['btnCheckOut'])) {

  $_SESSION['categoria_seleccionada'] = $_POST['id_categoria'];
  $_SESSION['total_dias'] = $_SESSION['total_dias'];
  $_SESSION['retiro'] = $_POST['retiro'];
  $_SESSION['entrega'] = $_POST['entrega'];
  $_SESSION['nombre'] = $_POST['nombre'];
  $_SESSION['apellido'] = $_POST['apellido'];
  $_SESSION['telefono'] = $_POST['telefono'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['vuelo'] = $_POST['vuelo'];
  $_SESSION['informacion'] = $_POST['informacion'];
  $_SESSION['hora_desde'] = $_POST['hora_desde'];
  $_SESSION['hora_hasta'] = $_POST['hora_hasta'];
  //$_SESSION['patente'] = $_POST['patente'];
  
  if (empty($_POST['adicionales'])) {
    $_SESSION['adicionales']='';
  }else{
    $_SESSION['adicionales'] = $_POST['adicionales'];
  } 
  ///////////**Controlador configuraciones**///////
  $ctrConfiguraciones = new ControladorConfiguraciones();
  ///////////**Controlador reservas**//////////////
  

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
  }else{
    echo "<script>
  window.location='inicio';
  </script>";
  }

?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Búsqueda</a></li>
    <li class="breadcrumb-item"><a href="#">Checkout</a></li>
    <li class="breadcrumb-item active" aria-current="page">Confirmación</li>
  </ol>
</nav>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> AdminLTE, Inc.
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Admin, Inc.</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Call of Duty</td>
              <td>455-981-221</td>
              <td>El snort testosterone trophy driving gloves handsome</td>
              <td>$64.50</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Need for Speed IV</td>
              <td>247-925-726</td>
              <td>Wes Anderson umami biodiesel</td>
              <td>$50.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Monsters DVD</td>
              <td>735-845-642</td>
              <td>Terry Richardson helvetica tousled street art master</td>
              <td>$10.70</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Grown Ups Blue Ray</td>
              <td>422-568-642</td>
              <td>Tousled lomo letterpress</td>
              <td>$25.99</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due 2/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$250.30</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

<?php } 
//Metodo para guardar nueva reserva
$nuevaReserva = $ctrReservas->nuevaReservaInsert();
?>


