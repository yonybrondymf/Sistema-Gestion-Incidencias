<br>


<?php if (!empty($historial)): ?>
	<?php $i = 1;?>
	<?php foreach ($historial as $h): ?>
		<div class="panel <?php echo $i == 1 ? "panel-default":"panel-primary";?>">
		    <div class="panel-heading">
		    	<b><?php echo $h->nombres." ".$h->apellidos;?> </b>establecio la incidencia como <b><?php echo $h->descripcion ?></b>
		    </div>
		    <div class="panel-body">
		    	<p><?php echo $h->comentario; ?><br>
					<span class="pull-right"><i class="fa fa-calendar"></i> <?php echo $h->fecha;?></span>
		    	</p>
		    </div>
		</div>
		<?php $i++;?>
	<?php endforeach ?>
<?php endif ?>