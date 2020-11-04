<?php

class Conexion{

  static function ConectarMysql(){

    $host= $_SERVER["HTTP_HOST"];

    switch ($host) {
      case 'www.patagoniaaustralrentacar.com.ar':
        $conn = mysqli_connect("localhost","u756079281_prod","cavaliere","u756079281_prod");
        break;

      case 'localhost'
        $conn = mysqli_connect("localhost","root","","rentacar");
        break;

      default:
        $conn = mysqli_connect("localhost","u756079281_prod","cavaliere","u756079281_prod");
        break;
    }

    mysqli_query($conn,"SET NAMES 'utf8'");
    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    return $conn;
  }


}



?>
