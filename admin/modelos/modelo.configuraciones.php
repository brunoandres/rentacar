<?php

require_once 'modelo.conexion.php';
require_once 'funciones.php';


class ModeloConfiguraciones{

  static function listarConfiguraciones($id){

    $configuraciones = array();
    $link = Conexion::ConectarMysql();

    //el id puede venir vacio, asi retorno todas las categorias
    if ($id == null) {
      $query = "select * from configuraciones";
      $sql = mysqli_query($link,$query);
      while ($filas = mysqli_fetch_array($sql)) {
        $configuraciones[]=$filas;
      }
      return $configuraciones;
    }else{
      $query = "select * from configuraciones where id = $id";
      $sql = mysqli_query($link,$query);

      while ($filas = mysqli_fetch_array($sql)) {
        $configuraciones[]=$filas;
      }
      return $configuraciones;
    }

    // Cerrar la conexión.
    mysqli_close( $link );

  }

  static public function guardarConfiguracion($nombre,$valor,$activa){

    $link = Conexion::ConectarMysql();
    $query = "INSERT INTO `configuraciones`(`nombre`, `valor`,`activa`) VALUES ('$nombre','$valor',$activa)";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
	}

  static public function guardarAdicional($nombre,$tarifa,$activo){

    $link = Conexion::ConectarMysql();
    $query = "INSERT INTO `adicionales`(`nombre`, `tarifa`, `habilitado`) VALUES ('$nombre','$tarifa',$activo)";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
	}

  static public function guardarTempo($fecha_desde,$fecha_hasta,$activa,$detalle){

    $link = Conexion::ConectarMysql();

    //convierto fechas
    $fecha_desde_db = convertirFecha($fecha_desde);
    $fecha_hasta_db = convertirFecha($fecha_hasta);
    $query = "INSERT INTO `temporadas`(`fecha_desde`, `fecha_hasta`, `activa`, `detalle`) VALUES ('$fecha_desde_db','$fecha_hasta_db',$activa,'$detalle')";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
	}

  static public function mostrarTemporadas(){

      $link = Conexion::ConectarMysql();
      $temporadas = array();
      $query = "select * from temporadas";
	    $sql = mysqli_query($link,$query);
	    while ($filas = mysqli_fetch_assoc($sql)) {
	       $temporadas[] = $filas;
	    }
	    return $temporadas;
	    // Cerrar la conexión.
	    mysqli_close( $link );
	}

  static public function listarAdicionales($id){

    $adicionales = array();
    $link = Conexion::ConectarMysql();

    //el id puede venir vacio, asi retorno todas las categorias
    if ($id == null) {
      $query = "select * from adicionales order by nombre asc";
      $sql = mysqli_query($link,$query);
      while ($filas = mysqli_fetch_array($sql)) {
        $adicionales[]=$filas;
      }
      return $adicionales;
    }else{
      $query = "select * from adicionales where id = $id";
      $sql = mysqli_query($link,$query);

      while ($filas = mysqli_fetch_array($sql)) {
        $adicionales[]=$filas;
      }
      return $adicionales;
    }

    // Cerrar la conexión.
    mysqli_close( $link );
	}

  static function editarAdicional($nombre,$tarifa,$activo,$id){

		$link = Conexion::ConectarMysql();
		$query = "UPDATE `adicionales` SET `nombre`='$nombre',`tarifa`='$tarifa',`habilitado`=$activo WHERE id = $id";
		$sql = mysqli_query($link,$query);
		if ($sql) {
			return "ok";
		}else{
			return "error";
		}
		mysqli_close($link);
	}

  static public function mostrarTarifas(){

      $link = Conexion::ConectarMysql();
      $tarifas = array();
      $query = "SELECT a.*, b.*,c.* from tarifas a, temporadas b,categorias c where a.id_temporada=b.id and a.id_categoria=c.id";
	    $sql = mysqli_query($link,$query);
	    while ($filas = mysqli_fetch_assoc($sql)) {
	       $tarifas[] = $filas;
	    }
	    return $tarifas;
	    // Cerrar la conexión.
	    mysqli_close( $link );
	}
}


?>
