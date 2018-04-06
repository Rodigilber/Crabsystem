<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del cliente";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			$_POST['mod_estado']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));

		$initservprof=mysqli_real_escape_string($con,(strip_tags($_POST["mod_initservprof"],ENT_QUOTES)));
	 	$finservprof=mysqli_real_escape_string($con,(strip_tags($_POST["mod_finservprof"],ENT_QUOTES)));

		// $regfiscal=mysqli_real_escape_string($con,(strip_tags($_POST["mod_regfiscal"],ENT_QUOTES)));
				
		// Convierte los checkboxes seleccionados en una cadena separada por commas
		$_regimenFiscal = $_POST["regfiscal"];
		$seleccionados  = join( ',',$_regimenFiscal );
		$regfiscal      = $seleccionados;		


		$_obligacionfiscal = $_POST["obfiscal"];
		$obfseleccionados  = join( ',',$_obligacionfiscal );
		$obfiscal      = $obfseleccionados;

		$contabilidad=mysqli_real_escape_string($con,(strip_tags($_POST["mod_contabilidad"],ENT_QUOTES)));

		$obfiscales=mysqli_real_escape_string($con,(strip_tags($_POST["mod_obfiscales"],ENT_QUOTES)));
		
		$auxiliar=mysqli_real_escape_string($con,(strip_tags($_POST["mod_auxiliar"],ENT_QUOTES)));
		$rfc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_rfc"],ENT_QUOTES)));
		$contrdrfc=mysqli_real_escape_string($con,(strip_tags($_POST["mod_contrdrfc"],ENT_QUOTES)));
		$contrefirma=mysqli_real_escape_string($con,(strip_tags($_POST["mod_contrefirma"],ENT_QUOTES)));
		$expefirma=mysqli_real_escape_string($con,(strip_tags($_POST["mod_expefirma"],ENT_QUOTES)));
		$nrp=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nrp"],ENT_QUOTES)));
		$fielimss=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fielimss"],ENT_QUOTES)));
		$imsspatrones=mysqli_real_escape_string($con,(strip_tags($_POST["mod_imsspatrones"],ENT_QUOTES)));
		$infonapatrones=mysqli_real_escape_string($con,(strip_tags($_POST["mod_infonapatrones"],ENT_QUOTES)));

		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
		$estado=intval($_POST['mod_estado']);
		
		$id_cliente=intval($_POST['mod_id']);
		
		$sql="UPDATE clientes SET nombre_cliente='".$nombre."', 

								initservprof_clientes='".$initservprof."', 
								finservprof_clientes='".$finservprof."', 
	
								regimen_fiscal_cliente='".$regfiscal."', 
								contabilidad_cliente='".$contabilidad."', 
								obligaciones_fisc_cliente='".$regfiscal."', 
								auxiliar_cliente_cliente='".$auxiliar."', 
								rfc_cliente_cliente='".$rfc."', 
								contr_rfc_cliente='".$contrdrfc."', 
								contr_efirma_cliente='".$contrefirma."', 
								vigencia_efirma_cliente='".$expefirma."', 
								nrp_cliente='".$nrp."', 
								fiel_imss_cliente='".$fielimss."', 
								imss_patrones_cliente='".$imsspatrones."', 
								infonavit_patrones_cliente='".$infonapatrones."', 
	
	
								telefono_cliente='".$telefono."', 
								email_cliente='".$email."', 
								direccion_cliente='".$direccion."', 
								status_cliente='".$estado."'

			WHERE id_cliente='".$id_cliente."'";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Cliente ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}


		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>