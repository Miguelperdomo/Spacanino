<?php
    session_start();
    include("../include/validasession.php");

    require_once("../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];

    $id=$_GET['id'];

    $sql= "SELECT * FROM users where id_usu = :us"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":us" => $id));
    $reg1=$resultado->fetch(PDO::FETCH_ASSOC);

    $dueno=$reg1['id_usu'];
    $na=$reg1['name'];
    
    $sql= "SELECT * FROM roles where id_rol = :ro"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":ro" => $rol));
    $reg=$resultado->fetch(PDO::FETCH_ASSOC);

    $nomrol=$reg["role"];
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
     <!-- Título -->
    <div class="title">
        <h3 class="text-center">Generar orden de servicio</h3>
    </div>
    <!-- Formulario -->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">

        <section class="container-full">

            <div class="row" id="full-page">
                <!-- Content -->
                <div class="col-md-10 col-sm-2 ">
                    <div class="row py-3 ">
                        
                        <div class="container">                     
                            <form method="GET" >
                            
                                <div class="col-auto">
                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Genera</div>
                                        </div>
                                        <input type="text" class="form-control" name="ape" readonly  value="<?php echo $name ?>" >
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
                                        <input type="number" class="form-control" name="id" readonly value="<?php echo $dueno?>">
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
                                    <div class="input-group col-md-6 align-items-right">
                                    <a href="detalle2.php?id=<?php echo $dueno;?>"><input type="button" name="volver" class="btn btn-secondary" id="volver" value="Agregar"></a>
                                    </div>
                                </div>
                            </form>
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