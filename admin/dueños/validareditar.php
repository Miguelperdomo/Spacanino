<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="">
    <title>Administrador</title>
</head>
<body>
<?php
require("../../conexion/conexion.php");

    $documento = $_GET["doc"];
    $nombre = $_GET["nom"];
    $direccion = $_GET["adre"];
    $telefono = $_GET["tel"];
    $clave = $_GET["cla"];
    $rol = $_GET["rol"];
    

try{
    $sql="UPDATE users SET  name=:nom, adress=:adr, cel=:ce, pass=:cla, id_rol=:ro  WHERE id_usu=:id";
    $resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
    $resultado->execute(array(":id"=>$documento,":nom"=>$nombre,":adr"=>$direccion, ":ce"=>$telefono, ":cla"=>$pass_cifrado, ":ro"=>$rol ));//asigno las variables a los marcadores
    echo '<script>alert("Haz actualizado este Dueño, Yuju!");</script>';
    echo '<script>window.location= "index.php"</script>';
    
    $resultado->closeCursor();
}catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "Ya existe la cédula " . $documento;
}finally{
	$base=null;//vaciar memoria
}


?>
</body>
</html>