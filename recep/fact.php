<?php
    session_start();
    include("../include/validasession.php");

    require_once("../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];
    $idc=$_SESSION['idc'];
    $tot=$_SESSION['tot'];
    
    $pet=$_GET['id'];
                                    
    $sql="INSERT INTO orden (id_mas, valor_tot, id_usu) values (:im, :vt, :us)";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":im"=>$pet, ":vt"=>$tot, ":us"=>$doc));

    //consultar el número de factura generada
    $sql = "SELECT MAX(id_ord) as last_id FROM orden";
    $resultado=$base->prepare($sql);
    $resultado->execute(array());
    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
    $invo=$registro['last_id'];

    //ingresar el número de factura en la tabla detalle
    $sql="UPDATE deta_orden SET id_ord='$invo'";
    $resultado=$base->prepare($sql); 
    $resultado->execute(array());

    $sql="INSERT into detalle (id_ord, id_ser, id_usu, id_aux) select id_ord, id_ser, id_usu, id_aux from deta_orden where id_usu=$doc";
    $resultado=$base->prepare($sql);
    $resultado->execute(array());

    //borra todos los regisros de la tabla temp
    $sql="DELETE from deta_orden";
    $resultado=$base->prepare($sql); 
    $resultado->execute(array());

    header('Location:recibo.php');
    
    ?>
