<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <!-- Bootstrap -->
    <link href="vistas/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vistas/css/font-awesome.min.css">
    <link href="vistas/css/animate.min.css" rel="stylesheet">
    <link href="vistas/css/prettyPhoto.css" rel="stylesheet">
    <link href="vistas/css/style.css" rel="stylesheet">
    <link href="vistas/css/responsive.css" rel="stylesheet">
    <!-- =======================================================
      Theme Name: Gp
      Theme URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-templat/
      Author: BootstrapMade
      Author URL: https://bootstrapmade.com
    ======================================================= -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <!-- datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <title>Austral Rentacar</title>
  </head>
  <body>

    <?php include 'inc/menu.php'; ?>

    <?php

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "quienes-somos" ||
         $_GET["ruta"] == "servicios" ||
         $_GET["ruta"] == "tarifas" ||
         $_GET["ruta"] == "flota" ||
         $_GET["ruta"] == "contacto" ||
         $_GET["ruta"] == "reservar" ||
         $_GET["ruta"] == "cotizador" ||
         $_GET["ruta"] == "formulario"){

        include "modulos/".$_GET["ruta"].".php";

      }else{

        //include "modulos/404.php";
        header("location:inicio");

      }

    }else{

      include "modulos/inicio.php";

    }

    ?>

    <?php include 'inc/footer.php'; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="vistas/js/jquery.js"></script>
    <script src="vistas/js/bootstrap.min.js"></script>
    <script src="vistas/js/jquery.prettyPhoto.js"></script>
    <script src="vistas/js/jquery.isotope.min.js"></script>
    <script src="vistas/js/wow.min.js"></script>
    <script src="vistas/js/main.js"></script>

    <!-- datepicker -->

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#datepicker" ).datepicker();
      } );

      $( function() {
        $( "#datepicker2" ).datepicker();
      } );
    </script>

  </body>
</html>
