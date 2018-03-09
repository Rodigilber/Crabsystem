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
		$sWhere   = "Select * From tblregimenes ";
		// Columnas a buscar dentro de la tabla de regimenes
		$aColumns = array('claveRegimen','regimen');

		$search = $_GET['search'];
		if ( $search != "" )
		{
			$sWhere .= "WHERE ( ";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$search."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';

		} 

		$query = mysqli_query($con, $sWhere);

		// Si hay pagos, mostrarlos
		if ( $query->num_rows > 0 )
		{

?>

			<!-- Pintamos la tabla con la informacion de los pagos recibidos por factura seleccionada -->
			<div class="table-responsive">
				<table class="table">
					<tr class="info">
						<th>Clave</th>
						<th>Regimen</th>
						<th>Acciones</th>
					</tr>

			<?php

					while ($row=mysqli_fetch_array($query)) {
						$idRegimen    = $row["idRegimen"];
						$clave        = $row["claveRegimen"];
						$descripcion  = $row["regimen"];
			?>

						<tr>
							<td><?php echo $clave; ?></td>
							<td><?php echo $descripcion; ?></td>
							<td>
								<span class="pull-right">
									<a href="#" class='btn btn-default' title='Editar producto' data-toggle="modal" onclick="editarRegimen('<?php echo $idRegimen; ?>')"><i class="glyphicon glyphicon-edit"></i></a> 

									<a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminarRegimen('<?php echo $idRegimen; ?>')" ><i class="glyphicon glyphicon-trash"></i> </a>
								</span>
							</td>
						</tr>
			<?php
					}
			?>

				</table>
			</div>

<?php } }?>