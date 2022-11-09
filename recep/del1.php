
			<?php
			session_start();
			include("../conexion/conexion.php");

			$doc=$_SESSION['doc'];

			$sql="DELETE from deta_orden WHERE id_usu=:er";
			$resultado=$base->prepare($sql); 
			$resultado->execute(array(":er"=>$doc));

			header("Location:georden.php");
				
			?>		
	
		