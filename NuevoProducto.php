<?php
	//Salir si alguno de los datos no está presente
	if(!isset($_POST["codigo"]) || !isset($_POST["descripcion"]) || !isset($_POST["precioVenta"]) 
						|| !isset($_POST["precioCompra"]) || !isset($_POST["existencia"])) exit();

	//Llama a la BD
	include_once "base_de_datos.php";
	//Recibe los datos del formulario de 'FormularioNuevoProducto.php' en variables
	$codigo = $_POST["codigo"];
	$descripcion = $_POST["descripcion"];
	$precioVenta = $_POST["precioVenta"];
	$precioCompra = $_POST["precioCompra"];
	$existencia = $_POST["existencia"];
	//La consulta de Insert
	$sentencia = $base_de_datos->prepare("INSERT INTO productos(codigo, descripcion, precioVenta, precioCompra, existencia)
													VALUES (?, ?, ?, ?, ?);");
	//Reemplaza los '?' con las variables que contienen los datos
	$resultado = $sentencia->execute([$codigo, $descripcion, $precioVenta, $precioCompra, $existencia]);

	//Regresa a la lista de productos
	if($resultado === TRUE){
		header("Location: ./Productos.php");
		exit;
	}//Mensaje de error
	else echo "Algo salió mal. Por favor verifica que la tabla exista";
?>
<?php include_once "Templates/pie.php" ?>