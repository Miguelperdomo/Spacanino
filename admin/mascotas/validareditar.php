<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="">
    <title>Spacanino</title>
</head>
<body>
<?php
require("../../conexion/conexion.php");

    $id = $_GET['id'];
    $tipo = $_GET['tp'];
    $nombre = $_GET["nom"];
    $raza = $_GET['corr'];
    $color = $_GET['usu'];
    $dueño = $_GET['usua'];
    
   

try{
    $sql="UPDATE mascotas SET  id_tip_pet=:tp, namepet=:nm, id_raza=:rz, color=:cl, id_usu=:us  WHERE id_mas=:id";
    $resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
    $resultado->execute(array(":id"=>$id,":tp"=>$tipo,":nm"=>$nombre, ":rz"=>$raza, ":cl"=>$color, ":us"=>$dueño ));//asigno las variables a los marcadores
    echo '<script>alert("Haz actualizado esta Mascota, Yuju!");</script>';
    echo '<script>window.location= "../mascotas.php"</script>';
    
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