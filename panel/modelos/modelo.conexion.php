<?php

class Conexion{

  static function ConectarMysql(){

    $host= $_SERVER["HTTP_HOST"];

    if ($host=="www.patagoniaaustralrentacar.com.ar") {
      $server = "localhost";
      $user = "u756079281_prod";
      $pass = "cavaliere";
      $db = "u756079281_prod";
    }else{
      $server = "localhost";
      $user = "root";
      $pass = "";
      $db = "rentacar";
    }


    $conn = mysqli_connect($server,$user,$pass,$db);

    mysqli_query($conn,"SET NAMES 'utf8'");
    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    return $conn;
  }


}



?>
