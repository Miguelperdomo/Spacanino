<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="../../css/eliminar.css">
	<link rel="icon" href="../../img/logoprincipal.png">
	<link rel="stylesheet" href="../../css/styles.css">
    <title>Spacanino</title>
</head>
<body>
<?php
	 
	$busca=$_GET["id"];


try{
$base=new PDO("mysql:host=localhost;dbname=spacanino", "root", "");//pdo es la clase
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
$base->exec("set character set utf8");
//echo "Conexión exitosa";
$sql="SELECT  * from roles  where  id_rol=:id";//consulta con marcador, el marcador es :codigo

$resultado=$base->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
$resultado->execute(array(":id"=>$busca));

	if($roles=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
		<form action="validareditar.php" method="get">
			<div class="container">

			<h4 class="titulo1">¿Vas a Actualizar este Rol?</h4>
			<br>
				<table class="principal">
					
					<tr>
						<th class="ti">Indentificador</th>
						<td  class="titulo">
							<input type="text" class="in" readonly name="id" value="<?php echo $roles['id_rol']?>">
						</td>
					</tr>
					
					<tr>
						<th class="ti">Nombre Rol</th>
						<td  class="titulo">
							<input type="text" class="in" name="nom" value="<?php echo $roles['role']?>">
						</td>
					</tr>
					
					<tr>
						<td colspan="2" align="center">
							<br>
							<input class="enviar" type="submit" name="edita" id="ingresa" value="Guardar">
						</td>
					</tr>
				</table>
				<br>
				<td colspan="2" align="center">
					<a href="../roles.php"><button type="button" class="enviar2">Cancelar</button></a>
				</td>
		</div>
	</form>

<?php
	}else{
		echo "No existe usuario con cédula $busca";
	}

$resultado->closeCursor();

}catch(Exception $e){
	die("Error: ". $e->GetMessage());

}finally{
	$base=null;//vaciar memoria
}


?>
	<footer>
        <p>Copyright &copy; SpaCanino <script>document.write(new Date().getFullYear());</script></p>
    </footer>
</body>
</html>