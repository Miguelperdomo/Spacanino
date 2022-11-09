
			<?php
			session_start();
			include("../conexion/conexion.php");

			$click=$_GET["id"];

			if(isset($_GET['doc'])){


				$docu=$_GET['doc'];
			}


						

			$delete= "DELETE FROM deta_orden WHERE id_deta =:id";
			$resultado=$base->prepare($delete);
			$resultado->execute(array(":id"=>$click));
				                    				
			header("Location:detalle.php?id=$docu");

			
			
			
		