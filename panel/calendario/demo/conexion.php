<?php

function Conexion(){

	$servidor = 'localhost';
	$base_de_datos ='u756079281_prod';
	$usuario = 'u756079281_prod';
	$clave = 'cavaliere';

	$conexion = new mysqli($servidor,$usuario,$clave,$base_de_datos);
	mysqli_set_charset($conexion,'utf8');
	if ($conexion->connect_error) {

		die('Error en la conexion : '.$conexion->connect_errno.'-'.$conexion->connect_error);

	}
	return $conexion;
}
?>
