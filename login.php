<?php
    session_start();

    $k=0;

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['iniciar'])){
        $user=strval($_POST['user']);
        $contra=strval($_POST['contra']);

        $aviso1="";
        $aviso2="";

        $con=0;
        if(isset($_SESSION["registros"])){
            $registros=$_SESSION["registros"];
            $cantidad=count($registros['usuario']);

            for($i=0; $i<$cantidad; $i++){
                if($user==$registros['usuario'][$i] && password_verify($contra,$registros['contrase'][$i])){
                    $k=1;
                    $con=$i;
                    break;
                }else{
                    $aviso2="Su usuario no se encontro, verifique de nuevo o cree una cuenta";
                }
            }
        }else{
            $aviso2="No se a registrado ninguna cuenta, registre una";
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if($k==0):?>
        <form method="POST" action="">
            <h1>Inicio de seción</h1>
            <?php if(isset($_POST["iniciar"])){
                echo "<p>".$aviso2."</p>";
            }?>
            
            <label for="user">Ingrese su usuario</label>
            <input type="text" step="any" name="user" id="user" required>
            <label for="contra">Ingrese su contraseña</label>
            <input type="text" step="any" name="contra" id="contra" required>

            <button type="submit" name="iniciar">Iniciar seción</button>
        </form>

        <a href="registro.php">¿No tienes cuenta?, Registrate aquí</a>
    <?php elseif($k==1):?>
        <?php if(isset($_POST["iniciar"])){
            echo "<p>Su contraseña y usuario estan correctos bienvenido al sistema <br>
                    Nombre: ". $registros['nombre'][$con] ."<br>
                    Usuario: ". $user . "<br>
                    Contraseña: ". $registros['contrase'][$con]."</p><br>";
        }?>
        <a href="login.php">Regresar al login</a>
    <?php endif;?>
</body>
</html>