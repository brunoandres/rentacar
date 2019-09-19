/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarReserva", function(){

	var idReserva = $(this).attr("idReserva");
	var datos = new FormData();
	datos.append("idReserva", idReserva);

	$.ajax({
		url: "ajax/reservas.ajax.php",
		method: "POST",
    	data: datos,
    	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

 		$("#nombre").val(respuesta["nombre"]);
 		$("#apellido").val(respuesta["apellido"]);
 		$("#telefono").val(respuesta["TELEFONO_CONTACTO"]);
 		$("#email").val(respuesta["email"]);
 		$("#vuelo").val(respuesta["NRO_DE_VUELO"]);
		$("#retiro").val(respuesta["retiro"]);
		$("#devolucion").val(respuesta["entrega"]);
		$("#tarifa").val(respuesta["TARIFA_RESERVA_TOTAL"]);
		$("#observaciones").val(respuesta["OBSERVACIONES"]);
 		$("#idReserva").val(respuesta["ID_RESERVA"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarReserva", function(){

	 var idReserva = $(this).attr("idReserva");

	 swal({
	 	title: '¿Está seguro de borrar la Reserva N° '+idReserva+' ?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Reserva!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=confirmadas&idReserva="+idReserva;

	 	}

	 })

})
