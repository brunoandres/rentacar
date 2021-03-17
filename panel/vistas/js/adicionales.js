/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarAdicional", function(){

	var idAdicional = $(this).attr("idAdicional");

	var datos = new FormData();
	datos.append("idAdicional", idAdicional);

	$.ajax({
		url: "ajax/adicionales.ajax.php",
		method: "POST",
    	data: datos,
    	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

        if (respuesta['habilitado']==1) {
					$("#activaAdicional").prop("checked",true);
				}

				if (respuesta['tarifa_diaria']==1) {
						$("#activaDiario").prop("checked",true);
				}

				if(respuesta['nombre'] == "SEGURO PREMIUM"){
						$("#nombreAdicional").prop("readonly",true);
				}

		 		$("#nombreAdicional").val(respuesta["nombre"]);
				$("#tarifaAdicional").val(respuesta["tarifa"]);
				$("#tarifaAdicional2").val(respuesta["tarifa2"]);
				$("#observaciones").val(respuesta["observaciones"]);
		 		$("#idAdicional").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarAdicional", function(){

	 var idAdicional = $(this).attr("idAdicional");

	 swal({
	 	title: '¿Está seguro de borrar el adicional?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar adicional!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=adicionales&ref="+idAdicional;

	 	}

	 })

})
