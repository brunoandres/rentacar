<?php  

unset($_SESSION['codigo']);     
unset($_SESSION['fecha_desde']);
unset($_SESSION['fecha_hasta']);
unset($_SESSION['hora_desde']);
unset($_SESSION['hora_hasta']);
unset($_SESSION['categoria']);
unset($_SESSION['total_dias']);
unset($_POST['confirmaReserva']);

?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="inc/hyundai.png" alt="austral rentacar bariloche">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="inc/gol_trend.png" alt="austral rentacar bariloche">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="inc/voyage.gif" alt="austral rentacar bariloche">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>

<?php  

if (isset($_SESSION['reserva_ok'])) {
 echo "<script>
 toastr.success('¡MUCHAS GRACIAS POR SU RESERVA!,La misma ha sido ingresada correctamente, verifique su casilla de correo electrónico o carpeta de Spam para ver más detalles. Tambien es posible consultar sobre la misma en la seccion Mi Reserva.', 'Reserva Confirmada', {timeOut: 10000})
 </script>";
 unset($_SESSION['reserva_ok']);
}

?>

<section id="feature">
  <div class="container">
    <div class="center wow fadeInDown">
      <h2>Austral Rent A Car</h2>
      <p class="lead">Austral Rent a Car, propone precios atractivos en alquiler de autos en San Carlos de Bariloche Argentina</p>
    </div>

    <div class="row">
      <div class="col-md-4 wow fadeInDown">
        <div class="feature-wrap animated flash infinite">
            <i class="fa fa-laptop fadeInDown"></i>
            <h2>Reservas On-line</h2>
            <h3>Hacé tu reserva haciendo click <a href="https://www.patagoniaaustralrentacar.com.ar/reservar">aquí.</a></h3>
          </div>
      </div>
      <div class="col-md-4">
        <div class="feature-wrap wow fadeInDown">
            <i class="fa fa-comments"></i>
            <h2>Atención personalizada</h2>
            <h3>Entregas y retiro sin cargo en aeropuerto,y puntos de S.C. de Bariloche.</h3>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-wrap wow fadeInDown">
            <i class="fa fa-cogs"></i>
            <h2>Coordinación</h2>
            <h3>Recibe tu auto sin demoras y listo para circular.</h3>
        </div>
      </div>


      </div>
    </div>
  <!--/.container-->
</section>
<!--/#feature-->

