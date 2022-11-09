<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<title>Spacanino</title>
</head>
<body>
<?php
require("../../conexion/conexion.php");

$guardar =$_GET["elimina"];
$id=$_GET["con"];
try{
$sql="DELETE FROM servicios WHERE id_ser=:id";
$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":id"=>$id,));//asigno las variables a los marcadores
echo '<script>alert("Haz Eliminado Correctamente este servicio, Yuju!");</script>';
echo '<script>window.location="../servicios.php"</script>';
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