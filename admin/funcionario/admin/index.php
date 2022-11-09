<?php
    session_start();
    include("../../../include/validasession.php");

    require_once("../../../conexion/conexion.php");

    $doc=$_SESSION['doc'];
    $rol=$_SESSION['rol'];
    $name=$_SESSION['name'];

    $sql= "SELECT * FROM roles where id_rol = :ro"; 
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":ro" => $rol));
    $reg=$resultado->fetch(PDO::FETCH_ASSOC);

    $nomrol=$reg["role"];

    $regis = 6;
    if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
            header("Location:index.php");
        }else{
            $pagina=$_GET["pagina"];
        }
    }else{
        $pagina=1;//muestra página en la que estamos cuando se carga por primera vez
    }
    $empieza=($pagina-1)*$regis;

    $sql= 'SELECT * FROM users';
    $senten=$base->prepare($sql);
    $senten->execute();
    $registros=$senten->fetchALL();

    $totalregis=$senten->rowCount();

    $paginas = $totalregis/$regis;
    $paginas = ceil($paginas);

    
    $regis=$base->query("SELECT * from users WHERE id_rol = 1 LIMIT $empieza, $regis")->fetchALL(PDO::FETCH_OBJ);
        
        if(isset($_GET['insert'])){
            $idu=$_GET['id'];
			$rol=$_GET['rol'];
			$name=$_GET['nom'];
            $direccion=$_GET['dire'];
            $tel=$_GET['tel'];
			$clave=$_GET['cla'];
			$pass_cifrado=password_hash($clave,PASSWORD_DEFAULT,array("cost"=>12));//encripta lo que hay en la variable password
            
           
            $sql="INSERT INTO users (id_usu, id_rol, name, adress, cel, pass) values (:id, :ro, :nam, :adr, :cel, :pas)";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":id"=>$idu, ":ro"=>$rol, ":nam"=>$name, ":adr"=>$direccion,":cel"=>$tel, ":pas"=>$pass_cifrado));

            header("Location:index.php");
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
    <link rel="stylesheet" href="../../../css/styles.css">
    <link rel="icon" href="../../img/logoprincipal.png">
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
            <a href="../user.php"><button class="btn btn-outline-light my-2 my-sm-0">Devolver</button></a>
        </div>
    </nav>
     <!-- Título -->
    
    <div class="title">
        <h3 class="text-center">Registro Administradores</h3>
    </div>
     <!-- Tabla + Formulario -->
    <div class="container">
        <form method="GET" autocomplete="off">                
            <div class="table-responsive-xxl table-sm">
                <table class="table table-bordered table-striped ">
                    <thead >
                        <tr class="table-primary text-center">
                            <th>Documento</th>
                            <th>Nombre Completo</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Clave</th>
                            <th>Rol</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bordered">
                        <?php
                            /* por cada objeto que hay dentro del array repite el código */
                            foreach ($regis as $administrador) : 

                                $rol = $administrador->id_rol;
                                $sql= "SELECT * FROM roles where id_rol = :id"; 
                                $resultado=$base->prepare($sql);
                                $resultado->execute(array(":id"=>$rol));
                                $regi=$resultado->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr class="table-light" >
                            <td><?php echo $administrador->id_usu?></td>
                            <td><?php echo $administrador->name?></td>
							<td><?php echo $administrador->adress?></td>
							<td><?php echo $administrador->cel?></td>
							<td>XXXX</td>
                            <td><?php echo $regi['role'];?></td>
							<td>
                                <a href="editar.php?id=<?php echo $administrador->id_usu?> & nom=<?php echo $administrador->name?>  & dir=<?php echo $administrador->adress?>"><button type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                            </td>
                            <td>
                                <a href="eliminar.php?id=<?php echo $administrador->id_usu?>"><button type="button" class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash-can"></i></button></a>
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
                                            <a class="page-link" href="index.php?pagina=<?php echo $pagina-1 ?>">Anterior</a>
                                    </li>
                                    <?php
                                        for($i=0; $i<$paginas; $i++):?>
                                            <li class="page-item <?php echo $pagina==$i+1? 'active': ''?>">
                                                <a class="page-link" 
                                                href="index.php?pagina=<?php echo $i+1?>">
                                            <?php echo $i+1?></a>
                                            </li>
                                            <?php endfor?>
                                    <li class="page-item <?php  echo $pagina>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="index.php?pagina=<?php echo $pagina+1 ?>">Siguiente</a></li>
                                </ul>
                            </nav>
                        </tr>
                        <tr class="table-light" >
                            <td><input type="number" name="id" class="form-control" placeholder="Documento"></td>
                            <td><input type="text" name="nom" class="form-control" placeholder="Nombre"></td>
                            <td><input type="text" name="dire" class="form-control" placeholder="Dirección"></td>
                            <td><input type="number" name="tel" class="form-control" placeholder="Teléfono"></td>
                            <td><input type="password" name="cla" class="form-control" placeholder="Clave"></td>
                            <td>
                                <div class="input-group">
                                    <select class="custom-select" name="rol">
                                        <option value="" >Seleccione</option>
                                        <?php
                                        $sql= "SELECT * FROM roles where id_rol = 1"; 
                                        $resultado=$base->prepare($sql);
                                        $resultado->execute(array());
                                        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        ?>
                                            <option value="<?php echo $registro['id_rol'];?>"><?php echo $registro['role'];?></option>
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </td>
                            <td colspan="5" align="center"><input  type="submit" class="btn btn-primary" name="insert" value="Insertar" ></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!-- Pie de página -->
    <footer class="text-center ">
        <p>Copyright &copy; SpaCanino <script>document.write(new Date().getFullYear());</script></p>
    </footer>
</body>
</html>