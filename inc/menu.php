<?php  
if (empty($_GET['ruta'])) {
  $_GET['ruta'] = null;
  header("location: inicio");
}
?>

<header id="header">
  <nav class="navbar navbar-fixed-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"> <img src="inc/austral-rent-a-car.png" alt=""> </a>
      </div>

      <div class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav">
          <li class="<?php if($_GET['ruta']=='inicio'){ echo 'active'; } ?>"><a href="inicio">Inicio</a></li>
          <li class="<?php if($_GET['ruta']=='quienes-somos'){ echo 'active'; } ?>"><a href="quienes-somos">Quienes Somos</a></li>
          <li class="<?php if($_GET['ruta']=='servicios'){ echo 'active'; } ?>"><a href="servicios">Servicios</a></li>
          <li class="<?php if($_GET['ruta']=='tarifas'){ echo 'active'; } ?>"><a href="tarifas">Tarifas</a></li>
          <li class="<?php if($_GET['ruta']=='flota'){ echo 'active'; } ?>"><a href="flota">Flota</a></li>
          <li class="<?php if($_GET['ruta']=='contacto'){ echo 'active'; } ?>"><a href="contacto">Contacto</a></li>
          <li class="<?php if($_GET['ruta']=='reservar'){ echo 'active'; } ?>"><a href="reservar">Reservar</a></li>
        </ul>
      </div>
    </div>
    <!--/.container-->
  </nav>
  <!--/nav-->
</header>
<!--/header-->
