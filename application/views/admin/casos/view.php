<div class="row">
	<div class="col-xs-12">
		<br>
		<form action="<?php echo base_url();?>ejecucion/casos/updatePasos" method="POST" id="form-updatePasos" enctype="multipart/form-data">
			<input type="hidden" name="idCaso" value="<?php echo $caso->id;?>">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">ID</th>
					<td><?php echo $caso->id; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Proyecto</th>
					<td><?php echo $caso->proyecto; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Nombre</th>
					<td><?php echo $caso->nombre; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $caso->descripcion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Fecha de Creación</th>
					<td><?php echo $caso->fecregistro; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Ciclo</th>
					<td><?php echo $caso->ciclo; ?></td>
				</tr>
				
				
				<tr>
					<th style="background-color: #f4f4f4;">Precondicion</th>
					<td><?php echo $caso->precondicion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Resultado Esperado</th>
					<td><?php echo $caso->resultado; ?></td>
				</tr>

				<tr>
					<th style="background-color: #f4f4f4;">Fecha de Ejecución</th>
					<td><?php echo $caso->fecejecucion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Pasos</th>
					<td>
						<?php $i=1;?>
						<?php foreach ($pasos as $p): ?>
							<div class="form-group">
								<label for=""><?php echo $i.". ".$p->titulo;?></label>
								<?php if (!empty($p->imagen)): ?>
									<img src="<?php echo base_url();?>assets/images/pasos/<?php echo $p->imagen;?>" alt="" class="img-responsive">
								<?php else: ?>
									<input type="hidden" name="pasos[]" value="<?php echo $p->id?>">
									<input type="file" name="archivo[]" required="required" class="form-control">
								<?php endif ?>
								
							</div>
							<?php $i++;?>
						<?php endforeach ?>
					</td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Cambiar Estado</th>
					<td>
						<select name="estado" id="estado" class="form-control" required="required">
                            <option value="">Seleccione Estado</option>
                            <?php foreach ($estados as $e): ?>
                                <option value="<?php echo $e->id?>"><?php echo $e->descripcion?></option>
                            <?php endforeach ?>
                        </select>
					</td>

				</tr>
				
			</tbody>
		</table>
		<button type="submit" class="btn btn-success btn-flat">Guardar</button>
		</form>
	</div>
</div>