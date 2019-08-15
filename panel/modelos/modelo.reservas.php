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
			var_dump($contador);
		return $contador;

	}

}


?>
