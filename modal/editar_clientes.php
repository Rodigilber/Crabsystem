	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>



			<div class="form-group">
				<label for="mod_initservprof" class="col-sm-3 control-label">INICIO DE SERV. PROF.</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_initservprof" name="mod_initservprof" >
				</div>
			  </div>

			  <div class="form-group">
				<label for="mod_finservprof" class="col-sm-3 control-label">FIN DE SERV. PROF.</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_finservprof" name="mod_finservprof" >
				</div>
			  </div>

<!--

			<div class="form-group">
				<label for="mod_regfiscal" class="col-sm-3 control-label">RÉGIMEN FISCAL </label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_regfiscal" name="mod_regfiscal" >
					<option value="" selected>-- Selecciona un regimen --</option>
					<option value="RIF" >RIF</option>
					<option value="PF con Activ. Emp. y Prof.">PF con Activ. Emp. y Prof.</option>
					<option value="Régimen de Arrendamiento">Régimen de Arrendamiento</option>
					<option value="Sector Primario">Sector Primario</option>
					<option value="Reg. De Sueldos y Salarios">Reg. De Sueldos y Salarios</option>
				  </select>
				</div>
			  </div>

-->


<!-- 			 <div class="form-group">
				<label for="mod_regfiscal" class="col-sm-3 control-label">RÉGIMEN FISCAL</label>
				<div class="col-sm-8">
				  <input type="checkbox" name="mod_regfiscal[]" value="RIF" />RIF<br />
				  <input type="checkbox" name="mod_regfiscal[]" value="PF con Activ. Emp. y Prof." />PF con Activ. Emp. y Prof.<br />
				  <input type="checkbox" name="mod_regfiscal[]" value="Régimen de Arrendamiento" />Régimen de Arrendamiento<br />
				  <input type="checkbox" name="mod_regfiscal[]" value="Sector Primario" />Sector Primario<br />
				  <input type="checkbox" name="mod_regfiscal[]" value="Reg. De Sueldos y Salarios" />Reg. De Sueldos y Salarios<br />		 
				</div>
			  </div> -->


				<!-- Regimenes Fiscales -->
   				<div class="form-group">
					<label for="regfiscal" class="col-sm-3 control-label">RÉGIMEN FISCAL</label>
					<div class="col-sm-8">

						<?php
						
							// Added By Jorge Manzano
							// Mostrar de forma dinamica la lista de regimenes guardados en la tabla tblregimenes
							$sql   = "Select * from tblregimenes";
							$query = mysqli_query($con, $sql);

							while ($row=mysqli_fetch_array($query)) {
							?>

								<input type="checkbox" name="regfiscal[]" id="<?php echo $row['idRegimen'] ?>_checkbox" value="<?php echo $row['idRegimen'] ?>" /> <?php echo $row["regimen"] ?><br />

							<?php

							}

						?>
		 
					</div>
			  	</div>

			<div class="form-group">
				<label for="mod_contabilidad" class="col-sm-3 control-label">CONTABILIDAD </label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_contabilidad" name="mod_contabilidad" >
					<option value="" selected>-- Selecciona una opcion --</option>
					<option value="DESC. XML" >DESC. XML</option>
					<option value="CONTPAQ">CONTPAQ</option>
				  </select>
				</div>
			  </div>

