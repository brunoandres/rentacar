<?php

class ControladorConfiguraciones{

	//Metodo para listar los autos
  static public function listarAutos($id=null){

		$autos = ModeloConfiguraciones::listarAutos($id);
		return $autos;

	}

  //Metodo para listar las configuraciones del sistema
  static public function listarConfiguraciones($id=null){

		$configuraciones = ModeloConfiguraciones::listarConfiguraciones($id);
		return $configuraciones;

	}

  //Metodo para listar los adicionales
  static public function listarAdicionales($id=null){

		$adicionales = ModeloConfiguraciones::listarAdicionales($id);
		return $adicionales;

	}

  //Metodo para listar las temporadas
  static public function listarTemporadas($id=null){

		$temporadas = ModeloConfiguraciones::listarTemporadas($id);
		return $temporadas;

	}

	//Metodo para listar data de temporadas
  static public function listarTemporadasDetalle($id){

		$temporadas = ModeloConfiguraciones::listarTemporadasDetalle($id);
		return $temporadas;

	}

  //Metodo para listar las tarifas definidas por temporadas
  static public function listarTarifas($id=null){

      $respuesta = ModeloConfiguraciones::listarTarifas($id);
      return $respuesta;
  }

  //Metodo para guardar un auto
  static public function nuevoAuto(){

    if (isset($_POST['nuevoAuto'])) {

      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $categoria = $_POST['categoria'];
      $patente = $_POST['patente'];

      if (empty($_POST['checkHabilitado'])) {
        $habilitado = 0;
      }else{
        $habilitado = 1;
      }

      if (empty($_POST['checkChile'])) {
        $habilitado_chile = 0;
      }else{
        $habilitado_chile = 1;
      }
      

      $respuesta = ModeloConfiguraciones::guardarAuto($marca,$modelo,$categoria,$patente,$habilitado,$habilitado_chile);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Auto guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "autos";

								}
							})

				</script>';
      } else {
        echo'<script>

				swal({
						type: "danger",
						title: "Error al guardar auto.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }

    }

  }

  //Metodo para guardar un auto
  static public function editarAuto(){

    if (isset($_POST['editarAuto'])) {

      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $categoria = $_POST['categoria'];
      $patente = $_POST['patente'];
      $id_auto = $_POST['id_auto'];
      if (empty($_POST['habilitado'])) {
        $habilitado = 0;
      }else{
        $habilitado = 1;
      }

      if (empty($_POST['habilitado_chile'])) {
        $habilitado_chile = 0;
      }else{
        $habilitado_chile = 1;
      }
      

      $respuesta = ModeloConfiguraciones::editarAuto($marca,$modelo,$categoria,$patente,$habilitado,$habilitado_chile,$id_auto);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Auto editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "autos";

								}
							})

				</script>';
      } else {
        echo'<script>

				swal({
						type: "danger",
						title: "Error al editar auto.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }

    }

  }

  //Metodo para guardar una nueva tarifa
  static public function nuevaTarifa(){

    if (isset($_POST['nuevaTarifa'])) {

      $categoria = $_POST['select_categoria'];
      $temporada = $_POST['select_temporada'];
      if (empty($_POST['checkTarifa'])) {
        $tarifa_actual = 0;
      }else{
        $tarifa_actual = 1;
      }
      $valor_diario = $_POST['valor_diario'];
      $valor_semanal = $_POST['valor_semanal'];

      $respuesta = ModeloConfiguraciones::guardarTarifa($categoria,$temporada,$valor_diario,$valor_semanal,$tarifa_actual);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Tarifa guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "tarifas";

								}
							})

				</script>';
      } else {
        echo'<script>

				swal({
						type: "danger",
						title: "Error al guardar tarifa.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }

    }

  }

  //Metodo para editar una tarifa
  static public function editarTarifa(){

    if (isset($_POST['editarTarifa'])) {

      $categoria = $_POST['select_categoria'];
      $temporada = $_POST['select_temporada'];
      if (empty($_POST['checkTarifa'])) {
        $tarifa_actual = 0;
      }else{
        $tarifa_actual = 1;
      }
      $valor_diario = $_POST['valor_diario'];
      $valor_semanal = $_POST['valor_semanal'];
      $id_tarifa = $_POST['id_tarifa'];

      $respuesta = ModeloConfiguraciones::editarTarifa($categoria,$temporada,$valor_diario,$valor_semanal,$tarifa_actual,$id_tarifa);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Tarifa editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "tarifas";

								}
							})

				</script>';
      } else {
        echo'<script>

				swal({
						type: "danger",
						title: "Error al editar tarifa.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }

    }

  }

  static public function nuevaConfiguracion(){

    if (isset($_POST['nuevaConfiguracion'])) {

      $nombre = $_POST['nombre'];
      $valor = $_POST['valor'];
      if (empty($_POST['checkActiva'])) {
        $config_activa = 0;
      }else{
        $config_activa = 1;
      }

      $respuesta = ModeloConfiguraciones::guardarConfiguracion($nombre,$valor,$config_activa);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Configuración guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "configuraciones";

								}
							})

				</script>';
      } else {
        echo'<script>

				swal({
						type: "danger",
						title: "Error al guardar configuración.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }

    }

  }

  static public function editarConfiguracion(){

    if (isset($_POST['editarConfiguracion'])) {

      $nombre = $_POST['nombre'];
      $valor = $_POST['valor'];
      if (empty($_POST['checkActiva'])) {
        $config_activa = 0;
      }else{
        $config_activa = 1;
      }
      $id_configuracion = $_POST['id_configuracion'];

      $respuesta = ModeloConfiguraciones::editarConfiguracion($nombre,$valor,$config_activa,$id_configuracion);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Configuración editada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "configuraciones";

								}
							})

				</script>';
      } else {
        echo'<script>

				swal({
						type: "danger",
						title: "Error al editar configuración.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }

    }

  }

  static public function nuevaTempo(){

		if(isset($_POST["nuevaTemporada"])){

			  $nombre = $_POST['nombre_temporada'];
		      $fecha_desde = $_POST['fecha_desde'];
		      $fecha_hasta = $_POST['fecha_hasta'];
		      if (empty($_POST['check'])) {
		        $temporada_activa = 0;
		      }else{
		        $temporada_activa = 1;
		      }
		      $detalle = $_POST['detalle'];

		      $respuesta = ModeloConfiguraciones::guardarTempo($nombre,$fecha_desde,$fecha_hasta,$temporada_activa,$detalle);

		      if ($respuesta=="ok") {
		        echo'<script>

						swal({
								type: "success",
								title: "Temporada guardada correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
										if (result.value) {

										window.location = "temporadas";

										}
									})

						</script>';
		      	}	else{
		        echo'<script>

						swal({
								type: "danger",
								title: "Error al guardar, revise los datos ingresados $respuesta",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){})

						</script>';
		      	}

			}
  	}

  static public function nuevoAdicional(){

		if(isset($_POST["nuevoAdicional"])){

      $nombre = $_POST['nombre'];
      $tarifa = $_POST['tarifa'];
      if (empty($_POST['check'])) {
        $adicional_activo = 0;
      }else{
        $adicional_activo = 1;
      }

      $respuesta = ModeloConfiguraciones::guardarAdicional($nombre,$tarifa,$adicional_activo);

      if ($respuesta=="ok") {
        echo'<script>

				swal({
						type: "success",
						title: "Adicional guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "adicionales";

								}
							})

				</script>';
      }else{
        echo'<script>

				swal({
						type: "danger",
						title: "Error al guardar, revise los datos ingresados $respuesta",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){})

				</script>';
      }


		}
  }

  //funcion para editar adicionales
	static function editarAdicional(){

		if(isset($_POST["editarAdicional"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreAdicional"])){

				$nombre = $_POST['nombreAdicional'];
        $tarifa = $_POST['tarifaAdicional'];
				if (empty($_POST['activaAdicional'])) {
					$adicional_activo = 0;
				}else{
					$adicional_activo = 1;
				}

				$id     = $_POST['idAdicional'];

				$respuesta = ModeloConfiguraciones::editarAdicional($nombre,$tarifa,$adicional_activo,$id);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Adicional editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "adicionales";

									}
								})

					</script>';

				}else{

  					echo'<script>

  					swal({
  						  type: "error",
  						  title: "Error al editar adicional",
  						  showConfirmButton: true,
  						  confirmButtonText: "Cerrar"
  						  }).then(function(result){
  									if (result.value) {

  									window.location = "adicionales";

  									}
  								})

  					</script>';

  				}
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El adicional no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "adicionales";

							}
						})

			  	</script>';

			}

		}

	}




}

?>
