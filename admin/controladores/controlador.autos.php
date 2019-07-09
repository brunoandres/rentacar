<?php

class ControladorAutos{

  static public function nuevoAuto(){

		if(isset($_POST["nuevoAuto"])){
      if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["marca"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["modelo"])){

          $user = $_POST['ingUsuario'];
          $pass = md5($_POST['ingPassword']);
          $respuesta = ModeloUsuarios::mostrarUsuarios($user,$pass);

          if ((!empty($respuesta) && $respuesta["user"] == $user && $respuesta["pass"] == $pass)) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id_user"] = $respuesta["id_user"];
						$_SESSION["usuario"] = $respuesta["user"];

						echo '<script>

    							window.location = "inicio";

    						</script>';

          }else{

    					echo '<br><div class="alert alert-danger">El usuario o la contraseña son incorrectos, vuelva a intentarlo.</div>';

  				}
        }else{
            echo '<br><div class="alert alert-warning">Error! Está ingresando caracteres inválidos, verifique.</div>';
        }
			}
		}
}

?>
