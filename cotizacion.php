<?php
include('config/classConexion.php');
include('config/funciones.php');

$db= new Conexion();

if (isset($_POST['txt_desde'])) {
  $fecha_desde=$_POST['txt_desde'];
  $fecha_hasta=$_POST['txt_hasta'];
  $cate=$_POST['select_auto'];
  $hora_retiro=$_POST['txt_hora_retiro'];
  $hora_entrega=$_POST['txt_hora_entrega'];
}

$silla = $_POST['ad_silla'];
$cadenas = $_POST['ad_cadenas'];
$buster = $_POST['ad_buster'];

if($silla !=''){
    $silla = "Silla Bebé";
}
if($cadenas !=''){
    $cadenas = "Cadenas para nieve";
}
if($buster !=''){
    $buster = "Buster";
}

$adicional_silla = 0;
$adicional_cadenas = 0;
$adicional_buster = 0;

if (isset($_POST['ad_silla'])) {
    $adicional_silla = $_POST['ad_silla'];
}
if (isset($_POST['ad_cadenas'])) {
  $adicional_cadenas = $_POST['ad_cadenas'];
} 
if (isset($_POST['ad_buster'])) {
  $adicional_buster = $_POST['ad_buster'];
}

$dias=dateDiff($fecha_desde,$fecha_hasta);
$categoria = mostrarCategoria($cate);

//VALIDA PERIODO MINIMO DE DIAS
if ($dias<3) {
  $mensaje = "Recuerde que el período mínimo de reserva es de 3 dias";
  echo "<script>";
  echo "alert('$mensaje');";
  echo "window.location = 'http://www.patagoniaaustralrentacar.com.ar/reservar.php';";
  echo "</script>";
}

$valores = buscarTarifas($fecha_desde,$cate);
$precioxdia = $valores[0];
$preciopromo = $valores[1];

//PARA QUITAR PROMOCIONES, CAMBIO LA FECHA EN LA CONDICION POR UNA QUE SEA MUCHO MAYOR PARA QUE NO LAS TOME EN CUENTA.
//POR EJEMPLO CAMBIO PARA EL OTRO AÑO EN UN MES ALEJADO AL ACTUAL
//DETALLE : CAMBIAR FECHA POR LA MISMA, EN LINEA 222

