<?php  
$enlace = mysqli_connect("localhost", "u756079281_dev", "cavaliere", "u756079281_dev");

$code = $_POST['code'];

$sql = "select * from reservas where codigo = '$code'";

$result = mysqli_query($enlace,$sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<p>";
		echo $row['nombre'];
		echo "<br>";
		echo $row['fecha_desde'];
		echo "<br>";
		echo $row['fecha_hasta'];
		echo "<br>";
		echo '$ '.$row['tarifa'];
		echo "</p>";
	}
}else{
	echo "<script>
 							toastr.error('No existe Reserva con el código ingresado.', 'Error Código', {timeOut: 8000})
 						</script>";
}


?>