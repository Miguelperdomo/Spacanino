<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="">
    <title>Roles</title>
</head>
<body>
<?php
require("../../conexion/conexion.php");

    

    $id=                        $_GET["id"];
    $nombre=                      $_GET["nom"];

   
   

try{
$sql="UPDATE roles SET  role=:ro  WHERE id_rol=:id";
$resultado=$base->prepare($sql); 
$resultado->execute(array(":id"=>$id,":ro"=>$nombre));
echo '<script>alert("Haz actualizado nuestra Base de Datos, Yuju!");</script>';
echo '<script>window.location= "../roles.php"</script>';

 



$resultado->closeCursor();
}catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "Ya existe la cédula " . $id;
}finally{
	$base=null;//vaciar memoria
}


?>
</body>
</html>