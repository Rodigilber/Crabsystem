<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

$action   = $_GET['action'];
$idRecibo = $_GET['idRecibo'];
$datos    = $_POST;

// Si se esta capturando un nuevo pago
guardarPago( $idRecibo, $datos, $action );

/**
 * [guardarPago Guarda el pago capturado para un recibo seleccionado previamente]
 * @param  [array]  $datos  [Contiene la informacion relacionada al pago]
 * @param  [string] $action [Indica si Guardara la informacion o la esta actualizando]
 * @return [type]           [description]
 */
function guardarPago( $idRecibo, $datos, $action )
{

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$saldoPendiente = $datos['saldoPendiente'];
	$fechaPago      = date('Y-m-d', strtotime($datos['fechaPago'])); 
	$montoPagar     = $datos['montoPagar'];
	$nuevoSaldo     = $saldoPendiente - $montoPagar;

	$insert = "insert into tblpagos(idFactura, fechaPago, montoPagado, saldoAnterior, saldoActual, idVendedor) values('".$idRecibo."','".$fechaPago."','".$montoPagar."','".$saldoPendiente."','".$nuevoSaldo."','".$_SESSION['user_id']."')";


	$result = mysqli_query($con, $insert);

	if ( !$result )
	{
?>

		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong> 
				<?php
					echo("Error description: " . mysqli_error($con));
				?>
		</div>

<?php
	} else {

		// Si el pago se guardo correctamente, actualizar la tabla de facturas con el ultimo saldo del recibo seleccionado.
		$update = "update facturas set saldo=".$nuevoSaldo." where id_factura =".$idRecibo;
		mysqli_query($con, $update);
?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Pago Guardado Exitosamente!</strong>
		</div>

<?php
	}

} 
?>
