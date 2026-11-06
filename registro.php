<?php
    session_start();
    $x=0;
    if(!isset($_SESSION["registros"])){
        $_SESSION["registros"] = [
            "nombre" => [],
            "usuario" => [],
            "contrase" => []
        ];
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])){
        $nombre=strval($_POST['nombre']);
        $usuario=strval($_POST['usuario']);
        $contrase=strval($_POST['cont']);
        $cont_fir=strval($_POST['cont_fir']);

        $con="";

        if($contrase==$cont_fir){
            if(strlen($contrase)>=6){
                $_SESSION["registros"]["nombre"][]=$nombre;
                $_SESSION["registros"]["usuario"][]=$usuario;
                $_SESSION["registros"]["contrase"][]=password_hash($contrase, PASSWORD_DEFAULT);
                $x=1;
            }else{
                $con="La contaseña debe de tener minimo 6 carcteres";
            }
        }else{
            $con="La contraseña no coinciden";
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="dis.css" type="text/css">
</head>
<body class="body1">
    <?php if($x==0):?>
        <form method="POST" action="">
            <div class="titulo">
            <img src="Imagenes/animal2.png" alt="">
            <h1>Ingrese los datos que se le indican</h1>
            <img src="Imagenes/animal.png" alt="">
            </div>
            <br><br>
            <label for="nombre">Ingrese su nombre:</label>
            <input type="text" step="any" name="nombre" id="nombre" required>
            <label for="usuario">Ingrese su usuario:</label>
            <input type="text" step="any" name="usuario" id="usuario" required>
            <br><br>

            <label for="cont">Ingrese su contraseña:</label>
            <input type="text" step="any" name="cont" id="cont" required>
            <label for="cont_fir">Confirme su contraseña:</label>
            <input type="text" step="any" name="cont_fir" id="cont_fir" required>
            <br>
            <?php if(isset($_POST["registrar"])){
                echo "<p>".$con."</p>";
            }?>

            <br><br>
            <button type="submit" name="registrar">Registrar</button>
        </form>
        <br>
        <a href="login.php" class="boton">Regresar al login</a>
    <?php elseif($x==1):?>
        <div class="exito">
        <p>Su cuenta se a registrado con exito :D</p>
        <a href="login.php" class="boton">Regresar al login</a>
        </div>
    <?php endif;?>   
</body>
</html>