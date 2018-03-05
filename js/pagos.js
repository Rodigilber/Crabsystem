		$(document).ready(function(){
			load(1);

			// Inicializa el calendario
			$( "#datepicker1" ).datepicker();
		});


//once the page Factura is loaded the table with faturas is filled up by this,
//adding in each row  the corresponding buttons one of the is Edit, which take the  factura  id and take us to editar factura. 
		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');

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

