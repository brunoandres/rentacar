<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
    <link rel="stylesheet" href="vistas/css/jquery.timepicker.min.css">

    <!-- datepicker -->
    <link rel="stylesheet" href="vistas/css/jquery-ui.css">

    <!-- timepicker -->
    <link rel="stylesheet" href="vistas/css/bootstrap-clockpicker.min.css">

    <link rel="stylesheet" href="vistas/css/galeria.css">
    <link rel="stylesheet" href="panel/vistas/bower_components/select2/dist/css/select2.min.css">



    <!-- ALERTAS -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="vistas/js/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="vistas/js/jquery.prettyPhoto.js"></script>
    <script src="vistas/js/jquery.isotope.min.js"></script>
    <script src="vistas/js/wow.min.js"></script>
    <script src="vistas/js/main.js"></script>

    <!-- SweetAlert 2 -->
    <script src="panel/vistas/plugins/sweetalert2/sweetalert2.all.js"></script>


    <script src="vistas/js/jquery-1.12.4.js"></script>
    <script src="vistas/js/jquery-ui.js"></script>
    <script src="vistas/js/bootstrap-clockpicker.min.js"></script>

    <script src="panel/vistas/bower_components/select2/dist/js/select2.full.js"></script>

    <title>Patagonia Austral Rentacar Bariloche</title>
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
         $_GET["ruta"] == "formulario" ||
         $_GET["ruta"] == "confirma" ){

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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="vistas/js/popper.min.js"></script>
    <script src="vistas/js/bootstrap.min.js"></script>
    <script src="vistas/js/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <script type="text/javascript">
            $(document).ready(function(){

          $(".filter-button").click(function(){
              var value = $(this).attr('data-filter');
              
              if(value == "all")
              {
                  //$('.filter').removeClass('hidden');
                  $('.filter').show('1000');
              }
              else
              {
      //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
      //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                  $(".filter").not('.'+value).hide('3000');
                  $('.filter').filter('.'+value).show('3000');
                  
              }
          });
          
          if ($(".filter-button").removeClass("active")) {
      $(this).removeClass("active");
      }
      $(this).addClass("active");

      });
    </script>

    <script src="vistas/js/script.js"></script>
    <script src="vistas/js/maskDate.js"></script>

    <script src="vistas/js/alert.js"></script>
  </body>
</html>
