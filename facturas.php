<?php
	/*-------------------------

	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	// Added by Jorge Manzano
	$active_pagos   ="";
	$title="Recibos/Pagos | ControlSys";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="nueva_factura.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nuevo Recibo</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Recibo</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">


							<label for="q" class="col-md-2 control-label">Cliente o # de Recibo</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="q" placeholder="Nombre del cliente o # de Recibo" onkeyup='load(1);'>
							</div>



    					<!-- Activos o Inactivos -->
						<div class="form-group">
							 <label for="estado" class="control-label">Estado</label>
							 <div class="col-md-3">
							 <select class="form-control" id="estado" name="estado">
								<!-- <option value="" selected> Selecciona una opcion </option> -->
								<option value="2" selected>Todos</option>
								<option value="0">Pagado</option>
								<option value="1">Pendiente</option>
							  </select>							
						</div>	
						</div>	

							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
					
							
						</div>
				 
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/facturas.js"></script>
  </body>
</html>