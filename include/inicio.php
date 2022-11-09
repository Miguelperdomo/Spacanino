<?php
    session_start();
    include("../conexion/conexion.php"); 
    
    
    if($_POST["ingreso"]){

        if (empty($_POST['id']) || empty($_POST['pass']))  {
            echo '<script>alert ("Campos vacios. Por favor diligencie todos los campos.");</script>';
            echo '<script>window.location="../login.php"</script>'; 
        }else{

            try{
                $login=htmlentities(addslashes($_POST["id"]));
                $password=htmlentities(addslashes($_POST["pass"]));
                
    
                $sql="SELECT * FROM users WHERE id_usu= :doc";
                $resultado=$base->prepare($sql);
                $resultado->execute(array(":doc"=>$login));//marcador login se corresponde con lo que el usuario introdujo en el cuadro de texto login
                
                if ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

                    if(password_verify($password, $registro['pass'])){
            
                        $_SESSION['doc']=$registro['id_usu'];
                        $_SESSION['rol']=$registro['id_rol'];
                        $_SESSION['name']=$registro['name'];
                    }
                }
                if ($registro){   

                    if($_SESSION ['rol'] == 1){
                        header("Location: ../admin/modadm.php");
                        exit();
                        
                    }elseif ($_SESSION ['rol'] == 2){
                        header("Location: ../recep/modrecep.php");
                        exit();                 
                    }
                }else{
                    echo '<script>alert ("No existe el funcionario. Intente de nuevo");</script>';
                    echo '<script>window.location="../login.php"</script>';
                }
                $resultado->closecursor();
                $base->exec("set character set utf8");
            

            }catch(Exception $e){
                die("error" . $e->getMessage());
        
            }
        }
    }
?>