<?php
if (empty($_GET['ruta'])) {
  $_GET['ruta'] = null;
  header("location: inicio");
}
?>

<header id="header">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-3 p-3 ml-5" href="https://patagoniaaustralrentacar.com.ar"> <img src="inc/austral-rent-a-car.png" alt="Patagonia Austral Rent a Car"> </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if($_GET['ruta']=='inicio'){ echo 'active'; } ?>">
          <a class="nav-link" href="https://www.patagoniaaustralrentacar.com.ar/inicio">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php if($_GET['ruta']=='quienes-somos'){ echo 'active'; } ?>">
          <a class="nav-link" href="https://www.patagoniaaustralrentacar.com.ar/quienes-somos">Quienes Somos</a>
        </li>
        <li class="nav-item <?php if($_GET['ruta']=='servicios'){ echo 'active'; } ?>">
          <a class="nav-link" href="https://www.patagoniaaustralrentacar.com.ar/servicios">Servicios</a>
        </li>
        <li class="nav-item <?php if($_GET['ruta']=='tarifas'){ echo 'active'; } ?>">
          <a class="nav-link" href="https://www.patagoniaaustralrentacar.com.ar/tarifas">Tarifas</a>
        </li>
        <li class="nav-item <?php if($_GET['ruta']=='flota'){ echo 'active'; } ?>">
          <a class="nav-link" href="https://www.patagoniaaustralrentacar.com.ar/flota">Flota</a>
        </li>
        <!--<li class="nav-item <?php if($_GET['ruta']=='contacto'){ echo 'active'; } ?>">
          <a class="nav-link" href="contacto">Contacto</a>
        </li>-->
        <!--<li class="nav-item <?php if($_GET['ruta']=='mi-reserva'){ echo 'active'; } ?>">
          <a class="nav-link" href="mi-reserva">Mi Reserva</a>
        </li>-->
        <li class="nav-item <?php if($_GET['ruta']=='reservar' || $_GET['ruta']=='formulario' || $_GET['ruta']=='confirma'){ echo 'active'; } ?>">
          <a class="nav-link" href="https://www.patagoniaaustralrentacar.com.ar/reservar">¡Reservar!</a>
        </li>
      </ul>
    </div>
  </nav>
  <!--/nav-->
</header>
<!--/header-->