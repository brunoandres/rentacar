<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Check Code</h2>
      <p class="lead">Ingrese su cógigo de Reserva para ver el detalle.</p>
    </div>
    <div class="row h-100 justify-content-center align-items-center contact-wrap">
      <div class="col-sm-8 col-sm-offset-2">
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
          <div class="form-group">
            <input type="text" name="code" class="form-control" id="code" placeholder="Código de Reserva" data-rule="minlen:4"
              data-msg="Please enter at least 4 chars" />
            <div class="validation"></div>
          </div>
          <div class="text-center"><button type="submit" id="button" id="button" class="btn btn-success btn-lg">Consultar Código!</button></div>
        <div id="resultado"></div>
      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->
<br><br><br><br>

<script>
  
 $(document).ready(function(){
 	$("#button").click(function(){
 		var code = $("#code").val();
 		$.ajax({
 			url : 'load-code-reservation.php',
 			data : 'code='+code,
 			success: function(data){
 				$("#resultado").html(data);
 			}
 		})
 	})
 });

</script>