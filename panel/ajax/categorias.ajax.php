<?php

require_once "../controladores/controlador.categorias.php";
require_once "../modelos/modelo.categorias.php";

class AjaxCategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$id = $this->idCategoria;
		$respuesta = ControladorCategorias::listarCategorias($id);

		foreach ($respuesta as $categoria) {
			echo json_encode($categoria);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}
