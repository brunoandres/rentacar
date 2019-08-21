<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Contacto</h2>
      <p class="lead">Contáctese con nostros completando el siguiente formulario de contacto.</p>
    </div>
    <div class="row h-100 justify-content-center align-items-center contact-wrap">
      <div class="col-sm-8 col-sm-offset-2">
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
        <form action="" method="post" role="form" class="contactForm">
          <div class="form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Nombre y Apellido" data-rule="minlen:4"
              data-msg="Please enter at least 4 chars" />
            <div class="validation"></div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="Dirección de correo" data-rule="email"
              data-msg="Please enter a valid email" />
            <div class="validation"></div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4"
              data-msg="Please enter at least 8 chars of subject" />
            <div class="validation"></div>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us"
              placeholder="Ingrese su mensaje o consulta"></textarea>
            <div class="validation"></div>
          </div>

          <div class="text-center"><button type="submit" class="btn btn-success btn-lg">Enviar mensaje</button></div>
        </form>
      </div>
    </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->
<br><br><br><br>