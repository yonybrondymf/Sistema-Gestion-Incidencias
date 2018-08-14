<?php
            $reproducibilidad = ["Siempre", "Aveces", "Casi Nunca", "Irreproducible"];
           
         ?>
         <br>
<div class="panel-group" id="accordion">
    <?php $i=1;?>
    <?php foreach ($incidencias as $incidencia): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" class="panel-title expand">
                   <div class="right-arrow pull-right">+</div>
                    <a href="#">Incidencia #<?php echo $incidencia->id;?></a>
                </h4>
            </div>
          <div id="collapse<?php echo $i;?>" class="panel-collapse collapse">
            <div class="panel-body">
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
                        
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <?php $i++;?>
    <?php endforeach ?>
</div>