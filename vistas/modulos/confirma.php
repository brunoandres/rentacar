<?php

if (empty($_SESSION['codigo'])) {
  echo "<script>
  window.location='inicio';
  </script>";
}

$new2 = new ControladorReservas();

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

  if (empty($_POST['adicionales'])) {
    $_SESSION['adicionales']='';
  }else{

    $_SESSION['adicionales'] = $_POST['adicionales'];
  } 

  var_dump($_SESSION['adicionales']);

  $new = new ControladorConfiguraciones();
  $lugares = $new->listarLugares();

  // Lugares
  $lugar_retiro = $new->listarLugares($_SESSION['retiro']);
  $lugar_entrega = $new->listarLugares($_SESSION['entrega']);

  //Cargo mi tarifa segun la categoria
  $tarifa = $new2->tarifaReserva($_SESSION['categoria']);

  //Separo nombre de categoria para mostrar ej (A)
  $categoria_seleccionada = explode(" ", $tarifa['categoria']);




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
              <small class="text-muted">Valor diario : $<?php echo $tarifa['valor_diario']; ?></small>
            </div>
            <span class="text-success"><strong>(<?php echo $categoria_seleccionada[1]; ?>)</strong></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Días de reservas</h6>
              <small class="text-muted">Cantidad de días</small>
            </div>
            <span class="text-success"><strong>(<?php echo $_SESSION['total_dias']; ?>)</strong></span>
          </li>
          
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Valor reserva</h6>
              
                
              <small class="text-muted">Por días selecionados</small>
            </div>
            <span class="text-success"><strong>$<?php echo $tarifa['valor_diario']*$_SESSION['total_dias']; ?></strong></span>
          </li>
          

          <?php  
          $tarifa_ad = 0;
            
            if (!empty($_SESSION['adicionales'])) {
            
            
            
            foreach ($_SESSION['adicionales'] as $adicional => $value) {

              $tarifa_adicional = $new->tarifaAdicional($value);
              
              $tarifa_ad+=$tarifa_adicional['tarifa'];
            
          

          ?>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><?php echo $tarifa_adicional['nombre']; ?> + </h6>
              <small class="text-muted">Adicional seleccionado</small>
            </div>
            <span class="text-success"><strong>$<?php echo $tarifa_adicional['tarifa']; ?></strong></span>
          </li>


          <?php } 
        }?>


          <li class="list-group-item d-flex justify-content-between">
            <span>Total Reserva (ARG)</span>
            <strong>

            
            <?php 
            $total = 0;

            if ($tarifa['permite_promo']==0) {
              $total = ($tarifa['valor_diario']*$_SESSION['total_dias'])+$tarifa_ad;
            }else{
              $total = $tarifa['valor_semanal'];
            } 
            $_SESSION['tarifa'] = $total;
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
          
          <input type="hidden" name="total_dias_reserva" value="<?php echo $_SESSION['total_dias']; ?>">
          <input type="hidden" name="tarifa_reserva" value="<?php echo $_SESSION['tarifa']; ?>">
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
$nuevaReserva = $new2->nuevaReservaInsert();
?>
