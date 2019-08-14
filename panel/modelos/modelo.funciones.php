<?php  
require_once 'modelo.conexion.php';
function auditar($id_usuario,$operacion) {
	
	$link = ConexionServer::conexion();

	$query="INSERT INTO auditorias (fk_id_usuario,query) VALUES ('$id_usuario',\"$operacion\")";
	
	$auditado = mysqli_query($link,$query);

	return true;
	mysqli_close($link);

}

?>