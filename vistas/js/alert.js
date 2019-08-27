$(document).ready(function(){
	$('#confirma_reserva').click(function(event){
		event.preventDefault();

			$.ajax({
			type: 'POST',
			url: 'confirma', // Tu url de destino
			data: {

			nombre: 'juan', 
			apellido: 'garcia', 
			edad: '18'
			
			}, // los datos que se mandan por POST
			async: true,
			success: function(result){
				toastr.success('Su Reserva ha sido ingresada correctamente!!!')
				window.location='inicio';
			},
			error: function() {
			// El codigo que vas a hacer cuando falle el ajax
			}
		});
	});
});