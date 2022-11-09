<?php
    require_once("../conexion/conexion.php");

    $id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/487a939f8b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
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
        <a class="navbar-brand" href="#">SpaCanino</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <p>Info del usuario</p>

          </div>
        </div>
        <div class="form-inline">            
            <a href="georden.php"><button class="btn btn-outline-light my-2 my-sm-0">Devolver</button></a>
        </div>
    </nav>
    <div class="container">
        <div>
            <div class="col py-3 ">
                <div class="container">
                    <div id="title">
                        <h5 class="text-center" >Registrar nuevo cliente</h5>
                    </div> 
                    <br>
                    <form id="formulario">
                        <div id="move">
                            
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Documento</div>
                                    </div>
                                    <input type="number" class="form-control" name="id" value="<?php echo $id ?>">
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Nombres</div>
                                    </div>
                                    <input type="text" class="form-control" name="nom" >
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Dirección</div>
                                    </div>
                                    <input type="text" class="form-control" name="adre" >
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Teléfono</div>
                                    </div>
                                    <input type="number" class="form-control" name="tel" >
                                </div>
                            </div>
                            <br>
                            <div id="title">
                                <h5 class="text-center" >Registrar mascota</h5>
                            </div>
                            <?php
                            require_once("../conexion/conexion.php");

                            $regis=$base->query("SELECT * from mascotas")->fetchALL(PDO::FETCH_OBJ);
                            ?>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Especie</div>
                                    </div>
                                    <select class="custom-select" name="tip">
                                    <option value="" >Seleccione</option>
                                    <?php
                                        $sql= "SELECT * FROM tip_pet "; 
                                        $resultado=$base->prepare($sql);
                                        $resultado->execute(array());
                                        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        ?>
                                            <option value="<?php echo $registro['id_tip_pet'];?>"><?php echo $registro['pet'];?></option>
                                            <?php
                                            }
                                            ?>
                                </select>
                                </div>
                            </div>
                            <div class="input-group">
                                
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Nombre</div>
                                    </div>
                                    <input type="text" name="name" class="form-control"></td>
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Raza</div>
                                    </div>
                                    <select class="custom-select" name="raza">
                                        <option value="" >Seleccione</option>
                                        <?php
                                        $sql= "SELECT * FROM razas"; 
                                        $resultado=$base->prepare($sql);
                                        $resultado->execute(array());
                                        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <option value="<?php echo $registro['id_raza'];?>"><?php echo $registro['raza'];?></option>
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
                                        <div class="input-group-text">Color</div>
                                    </div>
                                    <input type="text" name="col" class="form-control" ></td>
                                </div>
                            </div>
                            <br>
                            <div class="col-auto">
                                <div class="input-group col-md-6">
                                    <input type="submit" name="insert" class="btn btn-primary" id="insert" value="Añadir">
                                </div>
                                    <br>
                                <div class="input-group col-md-6">
                                    <a href="georden.php"><input type="button" name="volver" class="btn btn-secondary" id="volver" value="Continuar"></a>
                                </div>
                            </div>  
                        </div>
                        
                    </form>
                    <br>
                    <div class="col-md-12">
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Mascota</th>
                                </tr>
                            </thead>
                            <tbody id="respuesta">
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <br>
                   
                   
                   
                    <!-- 
                    <div class="input-group-prepend">
                        <div class="input-group-text">¿Desea agregar otra mascota?</div>
                        <br>
                        <a href="otropet.php?id="><input type="submit" name="si" class="btn btn-danger" value="Si"></a>
                    </div>
                    <br> -->
                  </div>
            </div>                
        </div>
    </div>
    <footer class="containar-fluid text-center ">
        <p>SpaCanino 2022</p>
    </footer>
    <script src="../js/app.js"></script>
</body>
</html>