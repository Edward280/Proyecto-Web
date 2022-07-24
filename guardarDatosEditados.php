<?php
#Salir si alguno de los datos no está presente
if(
	!isset($_POST["codigo"]) || 
	!isset($_POST["descripcion"]) || 
	!isset($_POST["precioCompra"]) || 
	!isset($_POST["precioVenta"]) || 
	!isset($_POST["existencia"]) || 
	!isset($_POST["id"])
) exit();
//Lama a BD
include_once "base_de_datos.php";
//Recibe los datos en variables
$id = $_POST["id"];
$codigo = $_POST["codigo"];
$descripcion = $_POST["descripcion"];
$precioCompra = $_POST["precioCompra"];
$precioVenta = $_POST["precioVenta"];
$existencia = $_POST["existencia"];
//Consulta
$sentencia = $base_de_datos->prepare("UPDATE productos SET codigo = ?, descripcion = ?, precioCompra = ?,
											 precioVenta = ?, existencia = ? WHERE id = ?;");
//Reemplazo de los valores '?'
$resultado = $sentencia->execute([$codigo, $descripcion, $precioCompra, $precioVenta, $existencia, $id]);
if($resultado === TRUE){
	header("Location: ./Productos.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
?>