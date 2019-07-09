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
     		$("#nombreAdicional").val(respuesta["nombre"]);
				$("#tarifaAdicional").val(respuesta["tarifa"]);
     		$("#idAdicional").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function(){

	 var idCategoria = $(this).attr("idCategoria");

	 swal({
	 	title: '¿Está seguro de borrar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

	 	}

	 })

})
