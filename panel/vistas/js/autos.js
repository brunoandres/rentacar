/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarAuto", function(){

	var idAuto = $(this).attr("idAuto");

	var datos = new FormData();
	datos.append("idAuto", idAuto);

	$.ajax({
		url: "ajax/autos.ajax.php",
		method: "POST",
    	data: datos,
    	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			if (respuesta['estado']==1) {
				$("#habilitado").prop("checked",true);
			}
			if (respuesta['viaja_chile']==1) {
				$("#habilitadoChile").prop("checked",true);
			}
			$("#select_categoria").val(respuesta["id_categoria"]);
     		$("#marcaAuto").val(respuesta["marca"]);
     		$("#modeloAuto").val(respuesta["modelo"]);
     		$("#patente").val(respuesta["patente"]);
     		$("#observaciones").val(respuesta["observaciones"]);
     		$("#idAuto").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR AUTO
=============================================*/
$(".tablas").on("click", ".btnEliminarAuto", function(){

	 var idAuto = $(this).attr("idAuto");

	 swal({
	 	title: '¿Está seguro de borrar el auto?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar auto!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=autos&ref="+idAuto;

	 	}

	 })

})
