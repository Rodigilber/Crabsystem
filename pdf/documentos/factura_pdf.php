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

	//retrieving data from tmp sql table, data was sent by #mymodal  add buttn on nueva_factura.php,it uses the session ID to know what data should retrieve from tmp table 
	$session_id= session_id();
	$sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");
	$count=mysqli_num_rows($sql_count); //just  want to know how many rows where retrived from tmp

	if ($count==0)
		{
			echo "<script>alert('No hay productos agregados a la factura')</script>";
			echo "<script>window.close();</script>";
			exit;
		}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
		$id_cliente=intval($_GET['id_cliente']);
		$id_vendedor=intval($_GET['id_vendedor']);
		$condiciones=mysqli_real_escape_string($con,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
		//Fin de variables por GET

	//now details are obtained by sql from fcturas,

		$sql=mysqli_query($con, "select LAST_INSERT_ID(numero_factura) as last from facturas order by id_factura desc limit 0,1 ");
		$rw=mysqli_fetch_array($sql); //which was obtained fro facturas to array
		$numero_factura=$rw['last']+1;	//we extract the last fatura number, it is gong to be used in  // include(dirname('__FILE__').'/res/factura_html.php'); to insert


	
	$simbolo_moneda=get_row('perfil','moneda', 'id_perfil', 1);
    // get the HTML
     ob_start();
     include(dirname('__FILE__').'/res/factura_html.php');
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
        $html2pdf->Output('Factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
