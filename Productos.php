<?php 
	//Encabezado
	include_once "Templates/encabezado.php" 
?>
<?php
//Llama a la BD
include_once "base_de_datos.php";
//Consulta -> selecciona todos los datos de la tabla productos
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
//La variable '$productos' recibe los datos
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
	<div class="col-xs-12">
		<h1>Productos</h1>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de compra</th>
					<th>Precio de venta</th>
					<th>Existencia</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				//Imprime todos los datos de la tabla productos
				foreach($productos as $producto){ 
				?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioCompra ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->existencia ?></td>
					<?php // Botones de Editar y Eliminar el producto en fila?>
					<td><a class="btn btn-warning" href="<?php echo "./EditarProducto.php?id=" . $producto->id?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "./EliminarProducto.php?id=" . $producto->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php // Boton que envia a 'FormularioNuevoProducto.phps'?>
		<div>
			<a class="btn btn-success" href="./FormularioNuevoProducto.php">Nuevo <i class="fa fa-plus"></i></a>
		</div>
	</div>
<?php include_once "Templates/pie.php" ?>