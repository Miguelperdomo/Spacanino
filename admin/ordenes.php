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
    to the sa me page, if it is not 1, it sets the page to the page that is set. If the page is not
    set, it sets the page to 1. */
    if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("Location:ordenes.php");
        }else{
            $pagina=$_GET["pagina"];
        }
    }else{
        $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
    }
    $empieza=($pagina-1)*$regis;

    $sql= 'SELECT * FROM orden';
    $senten=$base->prepare($sql);
    $senten->execute();
    $registros=$senten->fetchALL();

    $totalregis=$senten->rowCount();

    $paginas = $totalregis/$regis;
    $paginas = ceil($paginas);

    /* Fetching the data from the database. */
    $regis=$base->query("SELECT * from orden LIMIT $empieza, $regis")->fetchALL(PDO::FETCH_OBJ);
    
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
        <h3 class="text-center">Administrar ordenes</h3>
    </div>
     <!-- Tabla + Formulario -->
    <div class="container">
        <form method="GET" autocomplete="off">                
            <div class="table-responsive-xxl table-sm">
                <table class="table table-bordered table-striped ">
                    <thead >
                        <tr class="table-primary text-center">
                            <th>Num. Orden</th>
                            <th>Fecha</th>
                            <th>Doc. Dueño</th>
                            <th>Nombre dueño</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bordered">
                        <?php
                            /* por cada objeto que hay dentro del array repite el código */
                            foreach ($regis as $orden):
                                
                                $id=$orden->id_mas;

                                $sql="SELECT * FROM mascotas WHERE id_mas=:id";
                                $resultado=$base->prepare($sql);
                                $resultado->execute(array(":id"=>$id));
                                $regis=$resultado->fetch(PDO::FETCH_ASSOC);
                                $dueño = $regis['id_usu'];

                                $sql="SELECT * FROM users WHERE id_usu=:id";
                                $resultado=$base->prepare($sql);
                                $resultado->execute(array(":id"=>$dueño));
                                $reg=$resultado->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr class="table-light" >
                            <td><?php echo $orden->id_ord?></td>
                            <td><?php echo $orden->fech?></td>
                            <td><?php echo $reg['id_usu']?></td>
                            <td><?php echo $reg['name']?></td>
							<td>
                                <a href="ordenes/verords.php?id=<?php echo $orden->id_ord?>"><button type="button" class="btn btn-primary" >VER</button></a>
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
                                            <a class="page-link" href="ordenes.php?pagina=<?php echo $pagina-1 ?>">Anterior</a>
                                    </li>
                                    <?php
                                        for($i=0; $i<$paginas; $i++):?>
                                            <li class="page-item <?php echo $pagina==$i+1? 'active': ''?>">
                                                <a class="page-link" 
                                                href="ordenes.php?pagina=<?php echo $i+1?>">
                                            <?php echo $i+1?></a>
                                            </li>
                                            <?php endfor?>
                                    <li class="page-item <?php  echo $pagina>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="ordenes.php?pagina=<?php echo $pagina+1 ?>">Siguiente</a></li>
                                </ul>
                            </nav>
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
<script src=""></script>
</html>