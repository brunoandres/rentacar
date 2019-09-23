<?php  
$enlace = mysqli_connect("localhost", "u756079281_dev", "cavaliere", "u756079281_dev");

$code = $_POST['code'];

$sql = "select a.*,b.* from reservas a,categorias b where a.codigo = '$code' and a.id_categoria = b.id";

$result = mysqli_query($enlace,$sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {

		echo '<div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Detalles</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Categoria</h6>
                <small class="text-muted">Categoria seleccionada</small>
              </div>
              <span class="text-muted">'.$row['nombre'].'</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Dias de Alquiler</h6>
                <small class="text-muted">Cantidad de dias</small>
              </div>
              <span class="text-muted">'.$row['total_dias'].'</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Reserva (ARG)</span>
              <strong> $ '.number_format($row['tarifa'], 0, ",", ".").'</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Sus datos personales</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nombre</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="'.$row['nombre'].'" readonly>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Apellido</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="'.$row['apellido'].'" readonly>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Dirección de Email</label>
              <input type="email" class="form-control" id="email" value="'.$row['email'].'" placeholder="you@example.com" readonly>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Fecha Desde</label>
                <input type="date" class="form-control" value="'.$row['fecha_desde'].'" readonly>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="date">Fecha Hasta</label>
                <input type="date" class="form-control" value="'.$row['fecha_hasta'].'" readonly>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Hora Retiro</label>
                <input type="text" class="form-control" value="'.$row['hora_desde'].'" readonly>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
      
            <hr class="mb-4">
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continuar al Sitio</button>
          </form>
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