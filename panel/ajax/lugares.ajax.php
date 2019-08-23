<?php

require_once "../controladores/controlador.configuraciones.php";
require_once "../modelos/modelo.configuraciones.php";

class AjaxLugares{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idLugar;

	public function ajaxEditarLugar(){

		$id = $this->idLugar;
		$respuesta = ControladorConfiguraciones::listarLugares($id);

		foreach ($respuesta as $lugar) {
			echo json_encode($lugar);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idLugar"])){

	$lugar = new AjaxLugares();
	$lugar -> idLugar = $_POST["idLugar"];
	$lugar -> ajaxEditarLugar();
}
