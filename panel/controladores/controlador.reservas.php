<?php

class ControladorReservas
{
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
	  	  		echo'<script>

					swal({
							type: "error",
							title: "Ha ingresado fechas inválidas, intente nuevamente.",
							showConfirmButton: true,
							confirmButtonText: "Volver a intentar"
							}).then(function(result){
		
							})

					</script>';
	  	  	}

	  	  	//Total de dias entre fechas.
	  	  	$total_dias = self::totalDias($fecha_desde,$fecha_hasta);

	  	  	//Busco los dias minimo de alquiler
	  	  	$cantidad_dias_configuracion = ModeloConfiguraciones::diasMinimos();

	  	  	//En caso de no encontrar la configuracion o que ésta esté mal definida, por defecto serán 3 dias minimo de alquiler.
	  	  	if (!empty($cantidad_dias_configuracion)) {
	  	  		$minimo_de_dias = $cantidad_dias_configuracion['dias'];
	  	  		settype($minimo_de_dias, "integer");
	  	  	}else{
	  	  		$minimo_de_dias=3;
	  	  	}

	  	  	var_dump($minimo_de_dias);

	  	  	//Cantidad de dias minimos para reservar.
	  	  	if ($total_dias>=$minimo_de_dias) {

		  	  	$respuesta = ModeloReservas:: buscarDisponibilidad($categoria,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta);

		  	  	//Generar un codigo de reserva aleatorio
				$codigo = ModeloReservas::codigoReserva(5);
				var_dump($respuesta);

				//Si contador devuelve mayor igual a 1 es por que hay disponibilidad
				if ($respuesta>=1) {
	
					$_SESSION['codigo']      = $codigo;
					$_SESSION['fecha_desde'] = $fecha_desde;
					$_SESSION['fecha_hasta'] = $fecha_hasta;
					$_SESSION['hora_desde']  = $hora_desde;
					$_SESSION['hora_hasta']  = $hora_hasta;
 					$_SESSION['categoria']   = $categoria;
					$_SESSION['total_dias']  = $total_dias;
					$_SESSION['mensaje']     = 'Reserva Disponible!';
 
					echo "<script>

					window.location='formulario';

					</script>";

					/*echo'<script>

					swal({
							type: "success",
							title: "DISPONIBLE!",
							showConfirmButton: true,
							confirmButtonText: "Volver a intentar"
							}).then(function(result){
		
							})

					</script>';*/

				}else{
					echo'<script>

					swal({
							type: "error",
							title: "No hay disponibilidad para las fechas indicadas.",
							showConfirmButton: true,
							confirmButtonText: "Volver a intentar"
							}).then(function(result){
		
							})

					</script>';
				}
		  	  }else{

		  	  	echo'<script>

					swal({
							type: "error",
							title: "El periodo mínimo de alquiler son de '.$minimo_de_dias.' dias.",
							showConfirmButton: true,
							confirmButtonText: "Volver a intentar"
							}).then(function(result){
		
							})

					</script>';

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

			$categoria = $_POST['categoria_confirmada'];
			$codigo = $_POST['codigo_reserva'];
			$nombre = $_POST['nombre_reserva'];
			$apellido = $_POST['apellido_reserva'];
			$fecha_desde = $_POST['fecha_desde'];
			$fecha_hasta = $_POST['fecha_hasta'];
			$hora_desde = $_POST['hora_desde_reserva'];
			$hora_hasta = $_POST['hora_hasta_reserva'];
			$tarifa = $_POST['tarifa_reserva'];
			$total_dias = $_POST['total_dias_reserva'];
			$estado = 1;
			$origen = 1;
			$telefono = $_POST['telefono_reserva'];
			$email = $_POST['email_reserva'];
			$retiro = $_POST['retiro_reserva'];
			$entrega = $_POST['entrega_reserva'];
			$vuelo = $_POST['vuelo_reserva'];
			$observaciones = $_POST['informacion_reserva'];
			$adicionales = $_SESSION['adicionales'];

			if (empty($adicionales)) {
				$tiene_adicionales = 0;
			}else{
				$tiene_adicionales = 1;
			}
			
			$respuesta = ModeloReservas::nuevaReserva($categoria,$codigo,$nombre,$apellido,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$estado,$origen,$tiene_adicionales,$telefono,$email,$retiro,$entrega,$vuelo,$observaciones,$adicionales);

			echo'<script>

					window.location = "inicio";

				</script>';
			
			/*if ($respuesta=="ok") {
				echo'<script>

				swal({
						type: "success",
						title: "Perfecto! Su reserva ha sido completada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "inicio";

								}
							})

				</script>';
			}else{
				echo'<script>

				swal({
						type: "error",
						title: "Error!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "inicio";

								}
							})

				</script>';
			}*/
		}

	}

	//listar todas las reservas
	static function listarReservas($estado = NULL){

		if (!empty($estado)) {
			$reservas = ModeloReservas::listarReservas($estado);
		}else{
			$reservas = ModeloReservas::listarReservas();
		}
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
	static public function tarifaReserva($categoria){

		$tarifas = ModeloReservas::buscarTarifa($categoria);
		return $tarifas;

	}


}

?>
