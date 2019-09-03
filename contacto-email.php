<?php  

$resultado = "";
$nombre = $_POST['nombre'];

$array = array("juan","bruno","pedro");

for ($i=0; $i < count($array); $i++) { 
	
	if ($nombre == $array[$i]) {
		$resultado = "<p>EL NOMBRE $nombre HA SIDO ENCONTRADO!</p>";
	}

}
	
if ($resultado=='') {
	echo "<p>EL NOMBRE $nombre NO HA SIDO ENCONTRADO!</p>";
}else{
	echo $resultado;
}


?>