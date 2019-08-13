<?php

require_once "../controladores/controlador.configuraciones.php";
require_once "../modelos/modelo.configuraciones.php";

class AjaxAutos{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idAuto;

	public function ajaxEditarAuto(){

		$id = $this->idAuto;
		$respuesta = ControladorConfiguraciones::listarAutos($id);

		foreach ($respuesta as $auto) {
			echo json_encode($auto);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idAuto"])){

	$auto = new AjaxAutos();
	$auto -> idAuto = $_POST["idAuto"];
	$auto -> ajaxEditarAuto();
}
