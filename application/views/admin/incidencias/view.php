<div class="row">
	<div class="col-xs-12">
		<?php
            $reproducibilidad = ["Siempre", "Aveces", "Casi Nunca", "Irreproducible"];
           
         ?>
		
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th style="background-color: #f4f4f4;">Resumen</th>
					<td><?php echo $incidencia->resumen; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Prioridad</th>
					<td><?php echo $incidencia->prioridad; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Reproducibilidad</th>
					<td><?php echo $reproducibilidad[$incidencia->reproducibilidad-1]; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Estado</th>
					<td><?php echo $incidencia->estado; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Email</th>
					<td><?php echo $incidencia->email; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Adjunto</th>
					<td>
						<a href="<?php echo base_url();?>incidencias/download/<?php echo $incidencia->adjunto; ?>">
							<?php echo $incidencia->adjunto; ?>
						</a>
						
							
					</td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Ciclo</th>
					<td><?php echo $incidencia->ciclo; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Asignado a</th>
					<td><?php echo $incidencia->asignado; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Descripcion</th>
					<td class="celda-descripcion"><?php echo $incidencia->descripcion; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Comentario</th>
					<td><?php echo $incidencia->comentario; ?></td>
				</tr>
				<tr>
					<th style="background-color: #f4f4f4;">Caso</th>
					<td><?php echo $incidencia->nombre; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>