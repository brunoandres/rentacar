<?php

//require_once 'panel/modelos/modelo.conexion.php';

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
	  	  		settype($minimo_de_dias, "integer");
	  	  	}else{
	  	  		$minimo_de_dias=3;
	  	  	}

	  	  	//var_dump($minimo_de_dias);

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

					window.location='formulario';

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
			$origen = 1;
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
			
			if ($respuesta=="ok") {
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
