<?php

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos   

	// Se obtiene el saldo del recibo
	$sql     = "Select b.nombre_cliente from facturas a JOIN clientes b ON a.id_cliente = b.id_cliente Where a.id_factura=".$_POST["idRecibo"];
	$query   = mysqli_query($con, $sql);
	$result  = mysqli_fetch_array($query);
	$cliente = $result["nombre_cliente"];	

	echo $cliente;

?>