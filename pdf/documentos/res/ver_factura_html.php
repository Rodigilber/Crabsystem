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

/* CSS rule para mostrar los saldos en una tabla remarcados en amarillo */
tr.selected {

   background-color: #ffb3b3;

}

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
                    &copy; <?php echo "CrabSystems"; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
	<?php include("encabezado_factura.php");?>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>Nombre del Cliente</td>
        </tr>
		<tr>
           <td style="width:50%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);
				echo $rw_cliente['nombre_cliente'];
				//echo "<br>";
				// echo $rw_cliente['direccion_cliente'];
				// echo "<br> Teléfono: ";
				// echo $rw_cliente['telefono_cliente'];
				// echo "<br> Email: ";
				// echo $rw_cliente['email_cliente'];
			?>
			
		   </td>
        </tr>
        
   
    </table> 
    
    


	<br>
<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
    <tr>
       <td style="width:50%;" class='midnight-blue'>LISTA DE CARGOS</td>
    </tr>
 </table>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr>
             <th style="width: 10%;text-align:center" class='midnight-blue'>CANT.</th>
            <th style="width: 30%" class='midnight-blue'>DESCRIPCION</th>

            <th style="width: 30%" class='midnight-blue'>FORMA DE PAGO</th>

            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

	<?php
		$nums=1;
		$sumador_total=0;
		$sql=mysqli_query($con, "select * from products, detalle_factura, facturas where products.id_producto=detalle_factura.id_producto and detalle_factura.numero_factura=facturas.numero_factura and facturas.id_factura='".$id_factura."'");

		while ($row=mysqli_fetch_array($sql))
	{
				$id_producto=$row["id_producto"];
				$codigo_producto=$row['codigo_producto'];
				$cantidad=$row['cantidad'];
				$nombre_producto=$row['nombre_producto'];
				
				$precio_venta=$row['precio_venta'];

				$saldo=$row['saldo'];

				$precio_venta_f=number_format($precio_venta,2);//Formateo variables
				$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
				$precio_total=$precio_venta_r*$cantidad;
				$precio_total_f=number_format($precio_total,2);//Precio total formateado

			 

				$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
				$sumador_total+=$precio_total_r;//Sumador
				if ($nums%2==0){
					$clase="clouds";
				} else {
					$clase="silver";
						}
	?>

       			<tr>
		            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
		            <td class='<?php echo $clase;?>' style="width: 30%; text-align: left"><?php echo $nombre_producto;?></td>
					
					<td class='<?php echo $clase;?>' style="width: 30%; text-align: left">
							<?php 
							if ($condiciones==1){echo "Efectivo";}
							elseif ($condiciones==2){echo "Cheque";}
							elseif ($condiciones==3){echo "Transferencia bancaria";}
							elseif ($condiciones==4){echo "Crédito";}
							?>
					</td>

		            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td> 
		            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td> 
		            
		        </tr>

		<?php 

			
			$nums++;
	}//while ends here, which means that no more rows are pending to add
			$impuesto=get_row('perfil','impuesto', 'id_perfil', 1);
			$subtotal=number_format($sumador_total,2,'.','');
			$total_iva=($subtotal * $impuesto )/100;
			$total_iva=number_format($total_iva,2,'.','');
			$total_factura=$subtotal+$total_iva;
		?>
<!--	  
        <tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">SUBTOTAL <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>
		<tr>
            <td colspan="3" style="widtd: 85%; text-align: right;">IVA (<?php echo $impuesto;?>)% <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr>
-->
        <tr>
        
        	<b>
            <td colspan="4" style="widtd: 85%; text-align: right;" >TOTAL <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
         	</b>   
        </tr>


   <tr>
            <td colspan="4" style="widtd: 85%; text-align: right;">SALDO <?php echo $simbolo_moneda;?> </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($saldo,2);?></td>
        </tr>

    </table>
	
		<br>
		<br>
		<br>
   <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:50%;" class='midnight-blue'>LISTA DE PAGOS A ESTE RECIBO</td>
        </tr>
     </table>

