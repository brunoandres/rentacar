<?php

require_once 'modelo.conexion.php';
require_once 'modelo.categorias.php';

class ModeloReservas
{

	public function __construct() {}
	static public function listarReservas($estado = NULL){

		$reservas = array();
		$link = Conexion::ConectarMysql();
	    if (!empty($estado)) {
	    	$sql = " and a.estado = ".$estado;
	    }else{
	    	$sql = "";
	    }
	    $query = "select a.id_reserva,a.nombre,a.tel,a.vehiculo,a.email,a.vehiculo as cat,a.fdesde as fecha,a.fdesde as pasaFechaD,a.fhasta as pasaFechaH,date_format(a.fhasta,'%d %M %Y')as fechah,a.hdesde,a.retiro,a.vuelo,a.origen,a.estado, b.categoria FROM reservas a, categorias b WHERE a.vehiculo=b.id_categoria and a.estado=1 and year(a.fdesde)=2019 ".$sql." order by a.id_reserva desc";
	    $sql = mysqli_query($link,$query);


	    while ($filas = mysqli_fetch_assoc($sql)) {
	      $reservas[]=$filas;
	    }
	    return $reservas;
	    // Cerrar la conexión.
	    mysqli_close( $link );

	}

	static function listarTarifas(){

		$tarifas = array();
		$link = Conexion::ConectarMysql();
	    $query = "select * from tarifas";
	    $sql = mysqli_query($link,$query);


	    while ($filas = mysqli_fetch_assoc($sql)) {
	      $tarifas[]=$filas;
	    }
	    return $tarifas;
	    // Cerrar la conexión.
	    mysqli_close( $link );

	}

	static function buscarTarifa($categoria){

		$tarifa = array();
		$link = Conexion::ConectarMysql();
		$query = "select a.id as id_tarifa,a.por_dia as valor_tarifa_diaria,a.por_semana as valor_tarifa_semanal,b.nombre as nombre_temporada,b.fecha_desde as fecha_desde_temporada,b.fecha_hasta as fecha_hasta_temporada,c.nombre as categoria,c.activa as categoria_activa,c.promo as permite_promo from tarifas a, temporadas b, categorias c where a.id_temporada = b.id and a.id_categoria = c.id and a.activa = 1 and b.activa = 1 and c.activa and c.id = $categoria";
		$sql = mysqli_query($link,$query);
		while ($filas = mysqli_fetch_assoc($sql)) {
			$tarifa['valor_diario'] = $filas['valor_tarifa_diaria'];
			$tarifa['valor_semanal'] = $filas['valor_tarifa_semanal'];
			$tarifa['permite_promo'] = $filas['permite_promo'];
			$tarifa['categoria'] = $filas['categoria'];
		}

		return $tarifa;
		mysql_close($link);
	}

	static function codigoReserva($longitud){

		$key = '';
	    $caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $max = strlen($caracteres)-1;
	    for($i=0;$i < $longitud;$i++) $key .= $caracteres{mt_rand(0,$max)};
	    return $key;

	}

	static function check_in_range($start_date, $end_date, $date_from_user){
	  // COnvierto a timestamp
	  $start_ts = strtotime($start_date);
	  $end_ts = strtotime($end_date);
	  $user_ts = strtotime($date_from_user);

	  // Controlo el rango entre start and end
	  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}


