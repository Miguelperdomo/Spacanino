<?php
    session_start();
    include("../include/validasession.php");

    require_once("../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];
    
    $idcust=$_SESSION['idc'];
    $_SESSION['idc']=$idcust;
    $idc=$_SESSION['idc'];

    $sql= "SELECT * FROM roles where id_rol = :ro"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":ro" => $rol));
    $reg=$resultado->fetch(PDO::FETCH_ASSOC);
    $nomrol=$reg["role"];

    $sql= "SELECT * FROM users where id_usu = :ro"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":ro" => $idcust));
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
        <a class="navbar-brand" href="#"><h3>SpaCanino</h3></a>
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
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" autocomplete="off">
        <?php
		require("../conexion/conexion.php");
		
		if(!isset($_GET['agr'])){

			$idcust=$_GET['id'];
            $_SESSION['idc']=$idcust;
            $idc=$_SESSION['idc'];

            $sql= "SELECT * FROM users where id_usu = :ro"; 
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":ro" => $idcust));
            $re=$resultado->fetch(PDO::FETCH_ASSOC);
            
            $na=$re['name'];
            			
		}else{

			//$idcust=$_GET['id'];
            $_SESSION['idc']=$idcust;
            $idc=$_SESSION['idc'];

            $sql= "SELECT * FROM users where id_usu = :ro"; 
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":ro" => $idcust));
            $re=$resultado->fetch(PDO::FETCH_ASSOC);
            
            $na=$re['name'];			
		}	
		?>
        <!-- Título -->
        <div class="title">
            <h3 class="text-center">Generar orden de servicio</h3>
        </div>
            <section class="container-full">
                <div class="row" id="full-page">
                    <!-- Content -->
                    <div class="col-md-10 col-sm-2 ">
                        <div class="row py-3 ">
                            <div class="container">         
                                    <div class="col-auto">
                                        <div class="input-group col-md-6">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">Genera</div>
                                            </div>
                                            <input type="text" class="form-control" readonly  value="<?php echo $name ?>" >
                                        </div>
                                    </div>
                                    <br>
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
                                            <input type="number" class="form-control" name="doc" readonly value="<?php echo $idcust?>">
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
                                            <h5 class="mb-0 ">Elegir</h5>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-auto">
                                        <div class="input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Auxiliar Vet.</div>
                                            </div>
                                            <select class="custom-select" name="aux">
                                                <option value="" >Seleccione</option>
                                                <?php
                                                    $sql= "SELECT * FROM auxvet"; 
                                                    $resultado=$base->prepare($sql);
                                                    $resultado->execute(array());
                                                    while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <option value="<?php echo $registro['id_aux'];?>"><?php echo $registro['name'];?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-auto">
                                        <div class="input-group col-md-6">
                                            <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">Servicio</label>
                                            </div>
                                            <div class="input-group-prepend">
                                                <select class="custom-select" name="serv">
                                                    <option value="" >Seleccione</option>
                                                    <?php
                                                        $sql= "SELECT * FROM servicios"; 
                                                        $resultado=$base->prepare($sql);
                                                        $resultado->execute(array());
                                                        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $registro['id_ser'];?>"><?php echo $registro['servicio'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="col-auto">
                                                <div class="input-group col-md-6 align-items-right">
                                                    <input type="submit" name="agr" class="btn btn-primary" id="agregar" value="Agregar">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                                                   
                                        <input type="hidden" name="ids" value="<?php echo $registro['id_ser'];?>">
                                        <?php
                                        if(isset($_GET['agr'])){ 

                                            $ids=$_GET['serv'];
                                            $aux=$_GET['aux'];

                                            $sql1="INSERT INTO deta_orden (id_ser, id_usu, id_aux) values (:se, :us, :au)";
                                            $result=$base->prepare($sql1);
                                            $result->execute(array(":se"=>$ids, ":us"=>$doc, ":au"=>$aux));
                                        }
                                        $registros=$base->query("SELECT * from deta_orden")->fetchALL(PDO::FETCH_OBJ);
                                        ?> 
                                        <br>
                                            <table class="table table-bordered border-primary">
                                                <thead class="table-primary text-center">
                                                    <th>Id</th>
                                                    <th>Servicio</th>
                                                    <th>Precio</th>
                                                    <th>Auxiliar</th>
                                                </thead>
                                                <?php
                                                
                                                $total=0;
                                                foreach ($registros as $deta_orden) : 
                                                
                                                ?>                                      
                                                <tbody class="text-center">                                      
                                                        
                                                    <?php 
                                                    $codser=$deta_orden->id_ser;
                                                    $sql="SELECT servicio, precio from servicios WHERE id_ser = :co";
                                                    $resultado=$base->prepare($sql);
                                                    $resultado->execute(array(":co"=>$codser));
                                                    $regis=$resultado->fetch(PDO::FETCH_ASSOC);
                                                    $total = $total + $regis['precio'];

                                                    $auxv=$deta_orden->id_aux;
                                                    $sql= "SELECT * FROM auxvet where id_aux = :ro"; 
                                                    $resultado=$base->prepare($sql);
                                                    $resultado->execute(array(":ro" => $auxv));
                                                    $re=$resultado->fetch(PDO::FETCH_ASSOC);
                                                    ?>

                                                    <td><?php echo $deta_orden->id_ser?></td>                                               
                                                    <td><?php echo $regis['servicio'];?></td>
                                                    <td><?php echo $regis['precio'];?></td>
                                                    <td><?php echo $re['name'];?></td>

                                                    <?php $iddeta=$deta_orden->id_ser; ?>                                               
                                                    
                                                </tbody>
                                                <?php
                                                endforeach;
                                                ?>
                                            </table>
                                          
                                        <br>
                                        <h5>Total a pagar: $ <?php echo $total;?></h5>
                                        <form  name="form1" method="post" action=" ">
                                            <div class="container-fluid h-100"> 
                                                <div class="row w-100 align-items-center">
                                                    <div class="col text-center">
                                                        <a href="servi.php?id=<?php echo $idcust?> & total=<?php echo $total?> & iduser=<?php echo $doc?>"?><input type="button" class="btn btn-primary" name="fact" value="Facturar"></input></a>
                                                        <a href="del1.php"><input type="button" name="volver" class="btn btn-danger" id="elimina" value="Cancelar"></a>
                                                    </div>	
                                                </div>
                                            </div>
                                        </form>                                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </form>
     
    
    <footer class="containar-fluid text-center ">
        <p>Copyright &copy; SpaCanino <script>document.write(new Date().getFullYear());</script></p>
    </footer>
</body>
</html>