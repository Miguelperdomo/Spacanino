<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="">
    <title>Servicio</title>
</head>
<body>
<?php
require("../../conexion/conexion.php");

    

    $consecutivo=                        $_GET["con"];
    $servicio=                      $_GET["ser"];
    $precio=                    $_GET["pre"];
   
   

try{
    $sql="UPDATE servicios SET  servicio=:ser, precio=:pre  WHERE id_ser=:id";
    $resultado=$base->prepare($sql); 
    $resultado->execute(array(":id"=>$consecutivo,":ser"=>$servicio,":pre"=>$precio ));
    echo '<script>alert("Haz actualizado este Servicio, Yuju!");</script>';
    echo '<script>window.location= "../servicios.php"</script>';

    $resultado->closeCursor();
}catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "Ya existe la cédula " . $consecutivo;
}finally{
	$base=null;//vaciar memoria
}


?>
</body>
</html>