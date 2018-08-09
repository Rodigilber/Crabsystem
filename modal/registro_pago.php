<!-- Tan pronto como cargue la ventana modal dar el foco a la captura de la Fecha de Pago -->
	<?php

		if (isset($con))
		{

			// Se obtiene el saldo del recibo
			$sql    = "Select saldo from facturas where id_factura =".$_GET["idFactura"];
			$query  = mysqli_query($con, $sql);
			$result = mysqli_fetch_array($query);
			$saldo  = $result["saldo"];		

			$vendedor = $_SESSION['logeado'];	
			
	?>
			<!-- Modal -->
			<div class="modal" id="nuevoPago" tabindex="-1" role="dialog">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Registrar Nuevo Pago</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal" method="post" id="guardar_pago" name="guardar_pago">

						<div id="resultados_ajax_productos"></div>

						  <div class="form-group">

							<label for="cobradoPor" class="col-sm-3 control-label">Cobrado Por</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="cobradoPor" name="cobradoPor" value=<?php echo $vendedor; ?> readonly="readonly">
							</div>
						  </div>

						  <div class="form-group">
							<label for="saldoPendiente" class="col-sm-3 control-label">Saldo Pendiente</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="saldoPendiente" name="saldoPendiente" placeholder="Saldo Pendiente" value=<?php echo $saldo; ?> required readonly="readonly">
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="fechaPago" class="col-sm-3 control-label">Fecha Pago</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="datepicker1" name="fechaPago" required>
							</div>
						  </div>

						   <div class="form-group">

							<label for="Descripcion" class="col-sm-3 control-label">Por concepto de:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="Descripcion" name="Descripcion"  required>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="montoPagar" class="col-sm-3 control-label">Monto Pagar</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="montoPagar" name="montoPagar" placeholder="Monto Pagar" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
							</div>
						  </div>
						 
				
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
					  </div>
				  </form>
				</div>
			  </div>
			</div>

	<?php
		}
	?>