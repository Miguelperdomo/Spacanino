<?php
    session_start();
    include("../../include/validasession.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	$sql="SELECT  * from mascotas  where id_mas=:id";//consulta con marcador, el marcador es :codigo

	$resultado=$base->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
	$resultado->execute(array(":id"=>$busca));

		if($registr=$resultado->fetch(PDO::FETCH_ASSOC)){

			$tipo = $registr['id_tip_pet'];
            $sql= "SELECT * FROM tip_pet where id_tip_pet = :id"; 
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":id"=>$tipo));
            $registro=$resultado->fetch(PDO::FETCH_ASSOC);

            $ra = $registr['id_raza'];
            $sql= "SELECT * FROM razas where id_raza = :id"; 
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":id"=>$ra));
            $re=$resultado->fetch(PDO::FETCH_ASSOC);

            $usu = $registr['id_usu'];
            $sql= "SELECT * FROM users where id_usu = :id"; 
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":id"=>$usu));
            $reg=$resultado->fetch(PDO::FETCH_ASSOC);
			
			?>
	<form action="validareditar.php" method="get">
		<div class="container">

			<h4 class="titulo1">¿Vas a Actualizar esta Mascota?</h4>
			<br>
			<table class="principal">
				<tr>
					<th class="ti">Id</th>
					<td  class="titulo">
						<input type="text" class="in" name="id" value="<?php echo $registr['id_mas']?>">
					</td>
				</tr>

				<tr>
					<th class="ti">Tipo de mascota</th>
					<td  class="titulo">
						<input type="text" class="in" name="tp" value="<?php echo $registro['pet'] ?>">
					</td>
				</tr>
				
				<tr>
					<th class="ti">Nombre</th>
					<td  class="titulo">
						<input type="text" class="in" name="nom" value="<?php echo $registr['namepet']?>">
					</td>
				</tr>
				
				<tr>
					<th class="ti">Raza</th>
					<td  class="titulo">
						<input type="text" class="in" name="corr" value="<?php echo $re['raza']?>">
					</td>
				</tr>
							
				<tr>
					<th class="ti">Color</th>
					<td  class="titulo">
						<input type="text" class="in"  name="usu" value="<?php echo $registr['color']?>">
					</td>
				</tr>	
				
				<tr>
					<th class="ti">Dueño</th>
					<td  class="titulo">
						<input type="text" class="in" name="usua" value="<?php echo $reg['name']?>">
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
					<a href="../mascotas.php"><button type="button" class="enviar2">Cancelar</button></a>
				</td>
				</div>
		</form>

	<?php
		}else{
			echo "No existe esta mascota $busca";
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