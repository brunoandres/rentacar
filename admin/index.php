<?php
require_once "controladores/controlador.plantilla.php";
require_once "controladores/controlador.reservas.php";
require_once "controladores/controlador.usuarios.php";
require_once "controladores/controlador.configuraciones.php";
require_once "controladores/controlador.categorias.php";

require_once "modelos/modelo.conexion.php";
require_once "modelos/modelo.reservas.php";
require_once "modelos/modelo.usuarios.php";
require_once "modelos/modelo.configuraciones.php";
require_once "modelos/modelo.categorias.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

$link = new Conexion();
$link = Conexion::ConectarMysql();
