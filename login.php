<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="http//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
</head>
<!--  -->
<body class="fondo">
    <div id="main" >           
        <div class="container" id="formLogin">
            <div><img src="img/logo.png" width="200" height="200" /></div>
            <h3 class="login">Iniciar Sesión</h3>
            <br>
            <form method ="POST" name = "formreg" autocomplete = "off" action ="include/inicio.php">
                <div class="form-group">
                    <input type="number" class="form-control" id="idusu" placeholder="Documento" name="id">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pwd" placeholder="Clave" name="pass">
                </div>
                 
                <br>                                
                <input type="submit" class="btn btn-primary" name="ingreso" value="Ingresar">
                <a href="index.html"><input type="button" name="volver" class="btn btn-secondary" id="elimina" value="Volver"></a>                                                                                 
            </form>  
        </div>              
    </div>
</body>
</html>