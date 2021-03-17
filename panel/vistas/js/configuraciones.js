/*=============================================
EDITAR CONFIGURACION
=============================================*/
$(".tablas").on("click", ".btnEditarConfiguracion", function(){

	var idConfiguracion = $(this).attr("idConfig");

	var datos = new FormData();
	datos.append("idConfiguracion", idConfiguracion);

	$.ajax({
		url: "ajax/configuraciones.ajax.php",
		method: "POST",
    	data: datos,
    	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

			if (respuesta['activa']==1) {
				$("#activaEditar").prop("checked",true);
			}
			$("#nombreConfig").val(respuesta["nombre"]);
			if (respuesta["nombre"] == 'Promociones' || respuesta["nombre"] == 'Margen Horario' || respuesta["nombre"] == 'Cantidad Dias') {
				$('#nombreConfig').prop('readonly', true);
			}

     		$("#valorConfig").val(respuesta["valor"]);
     		$("#idConfiguracion").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR TEMPORADA
=============================================*/
$(".tablas").on("click", ".btnEliminarTemporada", function(){

	 var idTemporada = $(this).attr("idTemporada");

	 swal({
	 	title: '¿Está seguro de borrar la temporada?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Temporada!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=temporadas&ref="+idTemporada;

	 	}

	 })

})
