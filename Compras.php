<?php 
include_once "Templates/encabezado.php";
//Llama a la BD
include_once "base_de_datos.php";
//Consulta donde se selecciona
$sentencia = $base_de_datos->query("SELECT compras.total, compras.fecha, compras.id, GROUP_CONCAT(	
	productos.codigo, '..',  productos.descripcion, '..', productos_comprados.cantidad SEPARATOR '__') 
	AS productos FROM compras INNER JOIN productos_comprados ON productos_comprados.id_compra = compras.id 
	INNER JOIN productos ON productos.id = productos_comprados.id_producto GROUP BY compras.id ORDER BY compras.id;");
$compras = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
	<div class="col-xs-12">
		<h1>compras</h1>
		<div>
			<a class="btn btn-success" href="./Comprar.php">Nueva <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					<th>Productos vendidos</th>
					<th>Total</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php //Muestra las compras realizadas ?>
				<?php foreach($compras as $venta){ ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php //Muestra dentro la compra, los productos comprados ?>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<?php //Llama la funcion dentro de 'eliminarCompra.php' y almacena el ID de la compra?>
					<td><?php echo $venta->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarCompra.php?id=" . $venta->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "Templates/pie.php" ?>