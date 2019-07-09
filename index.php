<?php

require_once "./controladores/controlador.plantilla.php";
require_once "./panel/controladores/controlador.reservas.php";
require_once "./panel/modelos/modelo.reservas.php";
require_once "./panel/controladores/controlador.categorias.php";
require_once "./panel/modelos/modelo.categorias.php";
$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();


?>
