<?php

	/*-------------------------
	Autor: Rodigilber Gonzalez
	
	Mail: rodigilber.gonzalez@gmail.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from facturas where numero_factura='".$numero_factura."'";
		$del2="delete from detalle_factura where numero_factura='".$numero_factura."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}

	if($action == 'ajax'){

		// Buscar los pagos realizados a la factura seleccionada
		$sql = "Select a.numero_factura, a.id_cliente, c.nombre_cliente, a.fecha_factura, a.total_venta,
					       b.idPago, b.montoPagado, b.conceptoPago, b.saldoAnterior, b.saldoActual, b.fechaPago
					From tblpagos b 
							INNER JOIN facturas a ON b.idFactura = a.id_factura
							INNER JOIN clientes c ON c.id_cliente = a.id_cliente
					Where a.id_factura =".$_REQUEST['idFacturaPagar'];

		$query = mysqli_query($con, $sql);

		// Si hay pagos, mostrarlos
		if ( $query->num_rows > 0 )
		{

?>

			<!-- Pintamos la tabla con la informacion de los pagos recibidos por factura seleccionada -->
			<div class="table-responsive">
				<table class="table">
					<tr class="info">
						<th>No Pago</th>
						<th>Fecha Recibo</th>
						<th>Fecha Pago</th>
						<th>Concepto Pago</th>
						<th>Monto Pagado</th>
						<th>Saldo Anterior</th>
						<th>Saldo Actual</th>
					</tr>

			<?php


					// Determinar el numero total de pagos realizados con el fin de determinar cual es el ultimo y la clase css para seleccionar 
					// el saldo sea activada
					$pagosTotales = $query->num_rows;

					$noPago = 0;  
					while ($row=mysqli_fetch_array($query)) {

						$noPago++;

						$selected = ( $noPago == $pagosTotales ) ? "selected" : "";

						$numero_factura = $row["idPago"];
						$fecha_factura  = date("d/m/Y", strtotime($row['fecha_factura']));
						$fecha_Pago     = date("d/m/Y", strtotime($row['fechaPago']));
						$conceptoPago   = $row["conceptoPago"];
						$montoPagado    = $row["montoPagado"];
						$saldoAnterior  = $row["saldoAnterior"];
						$saldoActual    = $row["saldoActual"];
			?>

						<tr class=<?php echo $selected; ?>>
							<td><?php echo $numero_factura; ?></td>
							<td><?php echo $fecha_factura; ?></td>
							<td><?php echo $fecha_Pago; ?></td>
							<td><?php echo $conceptoPago; ?></td>
							<td><?php echo $montoPagado; ?></td>
							<td><?php echo $saldoAnterior; ?></td>
							<td><?php echo $saldoActual; ?></td>				
						</tr>
			<?php
					}
			?>

				</table>
			</div>

<?php } }?>