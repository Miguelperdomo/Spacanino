<?php
    session_start();
    include("../include/validasession.php");

    require_once("../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];

    //consuta el último número de matricula generado
    $sql = "SELECT MAX(id_ord) as last_id FROM orden";
    $resultado=$base->prepare($sql);
    $resultado->execute(array());
    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
    $fact=$registro['last_id'];

    $sql="SELECT  * from orden where id_ord=:nm";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":nm"=>$fact));
    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
    $idusu=$registro['id_usu'];
    $date=$registro['fech'];
    $total=$registro['valor_tot'];
    $pet=$registro['id_mas'];

    $sql="SELECT * from mascotas where id_mas=:id";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":id"=>$pet));
    $reg=$resultado->fetch(PDO::FETCH_ASSOC);

    $ti=$reg['id_tip_pet'];
    $namepet=$reg['namepet'];
    $ra=$reg['id_raza'];
    $dueno=$reg['id_usu'];

    $sql= "SELECT * FROM razas where id_raza = :id"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":id"=>$ra));
    $re=$resultado->fetch(PDO::FETCH_ASSOC);
    $raza=$re['raza'];

    $sql= "SELECT * FROM tip_pet where id_tip_pet = :id"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":id"=>$ti));
    $regi=$resultado->fetch(PDO::FETCH_ASSOC);
    $tipo=$regi['pet'];

    $sql="SELECT * from users where id_usu=:idu";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":idu"=>$dueno));
    $regis=$resultado->fetch(PDO::FETCH_ASSOC);
    $name =$regis['name'];

    $sql="SELECT * from users where id_usu=:idu";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":idu"=>$idusu));
    $regi=$resultado->fetch(PDO::FETCH_ASSOC);
    $nausu =$regi['name'];

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Desprendible</title>
</head>
<body>    
    <div class="container">
        <div class="card">
            <div class="card-body">
                <img src="../img/logo.png" alt="..." width="150" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <h3 class="text-center">Factura</h3>
                <br>
                <h6 class="text-right"><b>N° <?php echo $fact?></b></h6>
                <h6 class="text-right"><b>Fecha: <?php echo $date ?></b></h6>
                <p><b>Generado por:   </b><?php echo $nausu?></p>
                <div class="card cont">
                    
                    <h5 class="text-center" >Cliente</h5>
                    <table class="table text-center">
                            <tr>
                                <td colspan="2">Identificación: <?php echo $dueno?></td>
                            </tr>
                            <tr>
                                <td>Nombre: <?php echo $name?></td>
                            </tr>
                    </table>
                    
                    <table class="table">
                        
                            <tr>
                                <td><h5>Mascota</h5></td>
                            </tr>
                            <tr>
                                <td>Especie: <?php echo $tipo?></td>
                            </tr>
                            <tr>
                                <td>Nombre: <?php echo $namepet?></td>
                            </tr>
                            <tr>
                                <td>Raza: <?php echo $raza?></td>
                            </tr>
                     </table>
                </div>
                <div class="card cont2">
                    <h5 class="text-center">Servicios prestados</h5>
                    <br>
                   
                                    <table class="table text-center">
                                        <thead class="table-primary">
                                            <th>Código</th>
                                            <th>Servicio</th>
                                            <th>Precio Unt.</th>
                                            <th>Auxiliar vet.</th>	
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php
                                            //consulta a la tabla detallefactura
                                                $regisdet=$base->query("SELECT * from detalle where id_ord=$fact ")->fetchALL(PDO::FETCH_OBJ);
                                                $cuenta=0;
                                                foreach ($regisdet as $deta_orden) :?> 
                                               
                                                <?php
                                                $serord=$deta_orden->id_ser;    
                                                $sql="SELECT servicio, precio  from servicios where id_ser=:se";
                                                $resultado=$base->prepare($sql);
                                                $resultado->execute(array(":se"=>$serord));
                                                $regist=$resultado->fetch(PDO::FETCH_ASSOC);

                                                $auxv=$deta_orden->id_aux;
                                                $sql= "SELECT * FROM auxvet where id_aux = :ro"; 
                                                $resultado=$base->prepare($sql);
                                                $resultado->execute(array(":ro" => $auxv));
                                                $re=$resultado->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                                <td><?php echo $serord?></td>                                               
                                                <td><?php echo $regist['servicio'];?></td>
                                                <td><?php echo $regist['precio'];?></td>
                                                <td><?php echo $re['name'];?></td>
                                            </tr>
                                            
                                            <?php
                                             
                                            endforeach;
                                       
                                                ?>
                                        </tbody>                                   
                                    </table>
                </div>
                <br>
                <div class="card cont2 text-right">
                    <h5 class="text-center">Total a pagar: <?php echo $total?></h5>
                </div>
            </div>
            <br>
            <div align="center" class=" ">
                <input  class="btn btn-danger" type='button' onclick='window.print();' value='PDF'>
                <a href="modrecep.php"><input type="button" name="volver" class="btn btn-secondary" value="Volver"></a>
            </div>
            
        </div>
        <br>
    </div>
</body>
</html>