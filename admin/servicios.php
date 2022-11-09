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

    $regis = 6;
    /* Checking if the page is set, if it is set, it checks if the page is 1, if it is 1, it redirects
    to the same page, if it is not 1, it sets the page to the page that is set. If the page is not
    set, it sets the page to 1. */
    if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("Location:servicios.php");
        }else{
            $pagina=$_GET["pagina"];
        }
    }else{
        $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
    }
    $empieza=($pagina-1)*$regis;

    $sql= 'SELECT * FROM servicios';
    $senten=$base->prepare($sql);
    $senten->execute();
    $registros=$senten->fetchALL();

    $totalregis=$senten->rowCount();

    $paginas = $totalregis/$regis;
    $paginas = ceil($paginas);

    /* Fetching the data from the database. */
    $regis=$base->query("SELECT * from servicios LIMIT $empieza, $regis")->fetchALL(PDO::FETCH_OBJ);
        
        if(isset($_GET['insert'])){
            $idu=$_GET['id'];
            $serv=$_GET['ser'];
            $precio=$_GET['pre'];
            
            /* Inserting the values into the database. */
            $sql="INSERT INTO servicios (id_ser, servicio, precio) values (:id, :se, :pr)";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":id"=>$idu, ":se"=>$serv,":pr"=>$precio));

            header("Location:servicios.php");
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="http//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/487a939f8b.js" crossorigin="anonymous"></script>
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
    <!-- Encabezado -->
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
            <a href="modadm.php"><button class="btn btn-outline-light my-2 my-sm-0">Devolver</button></a>
        </div>
    </nav>
     <!-- Título -->
    <div class="title">
        <h3 class="text-center">Administrar Servicios</h3>
    </div>
    <!-- Tabla + Formulario -->
    <div class="container">
        <form method="GET" autocomplete="off">                
            <div class="table-responsive-xxl table-sm">
                <table class="table table-bordered table-striped ">
                    <thead >
                        <tr class="table-primary text-center">
                            <th>Id</th>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bordered">
                        <?php
                            /* por cada objeto que hay dentro del array repite el código */
                            foreach ($regis as $servicios): 
                        ?>
                        <tr class="table-light" >
                            <td><?php echo $servicios->id_ser?></td>
                            <td><?php echo $servicios->servicio?></td>
                            <td><?php echo $servicios->precio?></td>
							<td>
                                <a href="servicios/editar.php?id=<?php echo $servicios->id_ser?> & ser=<?php echo $servicios->servicio?>  & pre=<?php echo $servicios->precio?>"><button type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            </td>
                            <td>
                                <a href="servicios/eliminar.php?id=<?php echo $servicios->id_ser?>"><button type="button" class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash-can"></i></button></a>
                            </td>
                        <?php
                            endforeach;
                        ?>
                            </tr>
                        <!-- Paginación -->
                        <tr class="table-light" >
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php echo $pagina<=1? 'disabled' : '' ?>">
                                            <a class="page-link" href="servicios.php?pagina=<?php echo $pagina-1 ?>">Anterior</a>
                                    </li>
                                    <?php
                                        for($i=0; $i<$paginas; $i++):?>
                                            <li class="page-item <?php echo $pagina==$i+1? 'active': ''?>">
                                                <a class="page-link" 
                                                href="servicios.php?pagina=<?php echo $i+1?>">
                                            <?php echo $i+1?></a>
                                            </li>
                                            <?php endfor?>
                                    <li class="page-item <?php  echo $pagina>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="servicios.php?pagina=<?php echo $pagina+1 ?>">Siguiente</a></li>
                                </ul>
                            </nav>
                        </tr>
                        <tr class="table-light" >
                            <td><input type="number" name="id" class="form-control" placeholder="Consecutivo"></td>
                            <td><input type="text" name="ser" class="form-control" placeholder="Nombre"></td>
                            <td><input type="number" name="pre" class="form-control" placeholder="Precio"></td>
                            <td colspan="5" align="center"><input  type="submit" class="btn btn-primary" name="insert" value="Insertar" ></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!-- Pie de página -->
    <footer class="containar-fluid text-center ">
        <p>Copyright &copy; SpaCanino <script>document.write(new Date().getFullYear());</script></p>
    </footer>
</body>
</html>