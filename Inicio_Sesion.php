<?php 
$conexion=mysqli_connect("localhost","root","","tiendaonline"); //HACEMOS LA CONEXION A LA BASE DE DATOS
if(isset($_POST['Login'])){ //ISSET NOS COMPRUEBA SI SE PRESIONO UN BOTON Y COMPRUEBA EL NOMBRE DEL BOTON
  if(!$conexion){
    die("NO HAY CONEXION").mysqli_connect_error(); //EN CAOS DE QUE HAYA UN ERROR EN LA CONEXION;
  }
  //Consulta
  $registros = mysqli_query($conexion, "Select usuario_ID, Password from usuarios WHERE usuario_ID='$_POST[usuario]'")
      or die("Problemas en el select".mysqli_error($conexion));

  if($bus=mysqli_fetch_array($registros)){ //BUSCAR EN EL REGISTRO MEDIANTE UN ARRAYS FETCH

    if($bus['Password'] === $_POST['password']){
      header("Location: Nosotros.php"); //Si cumple condicion, nos permite el Ingreso
    }
    else{//Mensaje de que la contraseña no concuerda
      echo '"<script lenguage="javascript">alert("Contraseña no concuerda");</script>'; 
    }
  }else{//Mensaje de que no existe un usuario con ese nomre
    echo '"<script lenguage="javascript">alert("No existe un Usuario con ese nombre");</script>';
  }
}
if(isset($_POST['Registrar'])){ //BUSCA SI LE VOTON FUE PRESIONADO 
  $nombre=trim($_POST['nombre']); //CREAMOS VARIABLES
  $email=trim($_POST['email']);
  $Password=trim($_POST['password']);
  $Telefono=trim($_POST['telefono']);
  $Usuario=trim($_POST['usuario']);
  mysqli_query($conexion, "INSERT INTO usuarios(Nombre,Email,Password,Telefono,Usuario_ID)  
        values('$nombre','$email','$Password','$Telefono','$Usuario') ")
  or die("Problemas en el select".mysqli_error($conexion));
}