<?php
	//Recibe el ID del producto a Eliminar en variable '$id'
	if(!isset($_GET["id"])) exit();
	$id = $_GET["id"];
	//Llama a la BD
	include_once "base_de_datos.php";
	//Consulta DELETE
	$sentencia = $base_de_datos->prepare("DELETE FROM productos WHERE id = ?;");
	//Reemplaza '?' con la ID recibida
	$resultado = $sentencia->execute([$id]);

	//Si se completo correctamente, regresa al Listado de Productos
	if($resultado === TRUE){
		header("Location: ./Productos.php");
		exit;
	}else{//Saldra mensaje de error
		echo "Algo salió mal";
	}
?>