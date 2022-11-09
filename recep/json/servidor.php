<?php
    require_once("../../conexion/conexion.php");

       
            $doc=$_POST['id'];
            $rol= 4;
            $nom=$_POST['nom'];
            $adre=$_POST['adre'];
            $tel=$_POST['tel'];
    
            $idtip=$_POST['tip'];
            $nombre=$_POST['name'];
            $raza=$_POST['raza'];
            $color=$_POST['col'];

            $sql="INSERT INTO users (id_usu, id_rol, name, adress, cel) values (:doc, :ro, :nom, :ad, :tel)";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":doc"=>$doc, ":ro"=>$rol, ":nom"=>$nom, ":ad"=>$adre, ":tel"=>$tel ));
            
            
            $sql="INSERT INTO mascotas (id_tip_pet, namepet, id_raza, color, id_usu) values (:id_tip, :na, :ra, :col, :usu)";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":id_tip"=>$idtip,":na"=>$nombre, ":ra"=>$raza, ":col"=>$color, ":usu"=>$doc));

            $mensaje = "<th>$doc<th>$nom<th>$adre<th>$tel<th>$nombre";
            
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        
?>