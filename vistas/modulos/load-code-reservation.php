<?php  
$enlace = mysqli_connect("localhost", "u756079281_dev", "cavaliere", "u756079281_dev");

$code = '89834';

$sql = "select * from reservas where codigo = '$code'";

$result = mysqli_query($enlace,$sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<p>";
		echo $row['nombre'];
		echo "<br>";
		echo $row['fecha_desde'];
		echo "</p>";
	}
}else{
	echo "NO EXISTE LA RESERVA";
}


?>