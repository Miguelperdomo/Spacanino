<?php
    session_start();
    include("../include/validasession.php");

    require_once("../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];

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
    <link rel="icon" href="../img/logoprincipal.png">
    <title>Spacanino</title>
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
            <a href="../include/cerrar.php"><button class="btn btn-outline-light my-2 my-sm-0">Cerrar sesión</button></a>
        </div>
    </nav>
      
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="roles.php"><div class="panle-body"><img src="../img/roles.png" class="opc" alt="Image" ></div>Crear Roles</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="funcionario/user.php"><div class="panle-body"><img src="../img/users.png" class="opc" alt="Image" ></div>Registrar funcionarios</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="dueños/index.php"><div class="panle-body"><img src="../img/dueño.png" class="opc" alt="Image" ></div>Dueños</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="mascotas.php"><div class="panle-body"><img src="../img/pets.png" class="opc" alt="Image" ></div>Mascotas</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="servicios.php"><div class="panle-body"><img src="../img/servicio.png" class="opc" alt="Image" ></div>Servicios</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-primary">
                        <a href="ordenes.php"><div class="panle-body"><img src="../img/orden.png" class="opc" alt="Image" ></div>Ordenes de servicio</a>
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