	//Funcion principal para buscar disponibilidad entre fechas
	static function buscarDisponibilidad($categoria,$fechaDesdeReserva,$fechaHastaReserva,$hora_desde,$hora_hasta){

		//Instancio mi clase categorias para traer total de autos para cada una.
		$new = new ModeloCategorias();

		$link 		= Conexion::ConectarMysql();
		$query 		= "select * from reservas where id_categoria = $categoria and estado = 1";
		$resultado 	= mysqli_query($link,$query);

		//retorno valor de buscarDisponibilidad (flag)
		$reserva_ok = false;

		//variable pora ir contando los cruces de reserva
		$choques_entre_reservas = 0;

		//busco total de autos por categorias
		switch ($categoria) {
			case 1:
				$contador = $new::autosPorCategoria(1);
				break;
			case 2:
				$contador = $new::autosPorCategoria(2);
				break;
			case 3:
				$contador = $new::autosPorCategoria(3);
				break;
			case 4:
				$contador = $new::autosPorCategoria(4);
				break;
			case 5:
				$contador = $new::autosPorCategoria(5);
				break;
		}
		$sumaDeChoques = 0;
		$data = array();
		while ($filas = mysqli_fetch_assoc($resultado)) {

			//retorno valor de buscarDisponibilidad (flag), entra en mi bucle como false
			$reserva_ok = false;
			$data[] = $filas;
			//guardo los datos ya desde la base de datos para recorrer
			$fechaDesdeConfirmada=$filas['fecha_desde'];
			$fechaHastaConfirmada=$filas['fecha_hasta'];
			$nroReserva=$filas['id'];

       		///Primero evaluo contra las fechas de reservas confirmadas
			//Evaluo que NO este en el rango la fecha
			if (!self::check_in_range($fechaDesdeReserva, $fechaHastaReserva, $fechaDesdeConfirmada)) {
				if (!self::check_in_range($fechaDesdeReserva, $fechaHastaReserva, $fechaHastaConfirmada))
					if (!self::check_in_range($fechaDesdeConfirmada, $fechaHastaConfirmada, $fechaDesdeReserva))
						if (!self::check_in_range($fechaDesdeConfirmada, $fechaHastaConfirmada, $fechaHastaReserva))
							$reserva_ok= true;
					else $reserva_ok = false;
				else $reserva_ok = false;
			} else $reserva_ok= false;

			if ($reserva_ok==false){
				$contador = $contador - 1;
				$sumaDeChoques =$sumaDeChoques+1;
			}

		}

		if ($contador > 0){
			$reserva_ok= true;
			$msj= 'Si tiene auto';
		//echo "SI Tenes auto <br>";
				//echo $contador;
		}else{
				$reserva_ok=false;
				$msj='falta auto';
			    //echo "NO Tenes auto <br>";
				//echo $contador;
		}


			//echo $contador=$msj.$reserva;
			//var_dump($contador);
		return $contador;

	}

	static public function nuevaReserva($categoria,$codigo,$nombre,$apellido,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$estado,$origen,$telefono,$email,$retiro,$entrega,$vuelo,$observaciones,$adicionales){

		$link = Conexion::ConectarMysql();

		//Desactivamos el autommit transaccional
		mysqli_autocommit($link,FALSE);

	    $query = "INSERT INTO `reservas`(`id_categoria`, `codigo`, `nombre`, `apellido`, `fecha_desde`, `fecha_hasta`, `hora_desde`, `hora_hasta`, `tarifa`, `total_dias`, `estado`, `origen`, `create`, `update`) VALUES ($categoria,'$codigo','$nombre','$apellido','$fecha_desde','$fecha_hasta','$hora_desde','$hora_hasta','$tarifa',$total_dias,$estado,$origen)";
	    $sql = mysqli_query($link,$query) or die (mysqli_error($link));

	    if ($sql) {

	    	//Recupero la ultima reserva insertada
	    	$id_reserva_generado = mysqli_insert_id($link);

	    	//Audito
	    	auditar($_SESSION["id_user"],$query);

	    	$query_detalle = "INSERT INTO `reservas_detalle`(`id_reserva`, `telefono`, `email`, `retiro`, `entrega`, `nro_vuelo`, `observaciones`) VALUES ($id_reserva_generado,'$telefono','$email',$retiro,$entrega,'$nro_vuelo','$observaciones')";
	    	$sql_detalle = mysqli_query($link,$query_detalle) or die (mysqli_error($link));

	    	if ($sql_detalle) {
	    		//Audito
	    		auditar($_SESSION["id_user"],$query_detalle);

	    		foreach ($adicionales as $adicional) {

	    			$query_adicionales = "INSERT INTO `reservas_adicionales`(`id_reserva`, `id_adicional`) VALUES ($id_reserva_generado,$adicional)";
	    			$sql_adicionales= mysqli_query($link,$query_adicionales) or die (mysqli_error($link));
	    		}

	    		mysqli_commit($link);

	    		return "ok";

	    	}else{

	    		mysqli_rollback($link);
	    		return "error";
	    	}

	    }else{

	    	return "error";
	    }

	    // Cerrar la conexión.
	    mysqli_close( $link );


	}

}


?>
