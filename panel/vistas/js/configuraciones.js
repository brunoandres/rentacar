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
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarConfiguracion", function(){

	 var idConfiguracion = $(this).attr("idConfiguracion");

	 swal({
	 	title: '¿Está seguro de borrar la Configuración?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Configuración!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=configuraciones&idConfiguracion="+idConfiguracion;

	 	}

	 })

})
