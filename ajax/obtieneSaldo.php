<?php

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos   

	// Se obtiene el saldo del recibo
	$sql    = "Select saldo from facturas where id_factura =".$_POST["idRecibo"];
	$query  = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($query);
	$saldo  = $result["saldo"];	

	echo $saldo;

?>