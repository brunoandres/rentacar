<?php

require_once "../controladores/controlador.configuraciones.php";
require_once "../modelos/modelo.configuraciones.php";

class AjaxConfiguraciones{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idConfiguracion;

	public function ajaxEditarConfiguracion(){

		$id = $this->idConfiguracion;
		$respuesta = ControladorConfiguraciones::listarConfiguraciones($id);

		foreach ($respuesta as $configuracion) {
			echo json_encode($configuracion);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idConfiguracion"])){

	$configuracion = new AjaxConfiguraciones();
	$configuracion -> idConfiguracion = $_POST["idConfiguracion"];
	$configuracion -> ajaxEditarConfiguracion();
}
