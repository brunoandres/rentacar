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

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Búsqueda</a></li>
    <li class="breadcrumb-item"><a href="#">Checkout</a></li>
    <li class="breadcrumb-item active" aria-current="page">Confirmación</li>
  </ol>
</nav>

<section id="portfolio" class="wow fadeInDown">
  <div class="container">
    <div class="center">
      <h2>Confirme su Reserva</h2>
      <p class="lead">Verifique los datos de su reserva para confirmarla.</p>
      <p># Código reserva : <?php echo $_SESSION['codigo']; ?></p>
    </div>
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted"><i class="fa fa-money" aria-hidden="true"></i> Tarifa y Adicionales</span>
          <!--<span class="badge badge-secondary badge-pill">3</span>-->
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Categoria elegida</h6>
              <small class="text-muted">Valor diario : $<?php echo $tarifa[0]; ?></small>
            </div>
            <span class="text-success"><strong><?php echo $categoria_seleccionada[1]; ?></strong></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Días de reservas</h6>
              <small class="text-muted">Cantidad de días</small>
            </div>
            <span class="text-success"><strong><?php echo $_SESSION['total_dias']; ?> dia/s</strong></span>
          </li>
 
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Valor Reserva</h6>
              
                
              <small class="text-muted">Por días selecionados</small>
            </div>
            <span class="text-success"><strong>$<?php echo $total_por_dias = number_format($tarifa[0]*$_SESSION['total_dias'], 0, ",", "."); ?></strong></span>
          </li>

          <?php if ($tarifa[2]==1 && $cantidadPromociones>=1): ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Promociones</h6>
                <small class="text-muted">Por <?php echo $cantidadPromociones; ?> promocion/es</small>
              </div>
              <span class="text-success"><strong>$ <?php echo number_format($precio_promo, 0, ",", "."); ?></strong></span>
            </li>
          <?php endif ?>
          <?php if (!$diasSinPromo==0): ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Dias sin promo</h6>
                <small class="text-muted">Por <?php echo $diasSinPromo; ?> dia/s sin promo</small>
              </div>
              <span class="text-success"><strong>+ $ <?php echo number_format($precio_diario, 0, ",", "."); ?></strong></span>
            </li>
          <?php endif ?>

          <?php  
          $tarifa_ad = 0;
            
            if (!empty($_SESSION['adicionales'])) {
            
            
            
            foreach ($_SESSION['adicionales'] as $adicional => $value) {

              $tarifa_adicional = $ctrConfiguraciones->tarifaAdicional($value);
              
              $tarifa_ad+=$tarifa_adicional['tarifa'];
            
          

          ?>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><?php echo $tarifa_adicional['nombre']; ?>  </h6>
              <small class="text-muted">Adicional seleccionado</small>
            </div>
            <span class="text-success"><strong>+ $<?php echo number_format($tarifa_adicional['tarifa'], 2, ",", "."); ?></strong></span>
          </li>


          <?php } 
        }?>


          <li class="list-group-item d-flex justify-content-between">
            <span>Total a Pagar (ARG)</span>
            <strong>$
              <?php echo number_format($total+$tarifa_ad, 0, ",", "."); ?>
            
            <?php /*
            $total = 0;

            if ($tarifa[2]==0) {
              $total = ($tarifa[0]*$_SESSION['total_dias'])+$tarifa_ad;
            }else{
              $total = $tarifa[1]+$tarifa_ad;
            } 
            $_SESSION['tarifa'] = $total;
            echo '$'.$total;*/
            
            ?>
   
            </strong>
          </li>

        </ul>

      </div>
      <div class="col-md-8 order-md-1">
        <h3 class="mb-3"><i class="fa fa-info" aria-hidden="true"></i> Detalles de su Reserva</h3>
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
          <input type="hidden" name="tarifa_reserva" value="<?php echo $total; ?>">
          <!--<input type="hidden" name="patente_reserva" value="<?php echo $_SESSION['patente']; ?>">-->
          <input type="hidden" name="origen_reserva" value="1">
          <hr class="mb-4">
          <div class="row">

            <div class="col-md-12">
            
              <ul><i class="fa fa-calendar" aria-hidden="true"></i> <strong>Fecha desde : </strong><?php echo date("d/m/Y", strtotime($_SESSION['fecha_desde']));?> - <?php echo $_SESSION['hora_desde'].'hs'; ?> </ul>
              <ul><i class="fa fa-calendar" aria-hidden="true"></i> <strong>Fecha hasta : </strong><?php echo date("d/m/Y", strtotime($_SESSION['fecha_hasta'])); ?> - <?php echo $_SESSION['hora_hasta'].'hs'; ?> </ul>
              <ul><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Lugar retiro : </strong><?php echo $lugar_retiro['nombre']; ?></ul>
              <ul><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Lugar entrega : </strong><?php echo $lugar_entrega['nombre']; ?></ul>

            </div>

          </div>
          <hr class="mb-4">
          <br>
          <a href="inicio"><button class="btn btn-default btn-lg btn-block" type="button" onclick="return confirm('Desea cancelar su reserva?')">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button></a>
          <button class="btn btn-danger btn-lg btn-block mt-1" type="submit" name="confirmaReserva">Confirmar Reserva <i class="fa fa-check" aria-hidden="true"></i> </button>
        </form>
      
      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->

<?php } 
//Metodo para guardar nueva reserva
$nuevaReserva = $ctrReservas->nuevaReservaInsert();
?>


