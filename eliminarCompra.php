<?php
if(!isset($_GET["id"])) exit();
//Arecive el ID de la compras
$id = $_GET["id"];
include_once "base_de_datos.php";
//Consulta DELETE a la tabla compras
$sentencia = $base_de_datos->prepare("DELETE FROM compras WHERE id = ?;");
//Se reemplaza '?' con el id de la compras
$resultado = $sentencia->execute([$id]);
//Al ejecutar la consulta regresa a 'Compras.php'
if($resultado === TRUE){
	header("Location: ./Compras.php");
	exit;
}
else echo "Algo salió mal";
?>

