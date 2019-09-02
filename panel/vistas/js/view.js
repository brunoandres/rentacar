$(document).ready(function(){
      $('#add').click(function(){
           $('#insert').val("Guardar");
           $('#insert_form')[0].reset();
      });

      $(document).on('click', '.view_data', function(){
           var id_reserva = $(this).attr("id");
           if(id_reserva != '')
           {
                $.ajax({
                     url:"http://localhost/rentacar/panel/serverside/reservas-detalles.php",
                     method:"POST",
                     data:{id_reserva:id_reserva},
                     success:function(data){
                          $('#detalles').html(data);
                          $('#dataModal').modal('show');
                     }
                });
           }
      });
 });