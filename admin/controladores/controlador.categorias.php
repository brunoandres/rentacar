<?php

class ControladorCategorias{

	static public function listarCategorias($id=null){

		$categorias = ModeloCategorias::listarCategorias($id);
		return $categorias;

	}

  static public function totalPorCategoria($id){

		$totalAuto = ModeloCategorias::totalAutos($id);
		return $totalAuto;

	}

	//funcion para editar categorias
	static function editarCategoria(){

		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreEditar"])){

				$nombre = $_POST['nombreEditar'];
				if (empty($_POST['activaEditar'])) {
					$categoria_vigente = 0;
				}else{
					$categoria_vigente = 1;
				}

				if (empty($_POST['promoEditar'])) {
					$permite_promo = 0;
				}else{
					$permite_promo = 1;
				}
				$id     = $_POST['idCategoria'];

				$respuesta = ModeloCategorias::editarCategoria($nombre,$categoria_vigente,$permite_promo,$id);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	//funcion para guardar categorias
	static function nuevaCategoria(){

		if(isset($_POST["nuevaCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["categoria"])){

				$nombre = $_POST['categoria'];
				if (empty($_POST['checkActiva'])) {
					$categoria_vigente = 0;
				}else{
					$categoria_vigente = 1;
				}

				if (empty($_POST['checkPromo'])) {
					$permite_promo = 0;
				}else{
					$permite_promo = 1;
				}

				$respuesta = ModeloCategorias::nuevaCategoria($nombre,$categoria_vigente,$permite_promo);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Categoria guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {}
						})

			  	</script>';

			}

		}

	}

}

?>
