<?php

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos   

	// Se obtiene el saldo del recibo
	$sql         = "Select * from tblobligaciones Where idobligacion=".$_POST["idobligacion"];
	$query       = mysqli_query($con, $sql);
	$result      = mysqli_fetch_array($query);

	header('Content-Type: application/json');
	echo json_encode(
						array( 'idobligacion'    => $result["idobligacion"],
							   'claveobligacion' => $result["claveobligacion"],
							   'obligacion'      => $result["obligacion"] )
					);

?>