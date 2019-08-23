<?php

/*if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}*/
$new2 = new ControladorReservas();
if (isset($_POST['checkout'])) {
  $categoria = $_POST['id_categoria'];
  $total_dias = $_SESSION['total_dias'];
  $retiro = $_POST['retiro'];
  $entrega = $_POST['entrega'];


  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $telefono = $_POST['telefono'];
  $email = $_POST['email'];
  $vuelo = $_POST['vuelo'];
  $informacion = $_POST['informacion'];

  if (empty($_POST['adicionales'])) {
    $adicionales='';
  }else{
    $adicionales = $_POST['adicionales'];
  } 

  $new = new ControladorConfiguraciones();
  $lugares = $new->listarLugares();


  // Lugares

  $lugar_retiro = $new->listarLugares($retiro);
  $lugar_entrega = $new->listarLugares($entrega);


  
  $tarifa = $new2->tarifaReserva($categoria);
  $categoria_seleccionada = explode(" ", $tarifa['categoria']);

}else{
  echo "<script>
  window.location='inicio';
  </script>";
}


?>
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
              <small class="text-muted"><?php echo $tarifa['categoria']; ?></small>
            </div>
            <span class="text-success"><strong>(<?php echo $categoria_seleccionada[1]; ?>)</strong></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Días de reservas</h6>
              <small class="text-muted">Cantidad de días</small>
            </div>
            <span class="text-success"><strong>(<?php echo $total_dias; ?>)</strong></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Valor diario</h6>
              <small class="text-muted">Tarifa por día</small>
            </div>
            <span class="text-success"><strong>$<?php echo $tarifa['valor_diario']; ?></strong></span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Valor reserva</h6>
              
                
              <small class="text-muted">Por días selecionados</small>
            </div>
            <span class="text-success"><strong>$<?php echo $tarifa['valor_diario']*$total_dias; ?></strong></span>
          </li>
          

          <?php  
          $tarifa_ad = null;
          if (!empty($_POST['adicionales'])) {
            $adicionales = $_POST['adicionales'];
            foreach ($adicionales as $adicional => $value) {
              $tarifa_adicional = $new->tarifaAdicional($value);
              
              $tarifa_ad+=$tarifa_adicional['tarifa'];
            }
          

          ?>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><?php echo $tarifa_adicional['nombre']; ?> + </h6>
              <small class="text-muted">Adicional seleccionado</small>
            </div>
            <span class="text-success"><strong>$<?php echo $tarifa_adicional['tarifa']; ?></strong></span>
          </li>
          <?php } ?>

          <li class="list-group-item d-flex justify-content-between">
            <span>Total Reserva (ARG)</span>
            <strong>

            
            <?php 
            $total = null;

            if ($tarifa['permite_promo']==0) {
              $total = ($tarifa['valor_diario']*$total_dias)+$tarifa_ad;
            }else{
              $total = $tarifa['valor_semanal'];
            } 

            echo '$'.$total;
            ?>
   
            </strong>
          </li>

        </ul>

        <!--<form class="card p-2" method="POST">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Código Descuento">
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary">Aplicar</button>
            </div>
          </div>
        </form>-->
      </div>
      <div class="col-md-8 order-md-1">
        <h3 class="mb-3"><i class="fa fa-info" aria-hidden="true"></i> Detalles de su Reserva</h3>
        <form method="post">
          <input type="hidden" name="categoria_confirmada" value="<?php echo $categoria; ?>">
          <input type="hidden" name="codigo_reserva" value="<?php echo $_SESSION['codigo']; ?>">
          <input type="hidden" name="nombre_reserva" value="<?php echo $nombre; ?>">
          <input type="hidden" name="apellido_reserva" value="<?php echo $apellido; ?>">
          <input type="hidden" name="telefono_reserva" value="<?php echo $telefono; ?>">
          <input type="hidden" name="email_reserva" value="<?php echo $email; ?>">
          <input type="hidden" name="vuelo_reserva" value="<?php echo $vuelo; ?>">
          <input type="hidden" name="fecha_desde" value="<?php echo $_SESSION['fecha_desde']; ?>">
          <input type="hidden" name="fecha_hasta" value="<?php echo $_SESSION['fecha_hasta']; ?>">
          <input type="hidden" name="retiro_reserva" value="<?php echo $retiro; ?>">
          <input type="hidden" name="entrega_reserva" value="<?php echo $entrega; ?>">
          <input type="hidden" name="informacion_reserva" value="<?php echo $informacion; ?>">
          <input type="hidden" name="adicionales_reserva" value="<?php echo $adicionales; ?>">
          <input type="hidden" name="total_dias_reserva" value="<?php echo $total_dias; ?>">
          <hr class="mb-4">
          <div class="row">

            <div class="col-md-12">
            
              <ul><i class="fa fa-calendar" aria-hidden="true"></i> Fecha desde : <?php echo date("d/m/Y", strtotime($_SESSION['fecha_desde'])); ?> </ul>
              <ul><i class="fa fa-calendar" aria-hidden="true"></i> Fecha hasta : <?php echo date("d/m/Y", strtotime($_SESSION['fecha_hasta'])); ?> </ul>
              <ul><i class="fa fa-map-marker" aria-hidden="true"></i> Lugar retiro : <?php echo $lugar_retiro['nombre']; ?></ul>
              <ul><i class="fa fa-map-marker" aria-hidden="true"></i> Lugar entrega : <?php echo $lugar_entrega['nombre']; ?></ul>

            </div>

          </div>
          <hr class="mb-4">
          <br>
          <a href="inicio"><button class="btn btn-default btn-lg btn-block" type="button" onclick="return confirm('Desea cancelar su reserva?')">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button></a>
          <button class="btn btn-danger btn-lg btn-block mt-1" type="submit" name="nuevaReservaa">Confirmar Reserva <i class="fa fa-check" aria-hidden="true"></i> </button>
        </form>
      
      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->

<?php  


//Metodo para guardar nueva reserva
$nuevaReserva = $new2->nuevaReservaInsert();


?>