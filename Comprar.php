<?php 
session_start();
include_once "Templates/encabezado.php";
//Muestra las compras que se desean hacer
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
	<div class="col-xs-12">
		<h1>Comprar</h1>
		<?php
			//Se identifica el indice y nos notifica segun la accion realizada o error encontrado
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Compra realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Compra cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la compra
						</div>
					<?php
				}
			}
		?>

		<?php //Se crea un TextBox donde se ingresa el codigo del producto a comprar y se agrega al carrito ?>
		<br>
		<form method="post" action="./agregarAlCarrito.php ">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" 
					required type="text" id="codigo" placeholder="Escribe el código">
		</form>
		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" 
																. $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3>Total: <?php echo $granTotal; ?></h3>
		<?php //Se dirige a la funcion dentro de 'terminarCompra' donde se almacena el total de la compra?>
		<form action="./terminarCompra.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar Compra</button>
			<?php  //Se vacia la tabla con los productos al terminar la compra?>
			<a href="./cancelarCompra.php" class="btn btn-danger">Cancelar Compra</a>
		</form>
	</div>
<?php include_once "Templates/pie.php" ?>