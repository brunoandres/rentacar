/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarLugar", function(){

	var idLugar = $(this).attr("idLugar");

	var datos = new FormData();
	datos.append("idLugar", idLugar);

	$.ajax({
		url: "ajax/lugares.ajax.php",
		method: "POST",
    	data: datos,
    	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

        if (respuesta['activo']==1) {
			$("#activaLugar").prop("checked",true);
		}
 		$("#nombreLugar").val(respuesta["lugar"]);
		$("#observaciones").val(respuesta["observaciones"]);
 		$("#idLugar").val(respuesta["id"]);

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
