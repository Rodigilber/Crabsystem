<?php
	/*-------------------------

	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos        
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	// $active_pagos   ="active";
	$title="Facturas | ControlSys";


?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php require("head.php");?>
  </head>
  <script type="text/javascript">
  	
	// Global Data
	var recibo = "<?php echo $_GET['idFactura']; ?>";
	recibo  = parseInt(recibo);

  </script>
  <body>
	<?php
		include("navbar.php");
		include("modal/registro_pago.php");
	?>  
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoPago"><span class="glyphicon glyphicon-plus" ></span> Pago</button>
				<button type="button" onclick="print(recibo)" class="btn btn-default"> 
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Agregar pago para Recibo No. <?php echo $_GET['idFactura']; ?></h4>
		</div>
			<div class="panel-body">

				<form class="form-horizontal" role="form" id="datos_pago">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Cliente</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="nombreCliente" disabled>
							</div>
						</div>
			
				</form>

				<!-- Mostramos el listado de pagos del recibo seleccionado -->
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>	
		
	</div>
	<hr>
	<?php
		include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	
  </body>
</html>


<script>

// Added By Jorge Manzano
$(document).ready(function(){

	// Carga los pagos realizados al recibo seleccionado
	load( recibo );

	// Al mostrar la ventana modal de pagos, posicionar el foco en la captura de la fecha
	$('body').on("shown.bs.modal",".modal", function(){
		// Obtener el saldo del recibo seleccionado
		var promise = obtenerSaldo( recibo );

		promise.success(function(data){
			var _saldo = data;
			$(".modal-body input#saldoPendiente").val(_saldo);
		    $(".modal-body input#montoPagar").val("0.00");
		    $(".modal-body input#datepicker1").focus();			
		});


	});

	// Resetear el contenido de la ventana modal de captura de pagos al cerrarla
	$('body').on("hidden.bs.modal",".modal", function(){

	    $(".modal-body input#datepicker1").val("");
	    $(".modal-body input#montoPagar").val("0.00");
	    $('#guardar_datos').attr("disabled", false);
	});

	// Inicializa el calendario
	$( "#datepicker1" ).datepicker();

})

// Carga la informacion de pagos de un recibo seleccionado
function load(page){
	var q= $("#q").val();
	$("#loader").fadeIn('slow');

	var promise = obtenerCliente( recibo );
	promise.success(function(data){
		$("#nombreCliente").val(data);
	});

	$.ajax({
		url:'./ajax/buscar_pagos.php?action=ajax&idFacturaPagar='+page,
			beforeSend: function(objeto){
				$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$('#loader').html('');
				$('[data-toggle="tooltip"]').tooltip({html:true});
			}
	})
}

// Se obtiene el saldo del recibo seleccionado
function obtenerSaldo( idRecibo )
{
	return $.ajax({

			type: "POST",
			url: "ajax/obtieneSaldo.php",
			data: {idRecibo:idRecibo},
	});
}

// Se obtiene el nombre del cliente asignado al recibo seleccionado
function obtenerCliente( idRecibo )
{
	return $.ajax({
			type : "POST",
			url  : "ajax/obtieneCliente.php",
			data : {idRecibo:idRecibo},
	});
}

// Se imprime el historial de pagos del recibo seleccionado
function print( idRecibo )
{
	VentanaCentrada('./pdf/documentos/pago_pdf.php?idRecibo='+idRecibo,'HistorialPagos','','1024','768','true');
	return false;
}

// Guardar pago
$( "#guardar_pago" ).submit(function( event ) {

  	let saldoPendiente = parseFloat($("input#saldoPendiente").val(),2);
  	let montoCapturado = parseFloat($("input#montoPagar").val(),2);

  	// Validar que el monto a pagar no exceda el saldo pendiente
  	if ( montoCapturado <= saldoPendiente && montoCapturado > 0 )
  	{
  		$('#guardar_datos').attr("disabled", true);

  		// Se manda la informacion capturada a la base de datos
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "ajax/nuevo_pago.php?action=save&idRecibo="+recibo,
			data: parametros,
			beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Guardando...");
			},
			success: function(datos){
				$("#resultados_ajax_productos").html(datos);
				// $('#guardar_datos').attr("disabled", false);
				load(recibo);
			}
		});
  	} else 
  	{
  		alert( "El monto capturado debe ser mayor a 0 o menor o igual al saldo pendiente..." );
  	}

  	event.preventDefault();
})

$( "#editar_producto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_producto.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var codigo_producto = $("#codigo_producto"+id).val();
			var nombre_producto = $("#nombre_producto"+id).val();
			var estado = $("#estado"+id).val();
			var precio_producto = $("#precio_producto"+id).val();
			$("#mod_id").val(id);
			$("#mod_codigo").val(codigo_producto);
			$("#mod_nombre").val(nombre_producto);
			$("#mod_precio").val(precio_producto);
			$("#mod_estado").val(estado);
		}
</script>