//SI ACEPTA PROMOCIONES
if($fecha_desde>='2019-09-01'){
    //echo var_dump($valores);
    //PROMO= 7 ES LA PROMOCION DE LA RESERVA HACIENDOLA DESDE LA WEB
    $promo=7;

    //CALCULA LOS DIAS NORMALES, SIN CONTAR PROMOCION
    $diasNormales=($dias%$promo);

    //CALCULO LA CANTIDAD DE PROMOCIONES EN LAS FECHAS SELECCIONADAS
    $cantP=(($dias-$diasNormales)/$promo);

    //CALCULO LOS PRECIOS POR DIA DE LA CATEGORIA
    $precioxdia=($diasNormales*$precioxdia); //19/07/2018 SE COMENTÓ PARA QUE NO CALCULE DIAS PROMOCIONALES
    //$precioxdia= ($dias*$precioxdia);
    //CALCULO PRECIO DE LAS PROMOCIONES
    $preciopromo=($cantP*$preciopromo);

    //SUMA TOTAL ENTRE DIAS NORMALES Y PROMOCIONES SI LAS HAY
    $total=($precioxdia+$preciopromo); //19/07/2018 SE COMENTÓ, SOLO CONTEMPLA TARIFA DIARIA EN ALTA
    //$total=$precioxdia;

    //ADICIONALES
    $adicionales = $adicional_silla+$adicional_cadenas+$adicional_buster;

    $totalReserva = $total+$adicionales;

}else{

    //echo var_dump($valores);
    //PROMO= 7 ES LA PROMOCION DE LA RESERVA HACIENDOLA DESDE LA WEB
    $promo=7;

    //CALCULA LOS DIAS NORMALES, SIN CONTAR PROMOCION
    $diasNormales=($dias%$promo);

    //CALCULO LA CANTIDAD DE PROMOCIONES EN LAS FECHAS SELECCIONADAS
    $cantP=(($dias-$diasNormales)/$promo);

    //CALCULO LOS PRECIOS POR DIA DE LA CATEGORIA
    //$precioxdia=($diasNormales*$precioxdia); 19/07/2018 SE COMENTÓ PARA QUE NO CALCULE DIAS PROMOCIONALES
    $precioxdia= ($dias*$precioxdia);
    //CALCULO PRECIO DE LAS PROMOCIONES
    $preciopromo=($cantP*$preciopromo);

    //SUMA TOTAL ENTRE DIAS NORMALES Y PROMOCIONES SI LAS HAY
    //$total=($precioxdia+$preciopromo); 19/07/2018 SE COMENTÓ, SOLO CONTEMPLA TARIFA DIARIA EN ALTA
    $total=$precioxdia;

    //ADICIONALES
    $adicionales = $adicional_silla+$adicional_cadenas+$adicional_buster;

    $totalReserva = $total+$adicionales;
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patagonia Austral - Rent a Car</title>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>

		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="dist/bootstrap-clockpicker.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/github.min.css">

</style>

  <script>
		function vacio(q) {
			for ( i = 0; i < q.length; i++ ) {
					if ( q.charAt(i) != " " ) {
							return true
					}
			}
			return false
		}

		function validarForm(f)
		{
	    var fk_id_especie = 0;
			var raza = "";
			var flag = false;

			if (!vacio(document.form1.txt_nombre.value)){
		    	alert("Ingrese su nombre");
				document.form1.txt_nombre.focus();
				return false;
	  	}
			if (!vacio(document.form1.txt_telefono.value)){
	    	alert("Ingrese su teléfono");
				document.form1.txt_telefono.focus();
			  return false;
	  	}
	  	if (!vacio(document.form1.txt_mail.value)) {
		        alert("Ingrese su email");
		  		document.form1.txt_mail.focus();
		  		return false;
	  	}
	  	if (!vacio(document.form1.txt_retiro.value)){
		    	alert("Seleccione lugar de retiro");
				document.form1.txt_retiro.focus();
				return (false);
	  	}

			if (!vacio(document.form1.txt_entrega.value)){
		    	alert("Seleccione lugar de entrega");
				document.form1.txt_entrega.focus();
				return false;
		  }
			if (!vacio(document.form1.txt_hora_retiro.value)){
				alert("Seleccione hora de retiro");
			document.form1.txt_hora_retiro.focus();
			return (false);
			}
			if (!vacio(document.form1.txt_hora_entrega.value)){
	    	alert("Seleccione hora de entrega");
			document.form1.txt_hora_entrega.focus();
			return (false);
	  	}
		}
</script>

    <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/animate.min.css" rel="stylesheet">
  <link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
  <link rel="icon" href="admin/icono.ico" type="image/gif" sizes="16x16">

	<!-- NUEVOS LINKS -->
  </head>
    <body class="homepage">
	    <header id="header">
        <?php include("inc/menu.php");?>
      </header><!--/header-->
      <br>
	      <section id="feature" >
          <div class="container">
          <br><br>
            <div class="feature-wrap wow fadeInDown">
       		    <div class="row">
       			    <div class="col-lg-4 col-md-4 col-xs-12">
                  <div class="panel panel-success">
                    <div class="panel-body">
                      <h2>Detalles de su reserva</h2>
                    </div>
                    <div class="panel-footer">
                      <h2>Desde el:&nbsp;&nbsp;&nbsp;<span class="label label-warning"><?php echo date('d/m/Y', strtotime($fecha_desde)).'&nbsp;'.$hora_retiro.' Hs.';?></span></h2>
                      <h2>Hasta el:&nbsp;&nbsp;&nbsp; <span class="label label-warning"><?php echo date('d/m/Y', strtotime($fecha_hasta)).'&nbsp;'.$hora_entrega.' Hs.';?></span></h2>
                      <h2>Vehículo:&nbsp;&nbsp;&nbsp;<span class="label label-warning"><?php echo $categoria; ?></span></h2>
                      <h2>Cantidad de días: <span class="label label-warning"><?php echo $dias; ?></span></h2>
                      <?php
                      //CAMBIO FECHA IGUAL QUE LA CONDICION DE ARRIBA EN EL IF
                      if($fecha_desde>='2019-09-01'){
                      ?>
                      <h2>Promociones: <span class="label label-warning"><?php if ($cantP<=0){echo 'No incluye';}else{echo $cantP;} ?></span></h2>
                      <?php } ?>
                      <h2>Cotización: <span class="label label-warning"><?php echo '$ '.$total; ?></span></h2>

                      <h2>Adicionales: <span class="label label-warning"><?php echo '$ '.$adicionales; ?></span></h2>

                      <hr>
                      <h1 style="color: black;">Total: <span class="label label-warning"><?php echo '$ '.$totalReserva; ?></span></h1>
                    </div>
                  </div>
                  <h3>Complete el siguiente formulario con sus datos para reservar</h3>
       			    </div><!-- fin primer col-lg-6-->

                <div class="col-lg-4 col-md-4 col-xs-12">
                  <div class="alert alert-info">
                  <h3> <strong>Información a tener en cuenta</strong> </h3>
                      <hr>
                      <strong>* Entrega y devolución</strong><br>Las entregas y devoluciones de los vehículos se realizan en el Centro de Bariloche, Terminal de Omnibus y Aeropuerto, de ser necesario especifique su dirección en zona céntrica en el campo observación.<br>
                      <strong>* Horarios</strong><br>
                      El horario de devolución del vehículo deberá ser el mismo definido en la reserva, de lo contrario se cobrará el adicional como un día más de alquiler.
                      <strong>Consulte!</strong><br>
                      <strong>* Adicionales</strong>
                      <p>Todos los adicionales añaden un costo al total de la reserva, en caso de rotura ó robo de los mismos, se deberan abonar con los siguientes valores.</p>
                      <ul>
                          <li>Silla bebé : $1300</li>
                          <li>Cadenas : $1300</li>
                          <li>Buster : $1500</li>
                      </ul>
                      <p>* Todos los vehículos cuentan con cubiertas de hielo y nieve.</p>
                      <p>* Los precios estan expresados en pesos Argentinos.
                      El pago se realiza directamente en <strong>efectivo</strong> o por medio de <strong>transferencia bancaria.</p></strong>
                    </div>
                    
                </div>

       			    <div class="col-lg-4 col-md-12 col-xs-12">
       			      
       			        <form class="wow fadeInDown" method="post" name="form1" id="form1" action="procesa_nueva.php">
                      <input type="hidden" value="<?php echo $fecha_desde; ?>" name="txt_desde">
                      <input type="hidden" value="<?php echo $fecha_hasta; ?>" name="txt_hasta">
                	    <input type="hidden" value="<?php echo $cate; ?>" name="txt_auto">
                	    <input type="hidden" value="<?php echo $dias; ?>" name="txt_dias">
            		      <input type="hidden" value="<?php echo $totalReserva; ?>" name="txt_total">
                      <input type="hidden" value="<?php echo $categoria; ?>" name="txt_categoria">
                      <input type="hidden" name="check_buster" value="<?php echo $buster; ?>">
                      <input type="hidden" name="check_cadenas" value="<?php echo $cadenas ?>">
                      <input type="hidden" name="check_silla" value="<?php echo $silla; ?>">
                      <input type="hidden" name="txt_hora_retiro" value="<?php echo $hora_retiro; ?>">
                      <input type="hidden" name="txt_hora_entrega" value="<?php echo $hora_entrega; ?>">

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput">Nombre completo</label>
                              <input name="txt_nombre" type="text" class="form-control" placeholder="Ingrese su nombre" id="nombre" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Teléfono</label>
                              <input name="txt_telefono" type="number" class="form-control" id="telefono" placeholder="Ingrese su teléfono">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Email</label>
                              <input name="txt_mail" type="text" class="form-control" id="email" placeholder="Ingrese email para recibir los datos de su reserva" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput2">N° Vuelo</label>
                              <input name="txt_vuelo" type="text" class="form-control" placeholder="Vuelo" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Lugar de retiro</label>
                            <select name="txt_retiro" class="form-control">Seleccione
                              <option value="Terminal Ómnibus">Terminal Ómnibus</option>
                              <option value="Aeropuerto">Aeropuerto</option>
                              <option value="Centro Bariloche">Centro Bariloche</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Lugar de entrega</label>
                            <select name="txt_entrega" class="form-control">Seleccione
                              <option value="Terminal Ómnibus">Terminal Ómnibus</option>
                              <option value="Aeropuerto">Aeropuerto</option>
                              <option value="Centro Bariloche">Centro Bariloche</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Observación</label>
                              <textarea class="form-control" rows="5" name="txt_observacion" placeholder="Ingrese alguna observación adicional para la reserva."></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6">
                          <input name='enviado' type="submit" class="btn btn-primary btn-lg" onclick="return validarForm();" value="Reservar">
                        </div>
                      </div>
                          

                    </form><!--Fin formulario-->
                      
                </div> <!-- fin col-lg-6 -->
              </div><!-- Fin row -->
            </div><!--fin div feature -->
          </div><!--/.container-->
                    <br><br><br><br>
        </section><!--/#services-->

    <?php include('inc/footer.php'); ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/wow.min.js"></script>

	<script src="js/main.js"></script>
    <script src="contactform/contactform.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>


  </body>
</html>
