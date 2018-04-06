<?php
	/*-------------------------
	Autor: Rodigilber Gonzalez
	
	Mail: rodigilber.gonzalez@gmail.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
    }
	
	
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	//Archivo de funciones PHP
	include("../../funciones.php");

	// Buscar los pagos realizados a la factura seleccionada
	$sql = "Select a.numero_factura, a.id_cliente, c.nombre_cliente, a.fecha_factura, a.total_venta,
					       b.idPago, b.montoPagado, b.saldoAnterior, b.saldoActual, b.fechaPago
					From tblpagos b 
							INNER JOIN facturas a ON b.idFactura = a.id_factura
							INNER JOIN clientes c ON c.id_cliente = a.id_cliente
					Where a.id_factura =".$_GET['idRecibo'];

	$query = mysqli_query($con, $sql);

	// Si hay pagos, mostrarlos
	// if ( $query->num_rows == 0 )	
	// {
	// 		echo "<script>alert('No hay pagos agregados al recibo')</script>";
	// 		echo "<script>window.close();</script>";
	// 		exit;
	// }

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	$result = mysqli_fetch_object($query);

	// var_dump( $result );

	$id_cliente     = $result->id_cliente; //to used in the pago_html.php QUERY
	$idPago         = $result->idPago;
	$numero_factura = $result->numero_factura;
		
	//Variables por GET
		// $id_cliente=intval($_GET['id_cliente']);
		// $id_vendedor=intval($_GET['id_vendedor']);
		// $condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
		//Fin de variables por GET

	//now details are obtained by sql from fcturas,

		// $sql=mysqli_query($con, "select LAST_INSERT_ID(numero_factura) as last from facturas order by id_factura desc limit 0,1 ");
		// $rw=mysqli_fetch_array($sql); //which was obtained fro facturas to array
		// $numero_factura=$rw['last']+1;	//we extract the last fatura number, it is gong to be used in  // include(dirname('__FILE__').'/res/factura_html.php'); to insert


	
	$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
    
    // get the HTML
    ob_start();
    include(dirname('__FILE__').'/res/pago_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('HistorialPago.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
