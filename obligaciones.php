<?php
	/*-------------------------
	Autor: Rodigilber Gonzalez
	
	Mail: rodigilber.gonzalez@gmail.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_pagos   = "";
	$title="obligaciones | ControlSys";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
		include("navbar.php");
		include("modal/registro_obligaciones.php");
		// include("modal/editar_productos.php");	
	?>

    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevaObligacion"><span class="glyphicon glyphicon-plus" ></span> Nueva Obligacion fiscal</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Obligacion </h4>
		</div>
		<div class="panel-body">

			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Código o nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Código o nombre del regimen" onkeyup='load($(this).val());'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load( $("#q").val() );'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
			</form>

			<div id="resultados"></div><!-- Carga los datos ajax -->
			<div class='outer_div'></div><!-- Carga los datos ajax -->
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<!-- <script type="text/javascript" src="js/productos.js"></script> -->
  </body>
</html>

<script>

// Added By Rgonzalez
$(document).ready(function(){

	// Carga los pagos realizados al recibo seleccionado
	load(0);

	// Activar el Menu
	$(".catalogos").addClass("active");

	// Al mostrar la ventana modal de pagos, posicionar el foco en la captura de la fecha
	$('body').on("shown.bs.modal",".modal", function(){

		    $(".modal-body input#codigo").focus();			

	});

	// Resetear el contenido de la ventana modal de captura de pagos al cerrarla
	$('body').on("hidden.bs.modal",".modal", function(){
		
		$(".alert").alert('close')
	    $(".modal-body input#codigo").val("");
	    $(".modal-body input#descripcion").val("");

	});

})

// Carga la informacion de pagos de un recibo seleccionado
function load(search){
	$("#loader").fadeIn('slow');

	$.ajax({
		url:'./ajax/buscar_obligacion.php?action=ajax&search='+search,
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

// Guardar 
$( "#guardar_obligacion" ).submit(function( event ) {

  		// $('#guardar_regimen').attr("disabled", true);

  		// Se manda la informacion capturada a la base de datos
		var parametros = $(this).serialize();
		let hidden     = $("#idobligacion").val();
		let action     = ( hidden != "0" ) ? "edit" : "save";

		$.ajax({
			type: "POST",
			url: "ajax/nuevo_obligacion.php?action="+action,
			data: parametros,
			beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Guardando...");
			},
			success: function(datos){
				$("#resultados_ajax_productos").html(datos);
				$(this).prop("disabled",true);
				$("#idRegimen").val(0);
				load(0);
			}
		});

  	event.preventDefault();
})

function editarRegimen(idobligacion)
{

	$.ajax({
		type: "POST",
		url: "ajax/obtieneObligacion.php",
		data: {idobligacion:idobligacion},
		success: function(datos){

			// Abrir la ventana modal para modificacion delos regimenes
			$('#nuevaObligacion').modal();

			$("#codigo").val(datos.claveobligacion);
			$("#descripcion").val(datos.obligacion);
			$("#idobligacion").val(datos.idobligacion);	

		}
	});

}

// Eliminar Regimen
function eliminarRegimen(idRegimen)
{
	if( confirm("Esta seguro de eliminar el regimen selecccionado?") )
	{
		$.ajax({
			type: "POST",
			url: "ajax/nuevo_regimen.php?action=delete",
			data: {idRegimen:idRegimen},
			success: function(datos){
				alert("Regimen Eliminado exitosamente!");
				load(0);
			}
		});

	}

}

</script>