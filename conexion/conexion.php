<?php

try{
	$base = new PDO('mysql:host=localhost;dbname=spacanino', 'root', '');
	
  
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("set names utf8;");

}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}
?>