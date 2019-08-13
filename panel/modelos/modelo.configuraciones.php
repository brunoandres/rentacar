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

  static public function listarTemporadas($id=null){

      $link = Conexion::ConectarMysql();
      $temporadas = array();
      if ($id == null) {
        $query = "select * from temporadas";
        $sql = mysqli_query($link,$query);
        while ($filas = mysqli_fetch_array($sql)) {
          $temporadas[]=$filas;
        }
        return $temporadas;
      }else{
        $query = "select * from temporadas where id = $id";
        $sql = mysqli_query($link,$query);

        while ($filas = mysqli_fetch_array($sql)) {
          $temporadas[]=$filas;
        }
        return $temporadas;
      }

	    // Cerrar la conexión.
	    mysqli_close( $link );
	}

  static public function listarTemporadasDetalle($id){

      $temporada = array();
      $link = Conexion::ConectarMysql();
      
      $query = "select * from temporadas where id = $id";
      $sql = mysqli_query($link,$query);
      
     
      while ($filas = mysqli_fetch_array($sql)) {
          $temporada['nombre']=$filas['nombre'];
          $temporada['fecha_desde']=$filas['fecha_desde'];
          $temporada['fecha_hasta']=$filas['fecha_hasta'];
          $temporada['activa']=$filas['activa'];
          $temporada['observaciones']=$filas['observaciones'];
        
      }

      return $temporada;
      // Cerrar la conexión.
      mysqli_close( $link );
  }

  static public function listarAdicionales($id){

    $link = Conexion::ConectarMysql();
    $adicionales = array();

    //el id puede venir vacio, asi retorno todas los adicionales
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

  static public function listarAutos($id){

    $link = Conexion::ConectarMysql();
    $autos = array();

    //el id puede venir vacio, asi retorno todas los adicionales
    if ($id == null) {
      $query = "select a.*,b.nombre from autos a,categorias b where a.id_categoria=b.id order by a.marca asc";
      $sql = mysqli_query($link,$query);
      while ($filas = mysqli_fetch_array($sql)) {
        $autos[]=$filas;
      }
      return $autos;
    }else{
      $query = "select * from autos where id = $id";
      $sql = mysqli_query($link,$query);

      while ($filas = mysqli_fetch_array($sql)) {
        $autos[]=$filas;
      }
      return $autos;
    }

    // Cerrar la conexión.
    mysqli_close( $link );
  }

  static public function listarTarifas($id=null){

    $link = Conexion::ConectarMysql();
    $tarifas = array();
    if ($id == null) {
      $query = "SELECT a.id,a.por_dia,a.por_semana,a.activa,b.id as id_temporada,b.fecha_desde,b.fecha_hasta,c.id as id_categoria,c.nombre from tarifas a, temporadas b,categorias c where a.id_temporada=b.id and a.id_categoria=c.id order by c.nombre asc";
	    $sql = mysqli_query($link,$query);
	    while ($filas = mysqli_fetch_assoc($sql)) {
	       $tarifas[] = $filas;
	    }
	    return $tarifas;

    }else{
      $query = "SELECT a.id,a.por_dia,a.por_semana,a.activa,b.id as id_temporada,b.fecha_desde,b.fecha_hasta,c.id as id_categoria,c.nombre from tarifas a, temporadas b,categorias c where a.id_temporada=b.id and a.id_categoria=c.id and a.id=$id order by c.nombre asc";
	    $sql = mysqli_query($link,$query);
	    while ($filas = mysqli_fetch_assoc($sql)) {
	       $tarifas[] = $filas;
	    }
	    return $tarifas;
    }
	    // Cerrar la conexión.
	    mysqli_close( $link );
	}



  ////////////////////////////////////////
  //// Metodos para guardar///////////////
  ////////////////////////////////////////

  static public function guardarAuto($marca,$modelo,$categoria,$patente,$habilitado,$habilitado_chile){

    $link = Conexion::ConectarMysql();
    $query = "INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`) VALUES ($categoria,'$marca','$modelo','$patente',$habilitado,$habilitado_chile)";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
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

  static public function editarConfiguracion($nombre,$valor,$activa,$id_configuracion){

    $link = Conexion::ConectarMysql();
    $query = "INSERT INTO `UPDATE `configuraciones` SET `nombre`='$nombre',`valor`='$valor',`activa`=$activa WHERE id = $id_configuracion";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
  }

  static public function editarAuto($marca,$modelo,$categoria,$patente,$habilitado,$habilitado_chile,$id_auto){

    $link = Conexion::ConectarMysql();
    $query = "UPDATE `autos` SET `id_categoria`=$categoria,`marca`='$marca',`modelo`='$modelo',`patente`='$patente',`estado`=$habilitado,`viaja_chile`=$habilitado_chile WHERE id = $id_auto";
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

  static public function guardarTarifa($categoria,$temporada,$valor_diario,$valor_semanal,$tarifa_actual){

    $link = Conexion::ConectarMysql();
    $query = "INSERT INTO `tarifas`(`por_dia`, `por_semana`, `id_temporada`, `id_categoria`, `activa`) VALUES ('$valor_diario','$valor_semanal',$temporada,$categoria,$tarifa_actual)";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
	}

  static public function editarTarifa($categoria,$temporada,$valor_diario,$valor_semanal,$tarifa_actual,$id_tarifa){

    $link = Conexion::ConectarMysql();
    $query = "UPDATE `tarifas` SET `por_dia`='$valor_diario',`por_semana`='$valor_semanal',`id_temporada`=$temporada,`id_categoria`=$categoria,`activa`=$tarifa_actual WHERE id = $id_tarifa";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
  }

  static public function guardarTempo($nombre,$fecha_desde,$fecha_hasta,$activa,$detalle){

    $link = Conexion::ConectarMysql();

    //convierto fechas
    $fecha_desde_db = convertirFecha($fecha_desde);
    $fecha_hasta_db = convertirFecha($fecha_hasta);
    $query = "INSERT INTO `temporadas`(`nombre`,`fecha_desde`, `fecha_hasta`, `activa`, `detalle`) VALUES ('$nombre','$fecha_desde_db','$fecha_hasta_db',$activa,'$detalle')";
    $sql = mysqli_query($link,$query) or die (mysqli_error($link));
    if ($sql) {
      return "ok";
    }else{
      return $sql;
    }
    // Cerrar la conexión.
    mysqli_close( $link );
	}

  ////////////////////////////////////////
  //// Metodos para editar///////////////
  ////////////////////////////////////////

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


}


?>
