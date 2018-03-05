<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

$action   = $_GET['action'];
// $idRecibo = $_GET['idRecibo'];
$datos    = $_POST;

// Si se esta capturando un nuevo pago
switch($action) {
    case "delete":
    	eliminarRegimen( $datos );
        break;
    case "edit":
    	actualizarRegimen( $datos );
        break;
    default:
        guardarRegimen( $datos );
} 


/**
 * [guardarRegimen Guarda el regimen capturado para un recibo seleccionado previamente]
 * @param  [array]  $datos  [Contiene la informacion relacionada al pago]
 * @return [type]           [description]
 */
function guardarRegimen( $datos )
{

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$clave      = $datos['codigo']; 
	$regimen    = $datos['descripcion'];

	$insert = "insert into tblregimenes(claveRegimen, regimen) values('".$clave."','".$regimen."')";


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
	} 
?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Regimen Guardado Exitosamente!</strong>
		</div>

<?php
} 

/**
 * Elimina un regimen seleccionado
 */
function eliminarRegimen( $idRegimen )
{

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos


	$idEliminar = $idRegimen["idRegimen"];

	$delete = "Delete from tblregimenes where idRegimen = $idEliminar";
	$result = mysqli_query($con, $delete);

	echo true;
}

/**
 * Actualizar el regimen seleccionado
 */
function actualizarRegimen( $datos )
{
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$idRegimen  = $datos['idRegimen'];
	$clave      = $datos['codigo']; 
	$regimen    = $datos['descripcion'];

	$update = "Update tblregimenes set claveRegimen = '$clave', regimen = '$regimen' where idRegimen = $idRegimen";
	$result = mysqli_query($con, $update);

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

?>

		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡Regimen Actualizado Exitosamente!</strong>
		</div>

<?php
	}

}



?>
