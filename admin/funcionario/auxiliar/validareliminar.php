<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<title>Administrador</title>
</head>
<body>
<?php
require("../../../conexion/conexion.php");

$guardar =$_GET["elimina"];
$id=$_GET["doc"];
try{
	$sql="DELETE FROM auxvet WHERE id_aux=:id";
	$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
	$resultado->execute(array(":id"=>$id,));//asigno las variables a los marcadores
	echo '<script>alert("Haz Eliminado Correctamente este Auxiliar, Yuju!");</script>';
	echo '<script>window.location="./index.php"</script>';
	$resultado->closeCursor();

}
catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "F" . $id;
}
finally{
	$base=null;//vaciar memoria
}
?>
</body>
</html>