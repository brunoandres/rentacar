<?php

require_once 'controlador.configuraciones.php';

class ControladorReservas
{

	//Funcion para tomar la direccion ip del cliente
	static function direccionIP() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	        return $_SERVER['HTTP_CLIENT_IP'];

	    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	        return $_SERVER['HTTP_X_FORWARDED_FOR'];

	    return $_SERVER['REMOTE_ADDR'];
	}

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
	static function buscarDisponibilidad($origen){

	    if (isset($_POST['buscarDisponibilidad'])) {

	    	if ($origen == 'web') {
	    		$url_checkout = 'checkout';
	    	}else{
	    		$url_checkout = './checkout';
	    	}

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

					window.location='$url_checkout';

					</script>";

				}else{

					//Verifico si tengo disponiblidad para otras categorias, para mostrar al cliente
					$categorias = ModeloCategorias::listarCategorias(); //Data de categorias

					foreach ($categorias as $otra_categoria) { //Recorro cada una

						$id_categoria = $otra_categoria['id']; //Obtengo valor de id de categoria

						if ($id_categoria == $categoria) {
							$nombre_categoria = $otra_categoria['nombre'];
						}

						$alternativa = ModeloReservas:: buscarDisponibilidad($id_categoria,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta);
						//echo '<br>'.'Categoria '.$otra_categoria['nombre'].' Cant: '.$alternativa;
						if ($alternativa >= 1) {
							echo "<script>
								toastr.info('".$otra_categoria['nombre']." disponible para la fecha seleccionada', 'Categorias disponibles', {timeOut: 12000})
							</script>";
						}

					}

					echo "<script>
								toastr.warning('Para la fecha seleccionada', '".$nombre_categoria." no disponible', {timeOut: 8000})
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
	static function nuevaReservaInsert($url){

		if (isset($_POST['confirmaReserva'])) {

			if ($url == 'web') {
	    		$url_confirma = 'inicio';
	    		$url_error = 'reservar';
	    	}else{
	    		$url_confirma = './inicio';
	    		$url_error = './nueva-reserva';
	    	}

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

			//Obtener la direccion ip del cliente
			$direccion_ip = self::direccionIP();

			$respuesta = ModeloReservas::nuevaReserva($categoria,$codigo,$nombre,$apellido,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$estado,$origen,$tiene_adicionales,$telefono,$email,$retiro,$entrega,$vuelo,$observaciones,$adicionales,$direccion_ip);

			//$respuesta = "ok";
			//Si hay disponibilidad
			if ($respuesta=="ok") {

				//Funcion para enviar correo
				self::enviarCorreo($nombre,$apellido,$categoria,$codigo,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$retiro,$vuelo,$observaciones,$adicionales,$email,$telefono);
				$_SESSION['reserva_ok'] = true;
				echo "<script>
				window.location = '$url_confirma';
				</script>";
			}else{
				$_SESSION['reserva_error'] = true;
				echo "<script>
				window.location = '$url_error';
				</script>";

			}
		}
	}

	//Funcion para envio de email de Reserva
	static public function enviarCorreo($nombre,$apellido,$categoria,$codigo,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$retiro,$vuelo,$observaciones,$adicionales,$email,$telefono){

		$ctrConfiguraciones = new ControladorConfiguraciones();
		$ctrReservas = new ControladorReservas();

		$lugar_retiro = $ctrConfiguraciones->listarLugares($retiro);
		//$lugar_devolucion = $ctrConfiguraciones->listarLugares($_SESSION['entrega']);
		$adicionales_email = array();
		if (!empty($adicionales)) {

			foreach ($adicionales as $adicional => $value) {

      		$buscarAdicionales = $ctrConfiguraciones->buscarAdicionalesSeleccionados($value);

      		$adicionales_nombre = $buscarAdicionales['adicional'];
      		$adicionales_tarifa = $buscarAdicionales['tarifa'];

      		//Inserto en mi array para luego recorrer y separar
      		array_push($adicionales_email, $adicionales_nombre.' $'.$adicionales_tarifa);

  			}
		}else{
			$adicionales_nombre = '';
		}

		//Lugar para mostrar
		$lugar_email = $ctrConfiguraciones->listarLugares($retiro,null);
		$lugar_email = $lugar_email['nombre'];

		//Lista de adicionales seleccionados para mostrar
		$lista = implode(",",$adicionales_email);

		//Formato de moneda
		$tarifa = number_format($tarifa, 0, ",", ".");

		//Formato Fechas dd/mm/yyyy/
		$fecha_desde_email = date('d/m/Y', strtotime($fecha_desde));
		$fecha_hasta_email = date('d/m/Y', strtotime($fecha_hasta));

		//Categoria a mostrar
		$categoria_email = self::tarifaReserva($categoria,$fecha_desde);
		$categoria_email = $categoria_email[3];

		//Lista de adicionales habilitados para mostrar
		$adicionales_habilitados = $ctrConfiguraciones->listarAdicionales(NULL,1);

		$lista_ad_hab = array();
		foreach ($adicionales_habilitados as $key => $value) {
			array_push($lista_ad_hab, $value[1].' $'.$value[2]);
		}

		$lista_adicionales_habilitados = implode(",",$lista_ad_hab);
		//////////////////////////////////////////////////////////////

		//CORREO ELECTRONICO PARA EL SITIO
		$header .= "From: SITIO - Reservas Patagonia Austral <$email> \r\n";
		$header .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
		$header .= 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$asunto ="Nueva Reserva Confirmada - Sitio Oficial Austral Rent a Car";
			//$header ="--------------------- CONSULTA CENERGON.COM.AR ------------------------------------";
		$contenido="			Nombre: $nombre $apellido <br>
								Codigo Reserva: $codigo <br>
								Categoria: $categoria_email <br>
								Email: $email <br>
								Teléfono: $telefono <br>
								Fecha desde: $fecha_desde_email <br>
								Fecha hasta: $fecha_hasta_email <br>
								Lugar de retiro: $lugar_email <br>
								Hora a entregar: $hora_desde hs. <br>
								Hora a devolver: $hora_hasta hs. <br>
								N° de Vuelo: $vuelo <br>
								Adicionales: <br>
								$lista
								<br>
								Observaciones: $observaciones";

		mail("reservas@patagoniaaustralrentacar.com.ar,patagoniaaustralrentacar@gmail.com",$asunto,$contenido,$header);
		//var_dump($contenido);
		//CORREO ELECTRONICO PARA EL CLIENTE
		$header_cliente .= "From: SITIO - Reservas Patagonia Austral <patagoniaaustralrentacar@gmail.com> \r\n";
		$header_cliente .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
		$header_cliente .= 'MIME-Version: 1.0' . "\r\n";
		$header_cliente .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		$asunto_cliente = "Información de su Reserva - Sitio Oficial Rent a Car";
			//$header ="--------------------- CONSULTA CENERGON.COM.AR ------------------------------------";

		$add = '* Adicionales <br>
		<p>Todos los adicionales añaden un costo al total de la reserva, en caso de rotura ó robo de los mismos, se deberan abonar con los siguientes valores.</p>
		<strong>$lista_adicionales_habilitados</strong>
		<br><br>';

		$contenido_cliente = "Se ha confirmado la Reserva a nombre de $nombre en Austral Rent a Car <br>
		<br><br>

		Detalles de su Reserva:<br><br>

		Código Reserva: $codigo <br>
		Fecha Desde: $fecha_desde_email <br>
		Fecha Hasta: $fecha_hasta_email <br>
		Vehículo: $categoria_email <br>
		Retirar en: $lugar_email. <br>
		Hora a retirar: $hora_desde hs. <br>
		Hora de devolución: $hora_hasta hs. <br>
		N° de Vuelo: $vuelo <br>
		Tarifa Reserva: $ $tarifa <br><br>

		Adicionales seleccionados:<br><br>
		$lista
		<br>
		* Información <br>
		<p>Todos los vehículos poseen cubiertas de hielo y nieve.</p>
		<br>
		* Horarios  <br>
		<p>El horario de devolución del vehículo deberá ser el mismo indicado en el formulario de la Reserva, de lo contrario se cobrará el adicional como un día más de alquiler.</p>
		 <br><br>

		* Medios de pago <br>
		Puede realizar el pago en efectivo a la hora de la entrega,
		o mediante depósito bancario.<br>
		Banco Galicia : <br>
		DU: 32699886 <br>
		CTA: 4019424-7031-8 <br>
		CBU: 0070031330004019424784 <br>
		CUIL: 27326998864 <br>
		ALIAS: Austral1987 <br>
		Para mayor información, por favor comuniquese con nosotros. Muchas Gracias.<br><br>

		Se deberá realizar el pago del 50 % del valor de la reserva, de lo contrario se dará de baja la misma.

		<br><br>

		-------------Info Contacto Rent a Car-------<br><br>
		Jimena González Whatsapp Tel: +54 9 2944242615.

		<h3>Franquicia</h3>
    	<p>

			*CATEGORÍA A, B y C: Km libre para recorrer la zona de Bariloche,  Villa la Angostura,  San Martin y  el Bolson.
Seguro todo riesgo con franquicia de $40.000 por accidente y $80.000 por vuelco.<br>
*Categoría D ,E y F Km libre para recorrer la zona de Bariloche,  Villa la Angostura,  San Martin y  el Bolson. Seguro todo riesgo con franquicia de $80.000 pesos por accidente y $120.000 pesos por vuelco.
Pago en efectivo o transferencia bancaria al momento de la entrega.<br>
Para señar se solicita un 50% del total del alquiler por transferencia.

<br><br>

<p>Enviar comprobante por este mismo medio o WhatsApp +5492944242615 Jimena</p>



			</p>";
	    //echo($contenido_cliente);
		mail($email,$asunto_cliente,$contenido_cliente,$header_cliente);

	}


	//Funcion para editar Reservas
	static function editarReserva(){

		if (isset($_POST['editarReserva'])) {

			$link = Conexion::ConectarMysql();
			$idAuto = 'NULL';
			$nombre = mysqli_real_escape_string($link, $_POST['nombre']);
			$apellido = mysqli_real_escape_string($link,$_POST['apellido']);
			//$fecha_desde = $_POST['fecha_desde'];
			//$fecha_hasta = $_POST['fecha_hasta'];
			//$hora_desde = $_POST['hora_desde_reserva'];
			//$hora_hasta = $_POST['hora_hasta_reserva'];
			$tarifa = $_POST['tarifa'];
			$telefono = mysqli_real_escape_string($link,$_POST['telefono']);
			$email = mysqli_real_escape_string($link,$_POST['email']);
			$retiro = $_POST['retiro'];
			$devolucion = $_POST['devolucion'];
			$tarifa = $_POST['tarifa'];
			$vuelo = mysqli_real_escape_string($link,$_POST['vuelo']);
			$observaciones = mysqli_real_escape_string($link,$_POST['observaciones']);

			if (empty($_POST["idAuto"]) == '') {
				$idAuto = $_POST["idAuto"];
			}

			$id_reserva = $_POST['idReserva'];

			$respuesta = ModeloReservas::editarReserva($nombre,$apellido,$tarifa,$telefono,$email,$retiro,$devolucion,$vuelo,$observaciones,$idAuto,$id_reserva);

			if ($respuesta=="ok") {

		      	echo'<script>

						swal({
								type: "success",
								title: "Reserva editada correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
									window.location = "confirmadas";
									})

						</script>';


	      	} else {
		        echo'<script>

						swal({
								type: "danger",
								title: "Error al editar Reserva.",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){})

						</script>';
	      	}
		}

	}

	//listar todas las reservas para mostar en panel
	static function listarTotalReservas(){

		$total = ModeloReservas::listarTotalReservas();
		return $total;

	}

	//listar todas las reservas
	static function listarReservas($id=null,$estado=null,$filtro=null){

		$reservas = ModeloReservas::listarReservas($id,$estado,$filtro);

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


    //Funcion principal que busca disponibilidad, devuelve el contador de autos disponibles.
	static function test($origen){

	    if (isset($_POST['buscar'])) {

	    	if ($origen == 'web') {
	    		$url_checkout = 'checkout';
	    	}else{
	    		$url_checkout = './checkout';
	    	}

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

		  	  	$respuesta = ModeloReservas:: test($categoria,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta);

		  	  	//Generar un codigo de reserva aleatorio
				$codigo = ModeloReservas::codigoReserva(5);


			var_dump($respuesta);
				/***** valor de retorno funcion disponibilidad

				***/
				//Si contador devuelve mayor igual a 1 es por que hay disponibilidad
				/*if ($respuesta>=1) {

					$_SESSION['codigo']      = $codigo;
					$_SESSION['fecha_desde'] = $fecha_desde;
					$_SESSION['fecha_hasta'] = $fecha_hasta;
					$_SESSION['hora_desde']  = $hora_desde;
					$_SESSION['hora_hasta']  = $hora_hasta;
 					$_SESSION['categoria']   = $categoria;
					$_SESSION['total_dias']  = $total_dias;
					$_SESSION['mensaje']     = 'Reserva Disponible';

					echo "<script>

					window.location='$url_checkout';

					</script>";

				}else{

					echo "<script>
 							toastr.error('No hay vehiculos disponibles en las fechas solicitadas.', 'No hay disponibilidad', {timeOut: 8000})
 						</script>";
				}*/
	  	  	}else{

	  	  		echo "<script>
 						toastr.error('El periodo mínimo de alquiler son de $minimo_de_dias dia/s.', 'A tener en cuenta', {timeOut: 8000})
 					</script>";

		  	}
	    }
  	}
}

?>
