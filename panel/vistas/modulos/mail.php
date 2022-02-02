<?php  




		$header_cliente .= "From: SITIO - Reservas Patagonia Austral <patagoniaaustralrentacar@gmail.com> \r\n";
		$header_cliente .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
		$header_cliente .= 'MIME-Version: 1.0' . "\r\n";
		$header_cliente .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		$asunto_cliente = "Información de su Reserva - Sitio Oficial Rent a Car";
			//$header ="--------------------- CONSULTA CENERGON.COM.AR ------------------------------------";

		$add = '* Adicionales <br>
		<p>Todos los adicionales añaden un costo al total de la reserva, en caso de rotura ó robo de los mismos, se deberan abonar con los siguientes valores.</p>
		<strong></strong>
		<br><br>';

		$contenido_cliente = "Se ha confirmado la Reserva a nombre de $nombre en Austral Rent a Car <br>
		<br><br>

		Detalles de su Reserva:<br><br>

		Código Reserva: 0001 <br>
		Fecha Desde: 07/12/2020 <br>
		Fecha Hasta: 21/12/2020 <br>
		Vehículo: Cat. A <br>
		Retirar en: AEROPUERTO <br>
		Hora a retirar: 15 hs. <br>
		Hora de devolución: 15 hs. <br>
		N° de Vuelo: AR1066 <br>
		Tarifa Reserva: $ 30.000 <br><br>

		Adicionales seleccionados:<br><br>
		---
		<br>
		* Información <br>
		<p>Todos los vehículos poseen cubiertas de hielo y nieve.</p>
		<br>
		* Horarios  <br>
		<p>El horario de devolución del vehículo deberá ser el mismo indicado en el formulario de la Reserva, de lo contrario se cobrará el adicional como un día más de alquiler.</p>
		 <br><br>

		* Medios de pago <br>
		Puede realizar el pago en efectivo a la hora de la entrega,
		o mediante depósito bancario.<br>
		Banco Galicia : <br>
		DU: 32699886 <br>
		CTA: 4019424-7031-8 <br>
		CBU: 0070031330004019424784 <br>
		CUIL: 27326998864 <br>
		ALIAS: Austral1987 <br>
		Para mayor información, por favor comuniquese con nosotros. Muchas Gracias.<br><br>

		Se deberá realizar el pago del 15 % del valor de la reserva, de lo contrario se dará de baja la misma.

		<br><br>

		-------------Info Contacto Rent a Car-------<br><br>
		Jimena González Whatsapp Tel: +54 9 2944242615.

		<h3>Franquicia</h3>
    	<p>

			*CATEGORÍA A, B y C: Km libre para recorrer la zona de Bariloche,  Villa la Angostura,  San Martin y  el Bolson.
Seguro todo riesgo con franquicia de $40.000 por accidente y $80.000 por vuelco.<br>
*Categoría D ,E y F Km libre para recorrer la zona de Bariloche,  Villa la Angostura,  San Martin y  el Bolson. Seguro todo riesgo con franquicia de $80.000 pesos por accidente y $120.000 pesos por vuelco.
Pago en efectivo o transferencia bancaria al momento de la entrega.<br>
Para señar se solicita un 50% del total del alquiler por transferencia.

<br><br>

<p>Enviar comprobante por este mismo medio o WhatsApp +5492944242615 Jimena</p>



			</p>";
	    //echo($contenido_cliente);
		if (mail("mauriciofleiva@gmail.com,brunoandres2013@gmail.com",$asunto_cliente,$contenido_cliente,$header_cliente)) {
			echo "ENVIADO";
		}else{
			echo "ERROR";
		}







?>