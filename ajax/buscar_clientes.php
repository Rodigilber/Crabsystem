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
		$id_cliente=intval($_GET['id']);
		$query=mysqli_query($con, "select * from facturas where id_cliente='".$id_cliente."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM clientes WHERE id_cliente='".$id_cliente."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q       = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $inicio  = $_REQUEST['inicio'];
         $fin     = $_REQUEST['fin'];
         $estatus = $_REQUEST['estatus'];

         // var_dump($_REQUEST);

		 $aColumns  = array('nombre_cliente');//Columnas de busqueda
		 $sTable    = "clientes";
		 $sWhere    = "";
		 $condition = "";
		 $where     = "";


		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';

		} 

		// Filtrar por fechas y estatus del cliente - AND Conditions
		if ( $inicio != '' || $fin != '' || $estatus != '')
		{
			// $inicio necesita de un $fin, por tanto se valida que ambas fechas hayan sido seleccionadas
			if ( $inicio != '' && $fin != '' )
			{
				// Se debio haber seleccionado el estatus del cliente a filtrar para poder determinar la columna pivote
				if ( $estatus != '' )
				{
					$where  = ( $q == '' ) ? " Where" : "";
					if ( $estatus == '0' ) // Clientes activos
					{
						$condition = " status_cliente = 1 AND initservprof_clientes BETWEEN '".$inicio."' AND '".$fin."'";
					} else {
						// Clientes Inactivos
						$condition = " status_cliente <> 1 AND finservprof_clientes BETWEEN '".$inicio."' AND '".$fin."'";
					}
				}
			} else {
				if ( $estatus != '' )
				{
					$status    = ( $estatus == '0' ) ? "1" : "2"; 
					$condition = " where status_cliente = ".$status;
				}
			}
		}

		$and    = ( $sWhere != '' ) ? " AND" : "";
		$sWhere .= $where.$and.$condition;
		// var_dump( $sWhere );
		// var_dump( $sTable );
		// // exit();

		$sWhere.=" order by id_cliente desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table id="example" class="table table-hover"   >
			<thead>
			<tr  class="info">
					<th># Contr</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Dirección</th>
					<th>Estado</th>
					<th>Agregado</th>
					<th class='text-right'>Acciones</th>
			</thead>

	


			</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_cliente=$row['id_cliente'];
						$nombre_cliente=$row['nombre_cliente'];

						$initservprof_cliente=$row['initservprof_clientes'];
						$finservprof_cliente=$row['finservprof_clientes'];


						$regimen_fiscal_cliente=$row['regimen_fiscal_cliente'];


						$contabilidad_cliente=$row['contabilidad_cliente'];
						
						$obligaciones_fisc_cliente=$row['obligaciones_fisc_cliente'];

						$auxiliar_cliente_cliente=$row['auxiliar_cliente_cliente'];
						$rfc_cliente_cliente=$row['rfc_cliente_cliente'];
						$contr_rfc_cliente=$row['contr_rfc_cliente'];
						$contr_efirma_cliente=$row['contr_efirma_cliente'];
						$vigencia_efirma_cliente=$row['vigencia_efirma_cliente'];
						$nrp_cliente=$row['nrp_cliente'];
						$fiel_imss_cliente=$row['fiel_imss_cliente'];
						$imss_patrones_cliente=$row['imss_patrones_cliente'];
						$infonavit_patrones_cliente=$row['infonavit_patrones_cliente'];

						
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$direccion_cliente=$row['direccion_cliente'];
						$status_cliente=$row['status_cliente'];
						if ($status_cliente==1){$estado="Activo";}
						else {$estado="Inactivo";}
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					
					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="nombre_cliente<?php echo $id_cliente;?>">

					<input type="hidden" value="<?php echo $initservprof_cliente;?>" id="initservprof_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $finservprof_cliente;?>" id="finservprof_cliente<?php echo $id_cliente;?>">

					<input type="hidden" value="<?php echo $regimen_fiscal_cliente;?>" id="regimen_fiscal_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $contabilidad_cliente;?>" id="contabilidad_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $obligaciones_fisc_cliente;?>" id="obligaciones_fisc_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $auxiliar_cliente_cliente;?>" id="auxiliar_cliente_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $rfc_cliente_cliente;?>" id="rfc_cliente_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $contr_rfc_cliente;?>" id="contr_rfc_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $contr_efirma_cliente;?>" id="contr_efirma_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $vigencia_efirma_cliente;?>" id="vigencia_efirma_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $nrp_cliente;?>" id="nrp_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $fiel_imss_cliente;?>" id="fiel_imss_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $imss_patrones_cliente;?>" id="imss_patrones_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $infonavit_patrones_cliente;?>" id="infonavit_patrones_cliente<?php echo $id_cliente;?>">

					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="email_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $direccion_cliente;?>" id="direccion_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $status_cliente;?>" id="status_cliente<?php echo $id_cliente;?>">
				<tbody>	
				<tr>
						<td><?php echo $id_cliente; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td ><?php echo $telefono_cliente; ?></td>
						<td><?php echo $email_cliente;?></td>
						<td><?php echo $direccion_cliente;?></td>
						<td><?php echo $estado;?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
				</tr>
				<tbody>
					<?php
				}
				?>
				<tr>
					<td colspan=12><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>


			</div>
			<?php
		}
	}
?>