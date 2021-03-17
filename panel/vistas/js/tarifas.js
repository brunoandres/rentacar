/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarTarifa", function(){

	var idTarifa = $(this).attr("idTarifa");
	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idTarifa", idTarifa);

	$.ajax({
		url: "ajax/tarifas.ajax.php",
		method: "POST",
    	data: datos,
    	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

				if (respuesta['activa']==1) {
					$("#activaTarifaActual").prop("checked",true);
				}
				$("#select_categoria").val(respuesta["id_categoria"]);
				$("#select_temporada").val(respuesta["id_temporada"]);
				$("#valor_diario").val(respuesta["por_dia"]);
				$("#valor_semanal").val(respuesta["por_semana"]);
     		$("#idTarifa").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR TARIFA
=============================================*/
$(".tablas").on("click", ".btnEliminarTarifa", function(){

	 var idTarifa = $(this).attr("idTarifa");

	 swal({
	 	title: '¿Está seguro de borrar la tarifa?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar tarifa!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=tarifas&idTarifa="+idTarifa;

	 	}

	 })

})
