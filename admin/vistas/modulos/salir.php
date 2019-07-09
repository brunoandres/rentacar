<?php


if (isset($_SESSION['id_user'])) {
	session_destroy();

	echo '<script>

		window.location = "ingreso";

	</script>';
}
