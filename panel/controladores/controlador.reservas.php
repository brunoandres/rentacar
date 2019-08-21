<?php

class ControladorReservas
{
	static function convertirFecha($fecha){

	  $date = str_replace('/', '-', $fecha);
	  $newDate = date("Y-m-d", strtotime($date));
	  return $newDate;

	}

	static function totalDias($fecha_i,$fecha_f){
		
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);		
		return $dias;
	}


	static function nuevaReserva(){

	    if (isset($_POST['buscarDisponibilidad'])) {

	    	$codigo = 'null';
		      //Verificar si hay disponibilidad, devolver true
		      $fecha_desde = $_POST['fecha_desde'];
		      $fecha_hasta = $_POST['fecha_hasta'];
		      $hora_desde  = $_POST['hora_desde'];
		      $hora_hasta  = $_POST['hora_hasta'];
		  	  $categoria   = $_POST['categoria'];

		  	  $total_dias = self::totalDias($fecha_desde,$fecha_hasta);

		  	  if ($total_dias>=3) {
		  	  	$respuesta = ModeloReservas:: buscarDisponibilidad($categoria,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta);
				$codigo = ModeloReservas::codigoReserva(5);

				if (!empty($respuesta)) {
					foreach ($respuesta as $value) {
					echo '<br><h3>Autos disponibles : '.$value.'</h3>';
					}

					$_SESSION['codigo'] = $codigo;

					$_SESSION['fecha_desde'] = $fecha_desde;
					$_SESSION['fecha_hasta'] = $fecha_hasta;
					$_SESSION['categoria'] = $categoria;
					$_SESSION['total_dias'] = $total_dias;
 
					/*echo'<script>

					swal({
							type: "success",
							title: "Hay disponibilidad!",
							showConfirmButton: true,
							confirmButtonText: "Continuar..."
							}).then(function(result){
								window.location="formulario"
							})

					</script>';*/

					header("location:formulario");

				}else{
					echo'<script>

					swal({
							type: "error",
							title: "No hay disponibilidad, intente cambiar las fechas o categoria seleccionada.",
							showConfirmButton: true,
							confirmButtonText: "Volver a intentar"
							}).then(function(result){
		
							})

					</script>';
				}

				/*if ($respuesta>0) {
					$alpha = "123qwertyuiopa456sdfghjklzxcvbnm789";
		      $code = "";
		      $longitud=5;
		      for($i=0;$i<$longitud;$i++){
		          $code .= $alpha[rand(0, strlen($alpha)-1)];

		      }
		      $_SESSION['code'] = $code;
		      $_SESSION['fecha_desde'] = $_POST['fecha_desde'];
		      $_SESSION['fecha_hasta'] = $_POST['fecha_hasta'];
		      $_SESSION['hora_desde'] = $_POST['hora_desde'];
		      $_SESSION['hora_hasta'] = $_POST['hora_hasta'];

					//si existe disponibilidad, guardo los datos para enviar al siguiente
		      //formulario para completar con los datos personales y demas
		      header('Location: formulario');
				}else{
					echo "<script>
					alert('No hay disponibilidad!');
				</script>";
			}*/
		  	  }else{

		  	  	echo'<script>

					swal({
							type: "error",
							title: "El periodo mínimo de alquiler son de 3 días.",
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
	static function crearReserva(){

		if (isset($_POST['btnCrearReserva'])) {
			/*$nombre = $_POST['nombre'];
			$fecha_desde = $_POST['fecha_desde'];
			$fecha_hasta = $_POST['fecha_hasta'];
			$email = $_POST['email'];
			$categoria = $_POST['categoria'];*/

			//$respuesta = ModeloReservas::nuevaReserva($nombre,$fecha_desde,$fecha_hasta,$email,$categoria);
			//if ($respuesta=="ok") {
				echo'<script>

				swal({
						type: "success",
						title: "Reserva guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "confirmadas";

								}
							})

				</script>';
			//}
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
