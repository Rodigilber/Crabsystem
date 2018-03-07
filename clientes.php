<?php
	/*-------------------------
	Autor: Rodigilber Gonzalez
	
	Mail: rodigilber.gonzalez@gmail.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";	
	$active_pagos   = "";	
	$title="Clientes | ControlSys";
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
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> 
				Nuevo Cliente</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Clientes</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
				include("modal/registro_clientes.php");
				include("modal/editar_clientes.php");
			?>


			<form id="datos_cotizacion">
				
				<div class="form-row">

					 <div class="form-row">
					 	<!-- Cliente -->
					    <div class="form-group col-md-3">
					      <label for="q">Cliente</label>
					      <input type="text" class="form-control" id="q" placeholder="Nombre del cliente" onkeyup='load(1);'>
					    </div>
					    <!-- Inicio -->
					    <div class="form-group col-md-2">
					      <label for="inputCity">Fecha Inicial</label>
					      <input type="text" class="form-control" id="datepicker4" placeholder="Fecha Inicio">
					    </div>
					    <!-- Fin -->
					    <div class="form-group col-md-2">
					      <label for="inputZip">Fecha Final</label>
					      <input type="text" class="form-control" id="datepicker5" placeholder="Fecha Final">
					    </div>
					    <!-- Activos o Inactivos -->
						<div class="form-group col-md-3">
							 <label for="estatus">Estatus del Cliente</label>
							 <select class="form-control" id="estatus" name="estatus">
								<option value="" selected>-- Selecciona una opcion --</option>
								<option value="0">Activos</option>
								<option value="1">Inactivos</option>
							  </select>							
						</div>					    
					  </div>	

					  <div class="form-group row">
					    <div class="col-sm-10">
						  <button type="button" class="btn btn-warning pull-right" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button>
						  <span id="loader"></span>	
					    </div>
					  </div>					  

				</div>		

			</form>

<br><br>

 <form action="export.php" method="post" name="export_excel">
	<div class="control-group">
		<div class="controls">
			<button type="submit" id="export" name="export" class="btn btn-primary button-loading" data-loading-text="Loading...">Exportar a Excel</button>
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
	<script type="text/javascript" src="js/clientes.js"></script>	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 


  </body>
</html>
