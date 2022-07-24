<?php
if(!isset($_POST["total"])) exit;
session_start();

//Recibe el precio total recibida de 'Comprar.php'
$total = $_POST["total"];
include_once "base_de_datos.php";
//La variable '$ahora' recibe la fecha de este momento
$ahora = date("Y-m-d H:i:s");

//Consulta para registrar en la tabla compras
$sentencia = $base_de_datos->prepare("INSERT INTO compras(fecha, total) VALUES (?, ?);");
//Se reemplaza los '?' por la fecha y el total
$sentencia->execute([$ahora, $total]);

//Consulta donde se muestra los datos de la tabla compras ordenandas de forma descendiente a 1
$sentencia = $base_de_datos->prepare("SELECT id FROM compras ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
//'$resultado' recibe la consulta
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();
//La consulta donde se registra la relacion de Productos y la Compra en la tabla 'productos_comprados'
$sentencia = $base_de_datos->prepare("INSERT INTO productos_comprados(id_producto, id_compra, cantidad) VALUES (?, ?, ?);");
//La consulta donde se actualiza las existencias del productos de acuerdo a la cantidad comprada
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");

foreach ($_SESSION["carrito"] as $producto) {
	//Se incrementa el total por los productos agregados del carrito
	$total += $producto->total;
	//Se reemplaza los '?' con las IDs correspondiente al producto y a la compra
	$sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
	//Se reemplaza los '?' para actualizar la cantidad a su correspondiente producto
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}
$base_de_datos->commit();
//Se vacia el carrito para una nueva compra
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
//Se regresa a la pagina Comprar
header("Location: ./Comprar.php?status=1");
?>