<!--
			  	<div class="form-group">
				<label for="mod_obfiscales" class="col-sm-3 control-label">OBLIGACIONES FISCALES </label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_obfiscales" name="mod_obfiscales" >
					<option value="" selected>-- Selecciona una opcion --</option>
					<option value="ISR" >ISR</option>
					<option value="IVA">IVA</option>
					<option value="IEPS">IEPS</option>
					<option value="ISR POR SUELDOS Y SALARIOS">ISR POR SUELDOS Y SALARIOS</option>
					<option value="ISR RETENIDO">ISR RETENIDO</option>
					<option value="IVA RETENIDO AL 16%">IVA RETENIDO AL 16%</option>
					<option value="IVA RETENIDO AL 4%">IVA RETENIDO AL 4%</option>
				  </select>
				</div>
			  </div>




 			<div class="form-group">
				<label for="mod_obfiscales" class="col-sm-3 control-label">OBLIGACIONES FISCALES</label>
				<div class="col-sm-8">
				  <input type="checkbox" name="mod_obfiscales[]" value="ISR" />ISR<br />
				  <input type="checkbox" name="mod_obfiscales[]" value="IVA" />IVA<br />
				  <input type="checkbox" name="mod_obfiscales[]" value="IEPS" />IEPS<br />
				  <input type="checkbox" name="mod_obfiscales[]" value="ISR POR SUELDOS Y SALARIOS" />ISR POR SUELDOS Y SALARIOS<br />
				  <input type="checkbox" name="mod_obfiscales[]" value="ISR RETENIDO" />ISR RETENIDO<br /> 
				  <input type="checkbox" name="mod_obfiscales[]" value="IVA RETENIDO AL 16%" />IVA RETENIDO AL 16%<br /> 
				  <input type="checkbox" name="mod_obfiscales[]" value="IVA RETENIDO AL 4%" />IVA RETENIDO AL 4%<br /> 
				</div>
			  </div>

-->

	<!-- Obligaciones Fiscales -->
   				<div class="form-group">
					<label for="obfiscales" class="col-sm-3 control-label">OBLIGACIONES FISCALES</label>
					<div class="col-sm-8">

						<?php

							// Added By 
							// Mostrar de forma dinamica la lista de Obligaciones guardados en la tabla tblObligaciones
							$sql   = "Select * from tblobligaciones";
							$query = mysqli_query($con, $sql);

							while ($row=mysqli_fetch_array($query)) {
							?>

								<input type="checkbox" name="obfiscal[]" id="<?php echo $row['idobligacion'] ?>_checkbox" value="<?php echo $row['idobligacion'] ?>" /> <?php echo $row["obligacion"] ?><br />

							<?php

							}

						?>
		 
					</div>
			  	</div>




			  <div class="form-group">
				<label for="mod_auxiliar" class="col-sm-3 control-label">AUXILIAR</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_auxiliar" name="mod_auxiliar" >
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="mod_rfc" class="col-sm-3 control-label">RFC</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_rfc" name="mod_rfc" >
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="mod_contrdrfc" class="col-sm-3 control-label">CONTRASEÑA DEL RFC</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_contrdrfc" name="mod_contrdrfc" >
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="mod_contrefirma" class="col-sm-3 control-label">CONTRASEÑA E-FIRMA</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_contrefirma" name="mod_contrefirma" >
				</div>
			  </div>

			  		<div class="form-group">
				<label for="mod_expefirma" class="col-sm-3 control-label">VIGENCIA E-FIRMA</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_expefirma" name="mod_expefirma" >
				</div>
			  </div>

			  <div class="form-group">
				<label for="mod_nrp" class="col-sm-3 control-label">NRP</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nrp" name="mod_nrp" >
				</div>
			  </div>
		
			<div class="form-group">
				<label for="mod_fielimss" class="col-sm-3 control-label">FIEL IMSS</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_fielimss" name="mod_fielimss"   maxlength="255" ></textarea> 
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="mod_imsspatrones" class="col-sm-3 control-label">IMSS PATRONES</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_imsspatrones" name="mod_imsspatrones"   maxlength="255" ></textarea> 
				</div>
			  </div>
	
			<div class="form-group">
				<label for="mod_infonapatrones" class="col-sm-3 control-label">INFONAVIT PATRONES</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_infonapatrones" name="mod_infonapatrones"   maxlength="255" ></textarea> 
				</div>
			  </div>	








			   <div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_telefono" name="mod_telefono">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				 <input type="email" class="form-control" id="mod_email" name="mod_email">
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_direccion" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="mod_direccion" name="mod_direccion" ></textarea>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_estado" name="mod_estado" >
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div>
			 	
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>