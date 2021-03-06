<?php session_start();?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="D6kjcV62_XcOUnO0F8QtplLUMW2VDhZOLqucq4gaYTE" />
    <meta name="reservas-online" content="Servicio web de reservas online Rent a Car" />
    <meta name="author" content="CENERGON" />
    <meta name="description" content="Patagonia Austral Rent a Car le brinda un completo servicio de alquiler de autos en San Carlos de Bariloche">
    <meta name="generator" content="PHP" />
    <meta name="keywords" content="Rentacar,Bariloche,Alquiler de autos, Patagonia Austral" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117085817-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-117085817-1');
    </script>

    <!-- Bootstrap -->
    <link href="vistas/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vistas/css/font-awesome.min.css">
    <link href="vistas/css/animate.min.css" rel="stylesheet">
    <link href="vistas/css/prettyPhoto.css" rel="stylesheet">
    <link href="vistas/css/style.css" rel="stylesheet">
    <link href="vistas/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="vistas/css/jquery.timepicker.min.css">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- datepicker -->
    <link rel="stylesheet" href="vistas/css/jquery-ui.css">

    <!-- timepicker -->
    <link rel="stylesheet" href="vistas/css/bootstrap-clockpicker.min.css">

    <link rel="stylesheet" href="vistas/css/galeria.css">
    <link rel="stylesheet" href="panel/vistas/bower_components/select2/dist/css/select2.min.css">
    <!-- Link archivo animacion -->
     <link rel="stylesheet" href="vistas/css/animate.css">

    <!-- Links para Galeria en Flota -->
    <link rel="stylesheet" href="vistas/css/baguetteBox.min.css"/>
    <link rel="stylesheet" href="vistas/css/cards-gallery.css">

    <!-- ALERTAS -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="vistas/js/jquery.js"></script>
    <script src="vistas/js/toastr.min.js"></script>

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

    <style>
      .whatsapp {
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#25d366;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  font-size:30px;
  z-index:100;
}

.whatsapp-icon {
  margin-top:13px;
}
    </style>
  </head>
  <body>
    <a href="https://wa.me/5492944242615?text=Me%20gustaría%20saber%20más%20sobre%20el%20servicio" class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>

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
         $_GET["ruta"] == "checkout" ||
         $_GET["ruta"] == "mi-reserva" ||
         $_GET["ruta"] == "test" ||
         $_GET["ruta"] == "confirmacion" ){

        include "modulos/".$_GET["ruta"].".php";

        if ($_GET["ruta"] == "mi-reserva" ||
         $_GET["ruta"] == "quienes-somos"||
         $_GET["ruta"] == "tarifas"||
         $_GET["ruta"] == "contacto") {
          echo "<style>
      .footerAbsolute{
        position: fixed !important;
        bottom: 0 !important;
        width: 100% !important;
      }
    </style>";
        }

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
    <script src="vistas/js/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.cards-gallery', { animation: 'slideIn'});
    </script>
    <script>
    var IDLE_TIMEOUT = 600; //seconds
    var _idleSecondsCounter = 0;
    document.onclick = function() {
      _idleSecondsCounter = 0;
      };
      document.onmousemove = function() {
      _idleSecondsCounter = 0;
      };
      document.onkeypress = function() {
      _idleSecondsCounter = 0;
      };
      window.setInterval(CheckIdleTime, 1000);
      function CheckIdleTime() {
      _idleSecondsCounter++;
      var oPanel = document.getElementById("SecondsUntilExpire");
      if (oPanel)
      oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
      if (_idleSecondsCounter >= IDLE_TIMEOUT) {
      //alert("Time expired!");
      document.location.href = "inicio";
      }
    }

    $("#button").click(function(){
      var code = $("#code").val();
      $.ajax({
        type : 'POST',
        url : 'inc/cargar-codigo.php',
        data : {code:code},
        success: function(data){
          $("#resultado").html(data);
        }
      });
    });



    $("#btn").click(function(){

      var url = "inc/email.php";
      var nombre = $("#nombre").val();
      var email = $("#email").val();
      var asunto = $("#asunto").val();
      var mensaje = $("#mensaje").val();

      $.ajax({

        type:"POST",
        url:url,
        data:{nombre:nombre,email:email,asunto:asunto,mensaje:mensaje},
        success:function(data){
          $("#msj").html(data);
        }

      });
    });


   </script>
  </body>
</html>
