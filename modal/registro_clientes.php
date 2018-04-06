	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>


				<div class="form-group">
				<label for="ncontribuyente" class="col-sm-3 control-label"># DE CONTRIBUYENTES</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="ncontribuyente" name="ncontribuyente">
				</div>
			  </div>

			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required>
				</div>
			  </div>

			  	<div class="form-group">
				<label for="initservprof" class="col-sm-3 control-label">INICIO DE SERV. PROF.</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="datepicker1" name="initservprof" >
				</div>
			  </div>

			  <div class="form-group">
				<label for="finservprof" class="col-sm-3 control-label">FIN DE SERV. PROF.</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="datepicker2" name="finservprof" >
				</div>
			  </div>

<!--
				<div class="form-group">
				<label for="regfiscal" class="col-sm-3 control-label">RÉGIMEN FISCAL </label>
				<div class="col-sm-8">
				 <select class="form-control" id="regfiscal" name="regfiscal" >
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

								<input type="checkbox" name="regfiscal[]" id="<?php echo $row['idRegimen'] ?>._checkbox" value="<?php echo $row['idRegimen'] ?>" /> <?php echo $row["regimen"] ?><br />

							<?php

							}

						?>
		 
					</div>
			  	</div>


			  <div class="form-group">
				<label for="contabilidad" class="col-sm-3 control-label">CONTABILIDAD </label>
				<div class="col-sm-8">
				 <select class="form-control" id="contabilidad" name="contabilidad" >
					<option value="" selected>-- Selecciona una opcion --</option>
					<option value="DESC. XML" >DESC. XML</option>
					<option value="CONTPAQ">CONTPAQ</option>
				  </select>
				</div>
			  </div>

<!--
			  	<div class="form-group">
				<label for="obfiscales" class="col-sm-3 control-label">OBLIGACIONES FISCALES </label>
				<div class="col-sm-8">
				 <select class="form-control" id="obfiscales" name="obfiscales" >
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
				<label for="obfiscales" class="col-sm-3 control-label">OBLIGACIONES FISCALES</label>
				<div class="col-sm-8">
				  <input type="checkbox" name="obfiscales[]" value="ISR" />ISR<br />
				  <input type="checkbox" name="obfiscales[]" value="IVA" />IVA<br />
				  <input type="checkbox" name="obfiscales[]" value="IEPS" />IEPS<br />
				  <input type="checkbox" name="obfiscales[]" value="ISR POR SUELDOS Y SALARIOS" />ISR POR SUELDOS Y SALARIOS<br />
				  <input type="checkbox" name="obfiscales[]" value="ISR RETENIDO" />ISR RETENIDO<br /> 
				  <input type="checkbox" name="obfiscales[]" value="IVA RETENIDO AL 16%" />IVA RETENIDO AL 16%<br /> 
				  <input type="checkbox" name="obfiscales[]" value="IVA RETENIDO AL 4%" />IVA RETENIDO AL 4%<br /> 
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

								<input type="checkbox" name="obfiscal[]" id="<?php echo $row['idobligacion'] ?>._checkbox" value="<?php echo $row['idobligacion'] ?>" /> <?php echo $row["obligacion"] ?><br />

							<?php

							}

						?>
		 
					</div>
			  	</div>



			  <div class="form-group">
				<label for="auxiliar" class="col-sm-3 control-label">AUXILIAR</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="auxiliar" name="auxiliar" >
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="rfc" class="col-sm-3 control-label">RFC</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="rfc" name="rfc" >
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="contrdrfc" class="col-sm-3 control-label">CONTRASEÑA DEL RFC</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="contrdrfc" name="contrdrfc" >
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="contrefirma" class="col-sm-3 control-label">CONTRASEÑA E-FIRMA</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="contrefirma" name="contrefirma" >
				</div>
			  </div>

			  		<div class="form-group">
				<label for="expefirma" class="col-sm-3 control-label">VIGENCIA E-FIRMA</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="datepicker3" name="expefirma" >
				</div>
			  </div>
     

			  <div class="form-group">
				<label for="nrp" class="col-sm-3 control-label">NRP</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nrp" name="nrp" >
				</div>
			  </div>
		
				<div class="form-group">
				<label for="fielimss" class="col-sm-3 control-label">FIEL IMSS</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="fielimss" name="fielimss"   maxlength="255" ></textarea> 
				</div>
			  </div>
			  
			  	<div class="form-group">
				<label for="imsspatrones" class="col-sm-3 control-label">IMSS PATRONES</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="imsspatrones" name="imsspatrones"   maxlength="255" ></textarea> 
				</div>
			  </div>
	
				<div class="form-group">
				<label for="infonapatrones" class="col-sm-3 control-label">INFONAVIT PATRONES</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="infonapatrones" name="infonapatrones"   maxlength="255" ></textarea> 
				</div>
			  </div>			  

			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefonoX" name="telefono" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" name="email" >
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="direccion" name="direccion"   maxlength="255" ></textarea>
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				 <select class="form-control" id="estado" name="estado" >
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div>
			 		
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>