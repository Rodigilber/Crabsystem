		<style type="text/css">
		<!--
		table { vertical-align: top; }
		tr    { vertical-align: top; }
		td    { vertical-align: top; }
		.midnight-blue{
			background:#2c3e50;
			padding: 4px 4px 4px;
			color:white;
			font-weight:bold;
			font-size:12px;
		}
		.silver{
			background:white;
			padding: 3px 4px 3px;
		}
		.clouds{
			background:#ecf0f1;
			padding: 3px 4px 3px;
		}
		.border-top{
			border-top: solid 1px #bdc3c7;
			
		}
		.border-left{
			border-left: solid 1px #bdc3c7;
		}
		.border-right{
			border-right: solid 1px #bdc3c7;
		}
		.border-bottom{
			border-bottom: solid 1px #bdc3c7;
		}
		table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
		}
		-->
		</style>


<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "CrabSystems "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>


    <?php include("encabezado_pago.php");?>
   
    <br>
    
		
	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>RECIBI DE:</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo $rw_cliente['nombre_cliente'];
				//echo "<br>";
				//echo $rw_cliente['direccion_cliente'];
				//echo "<br> Teléfono: ";
				//echo $rw_cliente['telefono_cliente'];
				//echo "<br> Email: ";
				//echo $rw_cliente['email_cliente'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
	 

	<br>
  
    <table cellspacing="0" style="width: 90%; text-align: left; font-size: 10pt;">
        <tr align="center">
            <th style="width: 10%;text-align:center" class='midnight-blue'>No. Pago</th>
            <th style="width: 5%"; class='midnight-blue'>Mes de Pago</th>
            <th style="width: 5%"; class='midnight-blue'>Fecha de Pago</th>
            <th style="width: 5%"; class='midnight-blue'>Cobrado por</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>Monto Pagado</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>Saldo Anterior</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>Saldo Actual</th>
        </tr>

<?php
$nums=1;
$sumador_total=0;

//geting the all that was stored in Tmp and it will be converted to "row" Array
// $sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");

$sql = "Select a.numero_factura, a.id_cliente, c.nombre_cliente, a.fecha_factura, a.total_venta,
					       b.idPago, b.montoPagado, b.saldoAnterior, b.saldoActual, b.fechaPago, d.firstname
					From tblpagos b 
							INNER JOIN facturas a ON b.idFactura = a.id_factura
							INNER JOIN clientes c ON c.id_cliente = a.id_cliente
							INNER JOIN users d ON d.user_id = b.idVendedor
					Where a.id_factura =".$_GET['idRecibo'];

$query = mysqli_query($con, $sql);					
$meses = array("Enero",
	           "Febrero",
	           "Marzo",
	           "Abril",
	           "Mayo",
	           "Junio",
	           "Julio",
	           "Agosto",
	           "Septiembre",
	           "Octubre",
	           "Noviembre",
	           "Diciembre" );


while ($row=mysqli_fetch_array($query))
{
		
		$numero_factura = $row["idPago"];
		$fecha_factura  = date("d/m/Y", strtotime($row['fecha_factura']));
		$_mes           = date("n",strtotime($row['fecha_factura']));
		$mes            = $meses[$_mes-1];

		$fecha_Pago     = date("d/m/Y", strtotime($row['fechaPago']));
		$cobradoPor     = $row['firstname'];
		$montoPagado    = $row["montoPagado"];
		$saldoAnterior  = $row["saldoAnterior"];
		$saldoActual    = $row["saldoActual"];

?>

						<tr>
							<td style="width: 10%; text-align: center"><?php echo $numero_factura; ?></td>
							<td style="width: 20%; text-align: center"><?php echo $mes; ?></td>
							<td style="width: 20%; text-align: center"><?php echo $fecha_Pago; ?></td>
							<td style="width: 12%; text-align: center"><?php echo $cobradoPor; ?></td>
							<td style="width: 12%; text-align: center"><?php echo $montoPagado; ?></td>
							<td style="width: 12%; text-align: center"><?php echo $saldoAnterior; ?></td>
							<td style="width: 12%; text-align: center"><?php echo $saldoActual; ?></td>				
						</tr>

<?php 

}

?>

    </table>
	

</page>


