<?php
//Recibe el indice(ubicacion dentro de la lista) de 'Comprar.php'
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
//De acuerdo del indice se quita el producto del carrito
array_splice($_SESSION["carrito"], $indice, 1);
header("Location: ./Comprar.php?status=3");
?>