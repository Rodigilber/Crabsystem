<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
	        } 

		        else if (!empty($_POST['nombre'])){
				/* Connect To Database*/
				require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
				require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));

				$initservprof=mysqli_real_escape_string($con,(strip_tags($_POST["initservprof"],ENT_QUOTES)));
				$finservprof=mysqli_real_escape_string($con,(strip_tags($_POST["finservprof"],ENT_QUOTES)));

				//$regfiscal=mysqli_real_escape_string($con,(strip_tags($_POST["regfiscal"],ENT_QUOTES)));
				// $regfiscal=implode(",",$_POST["regfiscal"]);

				// Added By Jorge Manzano
				// Convierte los checkboxes seleccionados en una cadena separada por commas
				$_regimenFiscal = $_POST["regfiscal"];
				$seleccionados  = join( ',',$_regimenFiscal );
				$regfiscal      = $seleccionados;

				$contabilidad=mysqli_real_escape_string($con,(strip_tags($_POST["contabilidad"],ENT_QUOTES)));
				//$obfiscales=mysqli_real_escape_string($con,(strip_tags($_POST["obfiscales"],ENT_QUOTES)));
				$obfiscales=implode(",",$_POST["obfiscales"]);
				$auxiliar=mysqli_real_escape_string($con,(strip_tags($_POST["auxiliar"],ENT_QUOTES)));
				$rfc=mysqli_real_escape_string($con,(strip_tags($_POST["rfc"],ENT_QUOTES)));
				$contrdrfc=mysqli_real_escape_string($con,(strip_tags($_POST["contrdrfc"],ENT_QUOTES)));
				$contrefirma=mysqli_real_escape_string($con,(strip_tags($_POST["contrefirma"],ENT_QUOTES)));
				$expefirma=mysqli_real_escape_string($con,(strip_tags($_POST["expefirma"],ENT_QUOTES)));
				$nrp=mysqli_real_escape_string($con,(strip_tags($_POST["nrp"],ENT_QUOTES)));
				$fielimss=mysqli_real_escape_string($con,(strip_tags($_POST["fielimss"],ENT_QUOTES)));
				$imsspatrones=mysqli_real_escape_string($con,(strip_tags($_POST["imsspatrones"],ENT_QUOTES)));
				$infonapatrones=mysqli_real_escape_string($con,(strip_tags($_POST["infonapatrones"],ENT_QUOTES)));
				$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
				$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
				$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
				$estado=intval($_POST['estado']);
				$date_added=date("Y-m-d H:i:s");
				//$obfiscales2 = implode(",",$_POST["obfiscales2"]);
			
				
				$sql="INSERT INTO clientes (nombre_cliente, initservprof_clientes, finservprof_clientes, regimen_fiscal_cliente,contabilidad_cliente,obligaciones_fisc_cliente,auxiliar_cliente_cliente,rfc_cliente_cliente,contr_rfc_cliente,contr_efirma_cliente,vigencia_efirma_cliente,nrp_cliente,fiel_imss_cliente,imss_patrones_cliente,infonavit_patrones_cliente,telefono_cliente, email_cliente, direccion_cliente, status_cliente, date_added) 
									VALUES ('$nombre', '$initservprof', '$finservprof','$regfiscal','$contabilidad','$obfiscales','$auxiliar','$rfc','$contrdrfc','$contrefirma','$expefirma','$nrp','$fielimss','$imsspatrones','$infonapatrones','$telefono','$email','$direccion','$estado','$date_added')";

									
				$query_new_insert = mysqli_query($con,$sql);
					if ($query_new_insert){
						$messages[] = "Cliente ha sido ingresado satisfactoriamente.";
					} else{ 
						$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
					}

				}

		 else {
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





