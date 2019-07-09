<?php

require_once 'modelo.conexion.php';
require_once 'funciones.php';

class ModeloCategorias{

  	static function listarCategorias($id){

			$categorias = array();
			$link = Conexion::ConectarMysql();

			//el id puede venir vacio, asi retorno todas las categorias
			if ($id == null) {
				$query = "select * from categorias";
				$sql = mysqli_query($link,$query);
		    while ($filas = mysqli_fetch_array($sql)) {
		      $categorias[]=$filas;
		    }
				return $categorias;
			}else{
				$query = "select * from categorias where id = $id";
				$sql = mysqli_query($link,$query);

		    while ($filas = mysqli_fetch_array($sql)) {
		      $categorias[]=$filas;
		    }
				return $categorias;
			}

	    // Cerrar la conexión.
	    mysqli_close( $link );

	}

  static function totalAutos($id){

    $total = array();
    $link = Conexion::ConectarMysql();

    $query = "select  * from `autos` where id_categoria = $id";
    $total = mysqli_num_rows(mysqli_query($link,$query));
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

	static function editarCategoria($nombre,$vigente,$promo,$id){

		$link = Conexion::ConectarMysql();
		$query = "UPDATE `categorias` SET `nombre`='$nombre',`activa`=$vigente,`promo`=$promo WHERE id = $id";
		$sql = mysqli_query($link,$query);
		if ($sql) {
			return "ok";
		}else{
			return "error";
		}
		mysqli_close($link);
	}

	static function nuevaCategoria($nombre,$activa,$promo){

		$link = Conexion::ConectarMysql();
		$query = "INSERT INTO `categorias`(`nombre`, `activa`, `promo`) VALUES ('$nombre',$activa,$promo)";
		$sql = mysqli_query($link,$query);
		if ($sql) {
			return "ok";
		}else{
			return "error";
		}
		mysqli_close($link);
	}


}



?>