<table cellspacing="0" style="width: 90%; text-align: left; font-size: 10pt;">
        <tr align="center">
            <th style="width: 10%;text-align:center" class='midnight-blue'>No. Pago</th>
            <th style="width: 5%"; class='midnight-blue'>Mes de Pago</th>
            <th style="width: 5%"; class='midnight-blue'>Fecha de Pago</th>
            <th style="width: 5%"; class='midnight-blue'>Cobrado por</th>
            <th style="width: 14%;text-align: right" class='midnight-blue'>Monto Pagado</th>
            <th style="width: 5%"; class='midnight-blue'>Concepto Pago</th>
            <th style="width: 13%;text-align: right" class='midnight-blue'>Saldo Anterior</th>
            <th style="width: 13%;text-align: right" class='midnight-blue'>Saldo Actual</th>
        </tr>

			<?php

					$nums=1;
					$sumador_total=0;

					//geting the all that was stored in Tmp and it will be converted to "row" Array
					// $sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");

					$sql_pagos = "Select a.numero_factura, a.id_cliente, c.nombre_cliente, a.fecha_factura, a.total_venta,
										       b.idPago, b.montoPagado, b.conceptoPago, b.saldoAnterior, b.saldoActual, b.fechaPago, d.firstname
										From tblpagos b 
												INNER JOIN facturas a ON b.idFactura = a.id_factura
												INNER JOIN clientes c ON c.id_cliente = a.id_cliente
												INNER JOIN users d ON d.user_id = b.idVendedor
										Where a.id_factura =".$_GET['id_factura'];

					$query_pagos = mysqli_query($con, $sql_pagos);					
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

					// Determinar el numero total de pagos realizados con el fin de determinar cual es el ultimo y la clase css para seleccionar 
					// el saldo sea activada
					$pagosTotales = $query_pagos->num_rows;

					$noPago = 0;  
					while ($row_pagos=mysqli_fetch_array($query_pagos))
					{

							
							$noPago++;

							$selected = ( $noPago == $pagosTotales ) ? "selected" : "";						
							
							$numero_factura = $row_pagos["idPago"];
							$fecha_factura  = date("d/m/Y", strtotime($row_pagos['fecha_factura']));
							$_mes           = date("n",strtotime($row_pagos['fecha_factura']));
							$mes            = $meses[$_mes-1];

							$fecha_Pago     = date("d/m/Y", strtotime($row_pagos['fechaPago']));
							$cobradoPor     = $row_pagos['firstname'];
							$montoPagado    = $row_pagos["montoPagado"];
							$saldoAnterior  = $row_pagos["saldoAnterior"];
							$saldoActual    = $row_pagos["saldoActual"];
							$conceptoPago   = $row_pagos["conceptoPago"];

			?>



								<tr class=<?php echo $selected; ?>>
									<td style="width: 10%; text-align: center"><?php echo $numero_factura; ?></td>
									<td style="width: 20%; text-align: center"><?php echo $mes; ?></td>
									<td style="width: 20%; text-align: center"><?php echo $fecha_Pago; ?></td>
									<td style="width: 10%; text-align: center"><?php echo $cobradoPor; ?></td>
									<td style="width: 10%; text-align: center"><?php echo $montoPagado; ?></td>
									<td style="width: 10%; text-align: center"><?php echo $conceptoPago; ?></td>
									<td style="width: 10%; text-align: center"><?php echo $saldoAnterior; ?></td>
									<td style="width: 10%; text-align: center"><?php echo $saldoActual; ?></td>				
								</tr>

					<?php 

					}

					?>

    </table>








	
	<br>

	<table cellspacing="0" style="width: 100%; text-align: center; font-size: 11pt;">
	 
	        <tr>
	           <td style="width:100%;" >Empleado</td>
	        </tr>
	 
			<tr>
		           <td style="width:100%;">
					<?php 
						$sql_user=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
						$rw_user=mysqli_fetch_array($sql_user);
						echo $rw_user['firstname']." ".$rw_user['lastname'];
					?>
				   </td>
	        </tr>   
    </table>

	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su preferencia!</div>
	
	
	  

</page>

