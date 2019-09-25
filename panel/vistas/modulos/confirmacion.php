<?php

if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}


$ctrReservas = new ControladorReservas();
//Si esta seteado mi formulario con los datos personales
if (isset($_POST['checkout'])) {

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

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reserva
        <small>#<?php echo $_SESSION['codigo']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Nota:</h4>
        Confirme la Reserva con los siguientes datos.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $_POST['nombre']; ?>
            <small class="pull-right">Fecha: <?php echo date('d/m/Y'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          
          <address>
            <strong>Nombre :</strong> <?php echo $_POST['nombre'].' '.$_POST['apellido']; ?><br>
            <strong>Fecha Desde :</strong> <?php echo date("d/m/Y", strtotime($_SESSION['fecha_desde']));?><br>
            <strong>Fecha Hasta :</strong> <?php echo date("d/m/Y", strtotime($_SESSION['fecha_hasta']));?><br>
            <strong>Phone :</strong> <?php echo $_POST['telefono']; ?><br>
            <strong>Email :</strong> <?php echo $_POST['email']; ?>
          </address>
        </div>
      </div>
      <!-- /.row -->
      <?php  
          $tarifa_ad = 0;
            
            if (!empty($_SESSION['adicionales'])) {
            
            
            
              foreach ($_SESSION['adicionales'] as $adicional => $value) {

                $tarifa_adicional = $ctrConfiguraciones->tarifaAdicional($value);
                
                $tarifa_ad+=$tarifa_adicional['tarifa'];
                //var_dump($tarifa_adicional);
              
             }}
           ?>

           <li class="list-group-item d-flex justify-content-between">
            <span>Total a Pagar (ARG)</span>
            <strong>$
              <?php $total_pesos = $total+$tarifa_ad; echo number_format($total_pesos, 0, ",", "."); ?>
  
            </strong>
          </li>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <form method="post">
            <input type="hidden" name="categoria_confirmada" value="<?php echo $_SESSION['categoria_seleccionada']; ?>">
            <input type="hidden" name="codigo_reserva" value="<?php echo $_SESSION['codigo']; ?>">
            <input type="hidden" name="nombre_reserva" value="<?php echo $_SESSION['nombre']; ?>">
            <input type="hidden" name="apellido_reserva" value="<?php echo $_SESSION['apellido']; ?>">
            <input type="hidden" name="telefono_reserva" value="<?php echo $_SESSION['telefono']; ?>">
            <input type="hidden" name="email_reserva" value="<?php echo $_SESSION['email']; ?>">
            <input type="hidden" name="vuelo_reserva" value="<?php echo $_SESSION['vuelo']; ?>">
            <input type="hidden" name="fecha_desde" value="<?php echo $_SESSION['fecha_desde']; ?>">
            <input type="hidden" name="fecha_hasta" value="<?php echo $_SESSION['fecha_hasta']; ?>">
            <input type="hidden" name="retiro_reserva" value="<?php echo $_SESSION['retiro']; ?>">
            <input type="hidden" name="entrega_reserva" value="<?php echo $_SESSION['entrega']; ?>">
            <input type="hidden" name="informacion_reserva" value="<?php echo $_SESSION['informacion']; ?>">
            <input type="hidden" name="hora_desde_reserva" value="<?php echo $_SESSION['hora_desde']; ?>">
            <input type="hidden" name="hora_hasta_reserva" value="<?php echo $_SESSION['hora_hasta']; ?>">
            <input type="hidden" name="total_dias_reserva" value="<?php echo $_SESSION['total_dias']; ?>">
            <input type="hidden" name="tarifa_reserva" value="<?php echo $total_pesos; ?>">
            <input type="hidden" name="origen_reserva" value="0">
            <button type="submit" name="confirmaReserva" class="btn btn-success pull-right"><i class="fa fa-ok"></i> Confirmar Reserva
          </button>
          </form>       
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

<?php } 
//Metodo para guardar nueva reserva
$nuevaReserva = $ctrReservas->nuevaReservaInsert('panel');
?>


