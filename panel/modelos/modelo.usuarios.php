<?php

require_once 'modelo.conexion.php';

class ModeloUsuarios{

  static public function mostrarUsuarios($txtuser,$txtpass){

		if($txtuser != null && $txtpass != null){
      $link = Conexion::ConectarMysql();

      $user = mysqli_real_escape_string($link,$txtuser);
      $pass = mysqli_real_escape_string($link,$txtpass);
      $users = array();
      $query = "select usuario,pass,id_usuario,admin from usuarios where usuario = '$user' and pass = '$pass'";
	    $sql = mysqli_query($link,$query);
	    while ($filas = mysqli_fetch_assoc($sql)) {
	      $users['user']=$filas['usuario'];
        $users['pass']=$filas['pass'];
        $users['id_user']=$filas['id_usuario'];
        $users['iniciarSesion']='ok';
        $_SESSION['id_user']  = $filas['id_usuario'];
        $_SESSION['is_admin']  = $filas['admin'];
	    }
	    return $users;
	    // Cerrar la conexión.
	    mysqli_close( $link );

		}else {
      $users['user']=null;
    }
	}
}


?>
