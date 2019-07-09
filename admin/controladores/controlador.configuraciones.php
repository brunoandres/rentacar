<?php

class ControladorConfiguraciones{

  static public function listarConfiguraciones($id=null){

		$configuraciones = ModeloConfiguraciones::listarConfiguraciones($id);
		return $configuraciones;

	}

  static public function listarAdicionales($id=null){

		$adicionales = ModeloConfiguraciones::listarAdicionales($id);
		return $adicionales;

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

  static public function nuevaTempo(){

		if(isset($_POST["nuevaTemporada"])){

      $fecha_desde = $_POST['fecha_desde'];
      $fecha_hasta = $_POST['fecha_hasta'];
      if (empty($_POST['check'])) {
        $temporada_activa = 0;
      }else{
        $temporada_activa = 1;
      }
      $detalle = $_POST['detalle'];

      $respuesta = ModeloConfiguraciones::guardarTempo($fecha_desde,$fecha_hasta,$temporada_activa,$detalle);

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

  static public function adicionales(){

      $respuesta = ModeloConfiguraciones::mostrarAdicionales();
      return $respuesta;
  }

  static public function temporadas(){

      $respuesta = ModeloConfiguraciones::mostrarTemporadas();
      return $respuesta;
  }

  static public function tarifas(){

      $respuesta = ModeloConfiguraciones::mostrarTarifas();
      return $respuesta;
  }
}

?>
