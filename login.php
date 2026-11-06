<?php
    //Con esto se inicia una seción o reaunudar una seción que ya estaba
    //esto sirve para el momento de moverme de archivos no desaparescan los datos
    //del arreglo (si profe lo copio del otro :v)
    session_start();

    //varia que cambia la parte visual dependiendo de
    //la situación
    $k=0;

    //Esto pues solo se ejecuta al presionar el boton y cuando se cumpla las peticiones
    //del formulario con el metodo POST
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['iniciar'])){

        //Nos traemos la información del formulario
        //y las ponemos en unas variables para depues utilizarlas
        $user=strval($_POST['user']);
        $contra=strval($_POST['contra']);

        //variable que contiene mensajes de error por si no se encuentra la cuenta
        $aviso2="";

        //Variable que guarda la posión del areglo donde se encontro
        $con=0;
        //verificamos que haya alguna cuenta creada en el arreglo
        //si no, no pasa y manda un mensaje de que no hay
        if(isset($_SESSION["registros"])){
            //nos traemos todo el arreglo de la otra pagina
            //con $_SESSION y lo ponemos en una nuva variable
            $registros=$_SESSION["registros"];

            //vemos cuantas cuentas hay
            $cantidad=count($registros['usuario']);

            //Ahora comparamos todas las cuentas que hay con un for
            //si una coincide con el usuario y la contraseña que verificada gracias a una
            //funcion pasa y si hay ninguna que conincidan nos manda un aviso
            for($i=0; $i<$cantidad; $i++){
                if($user==$registros['usuario'][$i] && password_verify($contra,$registros['contrase'][$i])){

                    //se detiene el for, se guarda la posición y se cambia la visilusación
                    $k=1;
                    $con=$i;
                    break;
                }else{
                    //aviso de cuenta no encontrada
                    $aviso2="Su usuario no se encontro, verifique de nuevo o cree una cuenta";
                }
            }
        }else{
            //aviso de que no hay cuentas
            $aviso2="No se a registrado ninguna cuenta, registre una";
        }
    }
?>
<!--Se crea un documento html-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Con esto nos ayuda a ponerle diseño desde un archivo .css-->
    <link rel="stylesheet" href="dis.css" type="text/css">
</head>
<!--Clase para el diseño-->
<body class="body2">
    <!--Este cachito de php nos ayuda a cambiar de visualización dependiendo de la variable
    que tiene mostrando el formulario o el mensaje de que se registro-->
    <?php if($k==0):?>
        <!--Se crea el formulario donde se van a pedir los datos-->
        <form method="POST" action="">
            <div class="titulo">
            <img src="Imagenes/animal2.png" alt="">
            <h1>Inicio de seción</h1>
            <img src="Imagenes/animal.png" alt="">
            </div>
            <!--Si la cuenta no coincide aparece el aviso aquí-->
            <?php if(isset($_POST["iniciar"])){
                echo "<p>".$aviso2."</p>";
            }?>
            
            <label for="user">Ingrese su usuario</label>
            <input type="text" step="any" name="user" id="user" required>
            <br>
            <label for="contra">Ingrese su contraseña</label>
            <input type="text" step="any" name="contra" id="contra" required>
            <br><br>

            <button type="submit" name="iniciar">Iniciar seción</button>
        </form>
        <br>
        <!--Link que nos ayuda a movernos a la otra pagina-->
        <a href="registro.php">¿No tienes cuenta?, Registrate aquí</a>
     <!--Parte visual de que entramos al sistema-->
    <?php elseif($k==1):?>
        <!--Parte de php que nos muestra información de la cuenta y que estamos en el sistema-->
        <?php if(isset($_POST["iniciar"])){
            echo "<p><span>Su contraseña y usuario estan correctos bienvenido al sistema :D </span><br><br>
                    Nombre: ". $registros['nombre'][$con] ."<br>
                    Usuario: ". $user . "<br>
                    Contraseña: ". $registros['contrase'][$con]."</p><br>";
        }?>
        <!--Link que nos ayuda a movernos a la otra pagina-->
        <a href="login.php" class="boton">Regresar al login</a>
    <?php endif;?>
</body>
</html>