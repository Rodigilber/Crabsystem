		$(document).ready(function(){
			load(1);

			// Al seleccionar un filtro por status de factura realizar la busqueda 
			$("#estado").change(function(){
				load(1);
			})
			
		});


//once the page Factura is loaded the table with faturas is filled up by this,
//adding in each row  the corresponding buttons one of the is Edit, which take the  factura  id and take us to editar factura. 
		function load(page){
			var q= $("#q").val();

			// Estado del Recibo
			let status = $("#estado").val(); // 2 - Todos, 0 - Pagado, 1 - Pendiente

			$("#loader").fadeIn('slow');

			$.ajax({
				url:'./ajax/buscar_facturas.php?action=ajax&page='+page+'&q='+q+'&status='+status,
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

	
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar la factura")){	
				$.ajax({
		        type: "GET",
		        url: "./ajax/buscar_facturas.php",
		        data: "id="+id,"q":q,
				 beforeSend: function(objeto){
					$("#resultados").html("Mensaje: Cargando...");
				  },
		        success: function(datos){
				$("#resultados").html(datos);
				load(1);
				}
					});
		}
		}
		
		function imprimir_factura(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
