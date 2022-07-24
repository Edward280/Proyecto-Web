<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logeando</title>
    <link  type="text/css" rel="stylesheet" href="css/master.css">
</head>
<body>
    <div class="login-box">
    <img  class="avatar" src="Imagenes/DesarrolloICO.jpg" alt="Logo de Fast"> 
    <h1>Ingresar</h1> 
    <form  method="POST">  
        <!--USER NAME-->
        <label for="username" >Usuario</label>
        <input type="text"  name="usuario" placeholder="Ingrese Usuario"> <!--- USUARIO INPUT  -->
        <label for="password" >Contraseña</label>
        <input type="password"  name="password" placeholder="Ingrese Contraseña"> <!-- CONTRSEÑA INPUT -->
        <input type="submit" value="Ingresar" name="Login"> <!-- BOTON INGRESAR -->
        <a href="./Formulario_Registrar.html">
            <br><center><br>Eres Nuevo? <br></center></a> <!---LLAMAMOS  Y PONEMOS LINK DEL FORMULARIO -->
    </form>
    </div>
<?php
   include("Inicio_Sesion.php");
?>
</body>
</html>