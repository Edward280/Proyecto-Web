<?php

session_start();
//Se vacia el Carrito de compras en la tabla
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

header("Location: ./Comprar.php?status=2");
?>