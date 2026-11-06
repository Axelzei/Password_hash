<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['iniciar'])){
        $user=strval($_POST['user']);
        $contra=strval($_POST['contra']);
        $registros=$_SESSION["registros"];

        $cantidad=count($registros['usuario']);

        $aviso1="";
        $aviso2="";

        if(isset($registros)){
            for($i=0; $i<$cantidad; $i++){
                if($user==$registros['usuario'][$i] && password_verify($registros['contrase'][$i])){
                    $aviso1="Su contraseña y usuario estan correctos bienvenido al sistema <br>
                    Nombre: ". $registros['nombre'][$i] ."<br>
                    Usuario: ". $user . "<br>
                    Contraseña: ". $registros['contrase'][$i];
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
    <form method="POST" action="">
        <h1>Inicio de seción</h1>
        <?php if(isset($_POST["iniciar"])){
            echo $aviso1;
        }?>
        <label for="user">Ingrese su usuario</label>
        <input type="text" step="any" name="user" id="user" required>
        <label for="contra">Ingrese su contraseña</label>
        <input type="text" step="any" name="contra" id="contra" required>

        <button type="submit" name="iniciar">Iniciar seción</button>
    </form>

    <a href="registro.php">¿No tienes cuenta?, Registrate aquí</a>
</body>
</html>