<?php

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos   

	// Se obtiene el saldo del recibo
	$sql         = "Select * from tblregimenes Where idRegimen=".$_POST["idRegimen"];
	$query       = mysqli_query($con, $sql);
	$result      = mysqli_fetch_array($query);

	header('Content-Type: application/json');
	echo json_encode(
						array( 'idRegimen'    => $result["idRegimen"],
							   'claveRegimen' => $result["claveRegimen"],
							   'regimen'      => $result["regimen"] )
					);

?>