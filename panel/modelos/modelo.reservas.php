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

	//Funcion para formatear hora
	static function formatoHora($hora){

		$hora = date("H:i:s",strtotime($hora));
		return $hora;
	}

	//Funcion para sacar diferencia de horas
	static function diferenciaDeHoras($inicio,$fin){

		$dif = date("H:i:s",strtotime("00:00:00") +  strtotime($fin) - strtotime($inicio) );
		return $dif;

	}

	//Funcion principal para buscar disponibilidad entre fechas
	static function buscarDisponibilidad($categoria,$fechaDesdeReserva,$fechaHastaReserva,$hora_desde,$hora_hasta){
		$contador_autos = null;
		//Instancio mi clase categorias para traer total de autos para cada una.
		$new = new ModeloCategorias();

		$link 		= Conexion::ConectarMysql();
		$query 		= "select * from reservas where id_categoria = $categoria and estado = 1 and fecha_hasta >= '2019-08-01'";
		$resultado 	= mysqli_query($link,$query);

		//Total de resultados de la consulta
		$total_result = mysqli_num_rows($resultado);

		//retorno valor de buscarDisponibilidad (flag)
		$reserva_ok = false;

		//variable pora ir contando los cruces de reserva
		$choques_entre_reservas = 0;

		//busco total de autos por categorias
		/*switch ($categoria) {
			case 1:
				$contador = $new::autosPorCategoria(1,null,null);
				break;
			case 2:
				$contador = $new::autosPorCategoria(2,null,null);
				break;
			case 3:
				$contador = $new::autosPorCategoria(3,null,null);
				break;
			case 4:
				$contador = $new::autosPorCategoria(4,null,null);
				break;
			case 5:
				$contador = $new::autosPorCategoria(5,null,null);
				break;
		}

		$total = intval($contador['total']);*/
		for ($i=1; $i <= $categoria ; $i++) {

			$contador = $new::autosPorCategoria($i,null,null);
			$total = intval($contador['total']);


		}

		$sumaDeChoques = 0;
		$data = array();

		//Si hay resultados de busqueda, mi variable contador de autos es alterada
		if ($total_result>=1) {

			while ($filas = mysqli_fetch_assoc($resultado)) {

				//Busco el margen horario para reservar
		  	  	$margen_horario_disponible = ModeloConfiguraciones::margenHorario();
		  	  	$margen_activo = $margen_horario_disponible['activo'];
		  	  	$margen_horario_configuracion = $margen_horario_disponible['margen'];

		  	  	//guardo los datos ya desde la base de datos para recorrer
				$fechaDesdeConfirmada=$filas['fecha_desde'];
				$fechaHastaConfirmada=$filas['fecha_hasta'];
				$horaHastaConfirmada=$filas['hora_hasta'];
				$nroReserva=$filas['id'];

		  	  	//Si la configuracion está mal definida o viene null
		  	  	if (!empty($margen_horario_disponible)) {

		  	  		//Si la configuracion está activa
		  	  		if ($margen_activo=='1') {
		  	  			

		  	  			if ($fechaHastaConfirmada===$fechaDesdeReserva) {
		  	  				$margen_activo = true;

		  	  				if ($margen_horario_configuracion=='0.00' || empty($margen_horario_configuracion)) {
			  	  				$margen_horario = 2;
			  	  				settype($margen_horario, "integer");
				  	  		}else{
				  	  			$margen_horario = $margen_horario_configuracion;
				  	  			settype($margen_horario, "integer");
				  	  		}
		  	  			}else{
		  	  				$margen_activo = false;
		  	  			}	  	  		
		  	  		}

		  	  	}else{
		  	  		$margen_activo = false;
		  	  		$margen_horario = 2;
		  	  	}

				//retorno valor de buscarDisponibilidad (flag), entra en mi bucle como false
				$reserva_ok = false;
				$data[] = $filas;

				//Defino variable para saber si puedo entregar el auto en el dia (margen horario)
				$disponibleEnEldia = false;
				
				//Total de autos por categoria
				$contador_autos = $total;
				//var_dump($contador_autos);

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

				//Agrego una hora más a las reservas ya confirmadas
				$horaDesdeReservaConfirmada = date('H:i:s', strtotime($horaHastaConfirmada .'+ 1 hour'));
				//Paso formato hora, mi hora de reserva
				$horaDesdeReserva = self::formatoHora($hora_desde);
				
				//Diferencia entre la hora desde retiro de reserva y la que se entrega el mismo dia
				$diferencia = intval(self::diferenciaDeHoras($horaHastaConfirmada,$horaDesdeReserva));
				/*echo "<br> EL HORARIO DE RETIRO ES : ".$horaDesdeReserva;*/
				
				//Pregunto si está activo la configuracion con margen horario
				if ($margen_activo == true) {
					var_dump($fechaDesdeConfirmada);
					var_dump($fechaDesdeReserva);
					var_dump($margen_activo);
					//Si el margen horario está activo, pregunto si el dia que se quiere reservar conincide con alguna reserva ya confirmada
					/*if ('$fechaHastaConfirmada' === '$fechaDesdeReserva') {
						/*echo "<BR>NO HAY DISPONIBILIDAD, VERIFICAR MARGEN";
						echo "<BR>RESERVAS CHOCADAS : ".$sumaDeChoques =$sumaDeChoques+1;
					 	echo "<BR>AUTO DISPONIBLE :".$contador_autos = $contador_autos-$sumaDeChoques;*/
					 	echo "<BR> ESTOY RETIRANDO UN AUTO MISMO DIA QUE ENTREGAN OTRO";

					 	//Si quiero retirar un auto el mismo dia que se entrega, necesito que el margen horario sea superior al configurado, en caso de que asi sea. Se puede entregar el auto el mismo dia con el margen horario establecido previamente
					 	if ($horaHastaConfirmada < $horaDesdeReserva && $diferencia>=$margen_horario) {
					 		echo "<BR> EL HORARIO DE ENTREGA ES MENOR O IGUAL AL HORARIO DEL NUEVO RETIRO";

					 	//Si el margen horario no coincide, es decir se quiere retirar un auto antes de que se entregue, es imposible realizar la reserva	
					 	}else{
					 		
							$sumaDeChoques =$sumaDeChoques+1;
							$contador_autos = $contador_autos-$sumaDeChoques;
					 	}
/*
					}else{
						echo "<BR style='color:red;'>NO ESTOY RETIRANDO UN AUTO MISMO DIA QUE ENTREGAN OTRO";
					}*/
				//En caso que esté desactivada busco disponiblidad solo entre fechas	
				}else{

					if ($reserva_ok==false) {
						
						$sumaDeChoques =$sumaDeChoques+1;
						$contador_autos = $contador_autos-$sumaDeChoques;
					}

				}

			}//FIN WHILE

		}else{

			//Mi contador de autos no es alterado y toma el resultado de la base
			$contador_autos=$total;
		}

		//Retorno cantidad de autos entre las fechas solicitadas
		return $contador_autos;

	}

	static public function nuevaReserva($categoria,$codigo,$nombre,$apellido,$fecha_desde,$fecha_hasta,$hora_desde,$hora_hasta,$tarifa,$total_dias,$estado,$origen,$tiene_adicionales=null,$telefono,$email,$retiro,$entrega,$vuelo,$observaciones,$adicionales=null){

		$link = Conexion::ConectarMysql();

		//Desactivamos el autommit transaccional
		mysqli_autocommit($link,FALSE);

	    $query = "INSERT INTO `reservas`(`id_categoria`, `codigo`, `nombre`, `apellido`, `fecha_desde`, `fecha_hasta`, `hora_desde`, `hora_hasta`, `tarifa`, `total_dias`, `estado`, `origen`, `adicionales`) VALUES ($categoria,'$codigo','$nombre','$apellido','$fecha_desde','$fecha_hasta','$hora_desde','$hora_hasta','$tarifa',$total_dias,$estado,$origen,$tiene_adicionales)";
	    $sql = mysqli_query($link,$query) or die (mysqli_error($link));

	    if ($sql) {

	    	//Recupero la ultima reserva insertada
	    	$id_reserva_generado = mysqli_insert_id($link);

	    	$query_detalle = "INSERT INTO `reservas_detalle`(`id_reserva`, `telefono`, `email`, `retiro`, `entrega`, `nro_vuelo`, `observaciones`) VALUES ($id_reserva_generado,'$telefono','$email',$retiro,$entrega,'$vuelo','$observaciones')";
	    	$sql_detalle = mysqli_query($link,$query_detalle) or die (mysqli_error($link));


	    	if ($sql_detalle) {

	    		if (!empty($adicionales)) {
	    			foreach ($adicionales as $adicional => $value) {

	    			$query_adicionales = "INSERT INTO `reservas_adicionales`(`id_reserva`, `id_adicional`) VALUES ($id_reserva_generado,$value)";
	    			$sql_adicionales= mysqli_query($link,$query_adicionales) or die (mysqli_error($link));
	    			}
	    		}

	    		//var_dump($adicionales);

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
