<?php

require_once "../controladores/controlador.configuraciones.php";
require_once "../modelos/modelo.configuraciones.php";

class AjaxAdicionales{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idAdicional;

	public function ajaxEditarAdicional(){

		$id = $this->idAdicional;
		$respuesta = ControladorConfiguraciones::listarAdicionales($id);

		foreach ($respuesta as $adicional) {
			echo json_encode($adicional);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idAdicional"])){

	$adicional = new AjaxAdicionales();
	$adicional -> idAdicional = $_POST["idAdicional"];
	$adicional -> ajaxEditarAdicional();
}
