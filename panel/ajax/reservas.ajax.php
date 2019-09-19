<?php

require_once "../controladores/controlador.reservas.php";
require_once "../modelos/modelo.reservas.php";

class AjaxReservas{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idReserva;

	public function ajaxEditarReserva(){

		$id = $this->idReserva;
		$respuesta = ControladorReservas::listarReservas(1,NULL);

		foreach ($respuesta as $reserva) {
			echo json_encode($reserva);
		}
		//echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idReserva"])){

	$reserva = new AjaxReservas();
	$reserva -> idReserva = $_POST["idReserva"];
	$reserva -> ajaxEditarReserva();
}
