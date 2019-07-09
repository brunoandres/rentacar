<?php
require_once "controladores/controlador.plantilla.php";
require_once "../controladores/controlador.reservas.php";
require_once "../controladores/controlador.categorias.php";
require_once "../modelos/modelo.reservas.php";
require_once "../modelos/modelo.categorias.php";
$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
