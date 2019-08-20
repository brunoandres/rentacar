<?php

require_once 'modelo.conexion.php';
require_once 'modelo.funciones.php';


class ModeloCategorias{

  	static function listarCategorias($id){

		$categorias = array();
		$link = Conexion::ConectarMysql();

		//el id puede venir vacio, asi retorno todas las categorias
		if ($id == null) {
			$query = "select * from categorias order by nombre asc";
			$sql = mysqli_query($link,$query);
		    while ($filas = mysqli_fetch_array($sql)) {
		      $categorias[]=$filas;
	    	}
			return $categorias;
		}else{
			$query = "select * from categorias where id = $id order by nombre asc";
			$sql = mysqli_query($link,$query);

		    while ($filas = mysqli_fetch_array($sql)) {
		      $categorias[]=$filas;
		    }
			return $categorias;
		}

	    // Cerrar la conexión.
	    mysqli_close( $link );

	}

	  static function autosPorCategoria($id,$habilitado=null,$habilitado_chile=null){

	    $total = array();
	    $link = Conexion::ConectarMysql();

	    //Filtro por total de categorias
	    if ($habilitado==null && $habilitado_chile==null) {
	    	
	    	$query = "select b.nombre as categoria,count(*) as cantidad from autos a, categorias b where a.id_categoria = b.id and a.id_categoria=$id and a.estado=1 GROUP by a.id_categoria";

	    //Filtro cantidad por categoria los autos habilitados
	    }elseif ($habilitado_chile==null) {

	    	$query = "select b.nombre as categoria,count(*) as cantidad from autos a, categorias b where a.estado = 1 and a.id_categoria = b.id and a.id_categoria=$id and a.estado=1 GROUP by a.id_categoria";
	    //Filtro cantidad por categoria los autos habilitados a chile
	    }elseif ($habilitado==null) {

	    	$query = "select b.nombre as categoria,count(*) as cantidad from autos a, categorias b where a.viaja_chile = 1 and a.id_categoria = b.id and a.id_categoria=$id and a.estado=1 GROUP by a.id_categoria";
	    }
	    
	    $sql = mysqli_query($link,$query);
	    while ($filas = mysqli_fetch_assoc($sql)) {
			$total['total']=$filas['cantidad'];
		}
	    return $total;
	    // Cerrar la conexión.
	    mysqli_close( $link );
	  }


	static public function mdlCategoria($id){

		$categorias = array();
		$link = Conexion::ConectarMysql();
		$query = "select * from categorias where id = $id";
		$sql = mysqli_query($link,$query);
		while ($filas = mysqli_fetch_assoc($sql)) {
			$categorias[]=$filas;
		}

		return $categorias;
		// Cerrar la conexión.
		mysqli_close( $link );

	}


	static function nuevaCategoria($nombre,$activa,$promo){

		$link = Conexion::ConectarMysql();
		$query = "INSERT INTO `categorias`(`nombre`, `activa`, `promo`) VALUES ('$nombre',$activa,$promo)";
		$sql = mysqli_query($link,$query);
		if ($sql) {
			 auditar($_SESSION["id_user"],$query);
			return "ok";
		}else{
			return "error";
		}
		mysqli_close($link);
	}

	static function editarCategoria($nombre,$vigente,$promo,$id){

		$link = Conexion::ConectarMysql();
		$query = "UPDATE `categorias` SET `nombre`='$nombre',`activa`=$vigente,`promo`=$promo WHERE id = $id";
		$sql = mysqli_query($link,$query);
		if ($sql) {
			 auditar($_SESSION["id_user"],$query);
			return "ok";
		}else{
			return "error";
		}
		mysqli_close($link);
	}

}



?>
