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
</head>
<body>
    <?php if($x==0):?>
        <form method="POST" action="">
            <h1>Ingrese los datos que se le indican</h1>
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
                echo $con;
            }?>

            <br><br>
            <button type="submit" name="registrar">Registrar</button>
            <a href="login.php">Regresar al login</a>
        </form>
    <?php elseif($x==1):?>
        <p>Su cuenta se a registrado con exito</p>
        <a href="login.php">Regresar al login</a>
    <?php endif;?>   
</body>
</html>