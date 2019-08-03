<?php

require_once "../controladores/controlador.configuraciones.php";
require_once "../modelos/modelo.configuraciones.php";

class AjaxTarifas{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idTarifa;

	public function ajaxEditarTarifa(){

		$id = $this->idTarifa;
		$respuesta = ControladorConfiguraciones::listarTarifas($id);

		foreach ($respuesta as $tarifa) {
			echo json_encode($tarifa);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idTarifa"])){

	$tarifa = new AjaxTarifas();
	$tarifa -> idTarifa = $_POST["idTarifa"];
	$tarifa -> ajaxEditarTarifa();
}
