<?php  
//include('config/classConexion.php');
function buscarTarifas($inicioFechaReserva,$categoria){

	$db = new Conexion();
	$categoriaSeleccionada = $categoria;
	$sql="select * from tarifas where categoria = $categoriaSeleccionada";
	$miFecha = $inicioFechaReserva;
	
	$precios = array();

	if ($resul = $db->query($sql)) {
	
	    while ($row = $resul->fetch_assoc()) {

	    	$rangoDesde = $row['fdesde'];
	    	$rangoHasta = $row['fhasta'];
	    	$precioxdia = $row['precio_dia'];
	    	$preciopromo =$row['precio_promo'];
	    	if (check_in_range($rangoDesde,$rangoHasta,$miFecha)) {
	    		
				array_push($precios, $precioxdia, $preciopromo);

	    	}
	    
	    }
	}

	return $precios;
}

//$array = buscarTarifas('2018-10-10',0);
//echo $array[0];
function check_in_range($start_date, $end_date, $date_from_user)
{
  //CONVIERTO A TIMESTAMP
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Controlo el rango entre start and end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

//FUNCION PARA CALCULAR LA CANTIDAD DE DIAS ENTRE LAS FECHAS SELECCIONADAS
function dateDiff($start, $end) {

  $start_ts = strtotime($start);

  $end_ts = strtotime($end);

  $diff = $end_ts - $start_ts;

  return round($diff / 86400);

}

function mostrarCategoria($id){

	$db = new Conexion();
	$sql="select categoria as cat from categorias where id_categoria=$id";
	if ($resultado = mysqli_query($db, $sql)) {
		while ($row = mysqli_fetch_assoc($resultado)) {
        	$categoria=$row["cat"];
  		}
	}
	return $categoria;
}
?>