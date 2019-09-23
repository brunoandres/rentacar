<?php  
$enlace = mysqli_connect("localhost", "u756079281_dev", "cavaliere", "u756079281_dev");

$code = $_POST['code'];

$sql = "select * from reservas where codigo = '$code'";

$result = mysqli_query($enlace,$sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {

		echo '<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <!-- Position it -->
  <div style="position: absolute; top: 0; right: 0;">

    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded mr-2" alt="...">
        <strong class="mr-auto">Bootstrap</strong>
        <small class="text-muted">just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        See? Just like this.
      </div>
    </div>

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded mr-2" alt="...">
        <strong class="mr-auto">Bootstrap</strong>
        <small class="text-muted">2 seconds ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        Heads up, toasts will stack automatically
      </div>
    </div>
  </div>
</div>';

		/*echo "<p>";
		echo $row['nombre'];
		echo "<br>";
		echo $row['fecha_desde'];
		echo "<br>";
		echo $row['fecha_hasta'];
		echo "<br>";
		echo '$ '.$row['tarifa'];
		echo "</p>";*/
	}
}else{
	echo "<script>
				toastr.error('No existe Reserva con el código ingresado.', 'No se encontraron resultados', {timeOut: 8000})
			</script>";
}


?>