<?php  


if (isset($_POST['btnForm'])) {
	if (!empty($_POST['nombre']) && !empty($_POST['email'])) {
			
		$nombre = $_POST['nombre'];
		$email = $_POST['email'];
		$asunto = $_POST['asunto'];
		$mensaje = $_POST['mensaje'];

		$header .= "From: Nueva consulta Austral Rent a Car <$email> \r\n";
		$header .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
		$header .= 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$asunto ="$asunto";
			//$header ="--------------------- CONSULTA CENERGON.COM.AR ------------------------------------";
		$contenido="			Nombre: $nombre <br>						
								Email: $email <br>								
								Mensaje: $mensaje";

		if (mail("brunoandres2013@gmail.com",$asunto,$contenido,$header)) {
			echo "<div class='alert alert-success' role='alert'>
			  Gracias por contactarase con nosotros! En breve nos pondremos en contacto con usted.
			</div>";
		}else{
			echo "<div class='alert alert-danger' role='alert'>
			  Ocurrio un error al intentar contactarse con nostros, intente nuevamente por favor.
			</div>";
		}

	}
}




?>