<?php
    //Con esto se inicia una seción o reaunudar una seción que ya estaba
    //esto sirve para el momento de moverme de archivos no desaparescan los datos
    //del arreglo
    session_start();

    //esta x solo hace que cambie todo el contenido solo es visual
    $x=0;

    //aqui se hace la seción que seria registros que se estara guardando
    //por que el if y el isset con !, por que si no lo ponemos al entrar 
    //de nuevo al archivo se crearia de nuevo, por lo tanto se borrarian
    //los datos que ya tiene y con este if comprueba si este tiene algo o no
    //si tiene no pasa y se quedan como estaban y si no pues se crea con sus
    //repetivis campos para guardar la información
    if(!isset($_SESSION["registros"])){
        $_SESSION["registros"] = [
            "nombre" => [],
            "usuario" => [],
            "contrase" => []
        ];
    }

    //Esto pues solo se ejecuta al presionar el boton y cuando se cumpla las peticiones
    //del formulario con el metodo POST
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])){

        //Nos traemos la información del formulario
        //y las ponemos en unas variables para depues utilizarlas
        $nombre=strval($_POST['nombre']);
        $usuario=strval($_POST['usuario']);
        $contrase=strval($_POST['cont']);
        $cont_fir=strval($_POST['cont_fir']);

        //esta variable se utiliza para guardar mensajes de error
        $con="";

        //este if nos ayuda a verificar que las contraseñas son iguales, si no se 
        //manda mensaje de error
        if($contrase==$cont_fir){
            //este otro if nos ayuda a verificar a que cumpla la condición que la contraseña debe
            //de tener más o igual a 6 caracteres
            if(strlen($contrase)>=6){
                //En esta parte se va guardando en un arreglo los valores que nos tragimos
                //pero esta vez al guardar la contraseña la encriptamos para que este segura
                $_SESSION["registros"]["nombre"][]=$nombre;
                $_SESSION["registros"]["usuario"][]=$usuario;
                $_SESSION["registros"]["contrase"][]=password_hash($contrase, PASSWORD_DEFAULT);

                //se cambia a una parte visual
                $x=1;
            }else{
                //mensaje de error
                $con="La contaseña debe de tener minimo 6 carcteres";
            }
        }else{
            //mensaje de error
            $con="La contraseña no coinciden";
        }
    }
?>
<!--Se crea un documento html-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Con esto nos ayuda a ponerle diseño desde un archivo .css-->
    <link rel="stylesheet" href="dis.css" type="text/css">
</head>
<!--Clase para el diseño-->
<body class="body1">
    <!--Este cachito de php nos ayuda a cambiar de visualización dependiendo de la variable
    que tiene mostrando el formulario o el mensaje de que se registro-->
    <?php if($x==0):?>
        <!--Se crea el formulario donde se van a pedir los datos-->
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
            <!--Si la contaseña no coincide o no cumple la 
            condición el mensaje de error aparece aquí-->
            <?php if(isset($_POST["registrar"])){
                echo "<p>".$con."</p>";
            }?>

            <button type="submit" name="registrar">Registrar</button>
        </form>
        <br>
        <!--Link que nos ayuda a movernos a la otra pagina-->
        <a href="login.php" class="boton">Regresar al login</a>
    <!--Parte visual de que se registro con exito-->
    <?php elseif($x==1):?>
        <p>Su cuenta se a registrado con exito :D</p>
        <!--Link que nos ayuda a movernos a la otra pagina-->
        <a href="login.php" class="boton">Regresar al login</a>
    <?php endif;?>   
</body>
</html>