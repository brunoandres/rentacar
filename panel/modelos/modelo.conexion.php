<?php

class Conexion{

  static function ConectarMysql(){

    //$conn = mysqli_connect("localhost","u756079281_prod","cavaliere","u756079281_prod");
    $conn = mysqli_connect("localhost","root","","rentacar");
    mysqli_query($conn,"SET NAMES 'utf8'");
    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    return $conn;
  }


}



?>
