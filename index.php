<?php

require_once "./controladores/controlador.plantilla.php";
require_once "./panel/controladores/controlador.reservas.php";
require_once "./panel/modelos/modelo.reservas.php";
require_once "./panel/controladores/controlador.categorias.php";
require_once "./panel/modelos/modelo.categorias.php";
require_once "./panel/controladores/controlador.configuraciones.php";
require_once "./panel/modelos/modelo.configuraciones.php";
/*$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();*/


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Patagonia Austral Rent a Car</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Google fonts - Roboto for copy, Montserrat for headings-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="container-fluid">
      <div class="row min-vh-100">
        <div class="col-xl-5 col-lg-6 col-md-8 p-5 p-lg-4 mx-auto d-flex align-items-center">
          <div>
            <p> <img src="img/logo.png" alt="Template Logo"></p>
            <h1 class="text-uppercase">Patagonia Austral Rent a Car en Construcción.</h1>
            <p class="lead">Lo sentimos! Actualmente el sitio se encuentra en proceso de actualización, para más información contáctese al siguiente Whatsapp.</p>
            <li>+54 9 2944317005</li>
        	<li>+54 9 2944242615</li>
            <p class="social"><a href="#" class="external facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="external youtube"><i class="fab fa-youtube"></i></a><a href="#" class="external twitter"><i class="fab fa-twitter"></i></a><a href="#" title="" class="external instagram"><i class="fab fa-instagram"></i></a><a href="#" class="email"><i class="fa fa-envelope"> </i></a></p>
            <p class="credit">&copy; 2019 Patagonia Austral Rent a Car</p>
            <!-- Please do not remove the backlink to bootstrapious unless your Attribution-Free License @ https://bootstrapious.com/attribution-free-license. It is part of the license conditions. Thanks for understanding :) -->
          </div>
        </div>
        <div style="background-image: url('img/pexels-photo-40120.jpg');" class="col-xl-6 col-lg-5 col-md-4 intro-right"></div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/front.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>