<?php

require_once 'controlador.configuraciones.php';

class ControladorReservas
{

	static function listarTotalesReservasPanel($query){

		$total = ModeloReservas::listarTotalesReservasPanel($query);
		return $total;

	}

	static function eliminarReserva($id){

		$resultado = ModeloReservas::eliminarReserva($id);

		if ($resultado=="ok") {
			echo "<script>
 					toastr.success('Reserva eliminada correctamente.', 'Listo', {timeOut: 8000})
				</script>";

		}else{
			echo "<script>
					toastr.error('No ha sido posible eliminar la reserva.', 'Error', {timeOut: 8000})
				</script>";
		}

	}

	static function convertirFecha($fecha){

	  $date = str_replace('/', '-', $fecha);
	  $newDate = date("Y-m-d", strtotime($date));
	  return $newDate;

	}

	//Funcion para validar que una fecha sea correcta
	static function validateDate($date, $format = 'Y-m-d'){

    	$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;

	}


	//Funcion para contabilizar los dias entre fechas seleccionadas.
	static function totalDias($fecha_i,$fecha_f){
		
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);		
		return $dias;
	}


	//Funcion para retornar la cantidad de autos por categoria a una fecha especifica
	static function totalAutosEntregar($categoria,$fecha=null){

		$cantidad = ModeloReservas::autosParaEntregar($categoria,$fecha);
		return $cantidad;

	}

	//Funcion principal que busca disponibilidad, devuelve el contador de autos disponibles.
	static function buscarDisponibilidad(){

	    if (isset($_POST['buscarDisponibilidad'])) {

	    	//Codigo de reserva es null, hasta que se genere aleatoriamente.
    		$codigo = NULL;
	      	$fecha_desde = $_POST['fecha_desde'];
	      	$fecha_hasta = $_POST['fecha_hasta'];
	      	$hora_desde  = $_POST['hora_desde'];
	      	$hora_hasta  = $_POST['hora_hasta'];
	  	  	$categoria   = $_POST['categoria'];

	  	  	//Valido que las fechas sean al menos correctas
	  	  	if (!self::validateDate($fecha_desde) || !self::validateDate($fecha_hasta)) {
	  	  		echo "<script>
 							toastr.error('Ha ingresado fechas inválidas, intente nuevamente', 'A tener en cuenta', {timeOut: 8000})
 						</script>";
	  	  	}

	  	  	//Total de dias entre fechas.
	  	  	$total_dias = self::totalDias($fecha_desde,$fecha_hasta);

	  	  	//Busco los dias minimo de alquiler
	  	  	$cantidad_dias_configuracion = ModeloConfiguraciones::diasMinimos();

	  	  	//Busco el margen horario para reservar
	  	  	$margen_horario_disponible = ModeloConfiguraciones::margenHorario();

	  	  	//En caso de no encontrar la configuracion o que ésta esté mal definida, por defecto serán 3 dias minimo de alquiler.
	  	  	if (!empty($cantidad_dias_configuracion)) {
	  	  		$minimo_de_dias = $cantidad_dias_configuracion['dias'];
	  	  		if (!$minimo_de_dias == null) {	
	  	  			settype($minimo_de_dias, "integer");
	  	  		}else{
	  	  			$minimo_de_dias=3;
	  	  		}
	  	  		
	  	  	}else{
	  	  		$minimo_de_dias=3;
	  	  	}

	  	  	//Cantidad de dias minimos para reservar.
	  	  	if ($total_dias>=$minimo_de_dias) {

		  	  	$respuesta = ModeloReservas:: buscarDisponibilidad($categoria,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta);

		  	  	//Generar un codigo de reserva aleatorio
				$codigo = ModeloReservas::codigoReserva(5);

			//var_dump($respuesta);
				/***** valor de retorno funcion disponibilidad
				
				***/
				//Si contador devuelve mayor igual a 1 es por que hay disponibilidad
				if ($respuesta>=1) {
	
					$_SESSION['codigo']      = $codigo;
					$_SESSION['fecha_desde'] = $fecha_desde;
					$_SESSION['fecha_hasta'] = $fecha_hasta;
					$_SESSION['hora_desde']  = $hora_desde;
					$_SESSION['hora_hasta']  = $hora_hasta;
 					$_SESSION['categoria']   = $categoria;
					$_SESSION['total_dias']  = $total_dias;
					$_SESSION['mensaje']     = 'Reserva Disponible';
 
					echo "<script>

					window.location='checkout';

					</script>";

				}else{

					echo "<script>
 							toastr.error('No hay vehiculos disponibles en las fechas solicitadas.', 'No hay disponibilidad', {timeOut: 8000})
 						</script>";
				}
	  	  	}else{

	  	  		echo "<script>
 						toastr.error('El periodo mínimo de alquiler son de $minimo_de_dias dia/s.', 'A tener en cuenta', {timeOut: 8000})
 					</script>";
		  	 
		  	}   		      
	    }
  	}

	static function rangoFecha(){

		$respuesta = ModeloReservas::check_in_range('2019-07-01','2019-07-08','2019-07-01');

		if (!$respuesta) {
			echo "NO ESTA EN EL RANGO";
		}else{
			echo "Está en el rango";
		}

	}

	//Funcion para agregar nueva reservas
	static function nuevaReservaInsert(){

		if (isset($_POST['confirmaReserva'])) {

			$link = Conexion::ConectarMysql();

			$categoria = $_POST['categoria_confirmada'];
			$codigo = $_POST['codigo_reserva'];
			$nombre = mysqli_real_escape_string($link, $_POST['nombre_reserva']);
			$apellido = mysqli_real_escape_string($link,$_POST['apellido_reserva']);
			$fecha_desde = $_POST['fecha_desde'];
			$fecha_hasta = $_POST['fecha_hasta'];
			$hora_desde = $_POST['hora_desde_reserva'];
			$hora_hasta = $_POST['hora_hasta_reserva'];
			$tarifa = $_POST['tarifa_reserva'];
			$total_dias = $_POST['total_dias_reserva'];
			$estado = 1;
			$origen = $_POST['origen_reserva'];
			$telefono = mysqli_real_escape_string($link,$_POST['telefono_reserva']);
			$email = mysqli_real_escape_string($link,$_POST['email_reserva']);
			$retiro = $_POST['retiro_reserva'];
			$entrega = $_POST['entrega_reserva'];
			$vuelo = mysqli_real_escape_string($link,$_POST['vuelo_reserva']);
			$observaciones = mysqli_real_escape_string($link,$_POST['informacion_reserva']);
			$adicionales = $_SESSION['adicionales'];

			if (empty($adicionales)) {
				$tiene_adicionales = 0;
			}else{
				$tiene_adicionales = 1;
			}
			
			$respuesta = ModeloReservas::nuevaReserva($categoria,$codigo,$nombre,$apellido,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$estado,$origen,$tiene_adicionales,$telefono,$email,$retiro,$entrega,$vuelo,$observaciones,$adicionales);
			
			
			//Si hay disponibilidad
			if ($respuesta=="ok") {

				$ctrConfiguraciones = new ControladorConfiguraciones();
				$lugar_retiro = $ctrConfiguraciones->listarLugares($retiro);
				//$lugar_devolucion = $ctrConfiguraciones->listarLugares($_SESSION['entrega']);

				foreach ($adicionales as $adicional => $value) {

              		$buscarAdicionales = $ctrConfiguraciones->buscarAdicionales($value);
              
              		$adicionales_email = $buscarAdicionales['adicionales'];
          		}

				//CORREO ELECTRONICO PARA EL SITIO
				$header .= "From: SITIO - Reservas Patagonia Austral <$email> \r\n";
				$header .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
				$header .= 'MIME-Version: 1.0' . "\r\n";
				$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$asunto ="Nueva Reserva Confirmada - Sitio Oficial Austral Rent a Car";
					//$header ="--------------------- CONSULTA CENERGON.COM.AR ------------------------------------";
				$contenido="			Nombre: $nombre <br>
										Email: $email <br>
										Teléfono: $telefono <br>
										Fecha desde: $fecha_desde <br>
										Fecha hasta: $fecha_hasta <br>
										Lugar de retiro: $lugar_retiro <br>
										Hora a entregar: $hora_desde <br>
										Adicionales: <br>
										$adicionales_email
										Observaciones: $observaciones";

				mail("reservas@patagoniaaustralrentacar.com.ar,patagoniaaustralrentacar@gmail.com",$asunto,$contenido,$header);

				//CORREO ELECTRONICO PARA EL CLIENTE
				$header_cliente .= "From: SITIO - Reservas Patagonia Austral <patagoniaaustralrentacar@gmail.com> \r\n";
				$header_cliente .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
				$header_cliente .= 'MIME-Version: 1.0' . "\r\n";
				$header_cliente .= 'Content-type: text/html; charset=utf-8' . "\r\n";

				$asunto_cliente = "Información de su Reserva - Sitio Oficial Rent a Car";
					//$header ="--------------------- CONSULTA CENERGON.COM.AR ------------------------------------";
				$contenido_cliente = "Se ha confirmado la Reserva a nombre de $nombre en Austral Rent a Car <br>
				<br><br>

				Detalles de la reserva:<br><br>

				Desde: $fecha_desde <br>
				Hasta: $fecha_hasta <br>
				Vehículo: $categoria <br>
				Retirar en: $lugar_retiro. <br>
				Hora: $hora_desde hs. <br>
				N° de Vuelo: $vuelo <br>
				Cotización: $ $tarifa <br><br>

				Adicionales:<br><br>
				$adicionales_email

				* Información <br>
				<p>Todos los vehículos poseen cubiertas de hielo y nieve.</p>
				<br>
				* Horarios  <br>
				<p>El horario de devolución del vehículo deberá ser el mismo definido en la reserva, de lo contrario se cobrará el adicional como un día más de alquiler.</p>
				 <br><br>

				* Adicionales <br>
				<p>Todos los adicionales añaden un costo al total de la reserva, en caso de rotura ó robo de los mismos, se deberan abonar con los siguientes valores.</p>
				<ul>
					<li>Silla bebé : $1300</li>
					<li>Cadenas : $1300</li>
					<li>Buster : $1500</li>
				</ul>
				<br><br>

				* Medios de pago <br>
				Puede realizar el pago en efectivo a la hora de la entrega,
				o mediante depósito bancario.<br>
				Banco Galicia : <br>
				DU: 32699889 <br>
				CTA: 4019424-7031-8 <br>
				CBU: 0070031330004019424784 <br>
				CUIL: 27326998864 <br>
				Para mayor información, por favor comuniquese con nosotros. Muchas Gracias.<br><br>

				-------------Info Contacto Rent a Car-------<br><br>
				Jimena González Whatsapp Tel: +54 9 2944242615.

				<h3>Franquicia</h3>
			    <p>Para los daños (parciales) ocurridos en nuestros vehículos, el Cliente debe abonar los mismos hasta un valor maximo (FRANQUICIA) de $15.000 por accidente y $25.000 por vuelco (excepto en la categoria E, que la misma tiene un valor de $25.000 por accidente y $35.000 por vuelco). Esta franquicia es fija de acuerdo a las categorias de vehiculos, entonces, si la FRANQUICIA es de $15.000 por accidente, el Cliente debe abonar todas las eventuales reparaciones hasta $15.000. Si el valor a reparar es mayor a la FRANQUICIA, esa difrencia es cubierta por el seguro.</p>";

				mail($email,$asunto_cliente,$contenido_cliente,$header_cliente);

				$_SESSION['reserva_ok'] = true;
				echo "<script>
				window.location = 'inicio';
				</script>";
			}else{
				$_SESSION['reserva_error'] = true;
				echo "<script>
				window.location = 'reservar';
				</script>";
				
			}
		}

	}

	//listar todas las reservas para mostar en panel
	static function listarTotalReservas(){

		$total = ModeloReservas::listarTotalReservas();
		return $total;

	}

	//listar todas las reservas
	static function listarReservas($estado=null,$filtro=null){

		$reservas = ModeloReservas::listarReservas($estado,$filtro);
		
		return $reservas;

	}

	//listar las tarifas
	static public function listarTarifas(){

		$tarifas = ModeloReservas::listarTarifas();
		return $tarifas;

	}

	//listar las categorias
	static public function listarCategorias(){

		$categorias = ModeloCategorias::listarCategorias();
		return $categorias;

	}

	//Buscar los valores de las categorias por temporada
	static public function tarifaReserva($categoria,$fecha_desde){

		$tarifas = ModeloReservas::buscarTarifa($categoria,$fecha_desde);
		return $tarifas;

	}


}

?>
