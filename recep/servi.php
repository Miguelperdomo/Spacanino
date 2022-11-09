<?php
    session_start();
    include("../include/validasession.php");

    require_once("../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];
    $idc=$_SESSION['idc'];

    $sql= "SELECT * FROM roles where id_rol = :ro"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":ro" => $rol));
    $reg=$resultado->fetch(PDO::FETCH_ASSOC);
    $nomrol=$reg["role"];

    $total=$_GET['total'];
    $_SESSION['tot']=$total;
    $tot=$_SESSION['tot'];

    $idcust=$_GET['id'];

    $sql= "SELECT * FROM users where id_usu = :ro"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":ro" => $idc));
    $re=$resultado->fetch(PDO::FETCH_ASSOC);
            
    $na=$re['name'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="http//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/logoprincipal.png">
    <title>Página web</title>
    <style>
        footer{
            background-color: #555;
            color: white;
            padding: 15px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#"><h4>SpaCanino</h4></a>
        <a class="navbar-brand rol" href="#"><?php echo $nomrol ?></a>
        <a class="navbar-brand rol" href="#"><?php echo $name ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
          </div>
        </div>
        <div class="form-inline">            
            <a href="modrecep.php"><button class="btn btn-outline-light my-2 my-sm-0">Devolver</button></a>
        </div>
    </nav>
    <div class="title">
        <h3 class="text-center">Facturar</h3>
    </div>
    <br>
    <div class="col-md-10 col-sm-2 ">
        <div class="row py-3 ">
            <div class="container">
                <div class="col">
                    <div class="col-auto">
                        <div class="col-sm-9" id="title">
                            <h5 class="mb-0 ">Datos Cliente</h5>
                        </div>
                    </div>
                    <br>
                    <div class="col-auto">
                        <div class="input-group col-md-6">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Documento</div>
                            </div>
                            <input type="number" class="form-control" name="doc" readonly value="<?php echo $idc?>">
                        </div>
                    </div>
                    <br>
                    <div class="col-auto">
                        <div class="input-group col-md-6">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Nombre</div>
                            </div>
                            <input type="text" class="form-control" name="nom" readonly  value="<?php echo $na?>" >
                        </div>
                    </div>
                    <br>
                   
                    <div class="col-auto">
                            <div class="col-sm-9" id="title">
                                <h5 class="mb-0 ">Elegir Mascota</h5>
                            </div>
                        </div>
                <br>
                <form method="GET" > 
                    <div class="col-auto">
                        <div class="table-responsive-xxl table-sm">
                            <table class="table table-bordered table-striped ">
                                <thead >
                                    <tr class="table-primary text-center">
                                        <th>Id</th>
                                        <th>Especie</th>
                                        <th>Nombre</th>
                                        <th>Raza</th>
                                        <th>Color</th>
                                        <th colspan="2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center bordered">
                                    <?php
                                    $regis=$base->query("SELECT * from mascotas where id_usu = $idc")->fetchALL(PDO::FETCH_OBJ);

                                    foreach ($regis as $mascotas) : 

                                         $tipo = $mascotas->id_tip_pet;
                                         $sql= "SELECT * FROM tip_pet where id_tip_pet = :id"; 
                                         $resultado=$base->prepare($sql);
                                        $resultado->execute(array(":id"=>$tipo));
                                         $registro=$resultado->fetch(PDO::FETCH_ASSOC);

                                         $ra = $mascotas->id_raza;
                                         $sql= "SELECT * FROM razas where id_raza = :id"; 
                                         $resultado=$base->prepare($sql);
                                         $resultado->execute(array(":id"=>$ra));
                                         $re=$resultado->fetch(PDO::FETCH_ASSOC);

                                         $pet = $mascotas->id_mas;
                                         ?>
                                    <tr class="table-light" >
                                        <td><?php echo $mascotas->id_mas?></td>
                                        <td><?php echo $registro['pet'];?></td>
                                        <td><?php echo $mascotas->namepet?></td>
                                        <td><?php echo $re['raza'];?></td>
                                        <td><?php echo $mascotas->color?></td>
                                        <td>
                                            <a href="fact.php?id=<?php echo $pet?> &total=<?php echo $tot?>"><button type="button" class="btn btn-primary" name="fact">Facturar</button></a>
                                        </td>
                                        <?php
                                         endforeach;
                                         ?>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-auto">
                                <div style='text-align:left'><b>Total a pagar: $ <?php echo " ", $tot;?></b>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <br>   
                <div class="col-auto">
                    <form  name="form1" method="post" action=" ">
                        <div class="container-fluid h-100"> 
                            <a href="del1.php"><input type="button" name="volver" class="btn btn-danger" id="elimina" value="Cancelar"></a>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        </div>     
	</div>
            
    <footer class="containar-fluid text-center ">
        <p>Copyright &copy; SpaCanino <script>document.write(new Date().getFullYear());</script></p>
    </footer>
</body>
</html>