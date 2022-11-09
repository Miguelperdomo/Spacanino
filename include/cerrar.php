
	<?php 
	// Para cerrar las sesiones
 
	session_start();
	session_destroy();
	header("Location: ../login.php");
	exit();
		
	?>
