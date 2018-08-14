<section class="content-header">
    <h1>
        Incidencias <small> Listado</small>
    </h1>

</section>

<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro Actualizado!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
        <input type="hidden" id="modulo" value="backend/incidencias">
    
        <div class="box-body">
            <?php if($permisos->insert == 1):?>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>backend/incidencias/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Incidencia</a>
                    </div>
                </div>
                <hr>
            <?php endif;?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tb-without-buttons">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Resumen</th>
                                    <th>Prioridad</th>

                                    <th>Reproducibilidad</th>
                                    <th>Estado</th>
                                    <th>Caso</th>
                                    <th>Ciclo</th>
                                    <th>Asignado a</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $reproducibilidad = ["Siempre", "Aveces", "Casi Nunca", "Irreproducible"];
                                    $estado = ["Exitoso", "Fallido", "Resuelto", "Asignado"];
                                 ?>

                                <?php if (!empty($incidencias)): ?>
                                    <?php foreach ($incidencias as $incidencia): ?>
                                        <tr>
                                            <td><?php echo $incidencia->id?></td>
                                            <td><?php echo $incidencia->resumen?></td>
                                            <td><?php echo $incidencia->prioridad?></td>
                                            <td><?php echo $reproducibilidad[$incidencia->reproducibilidad - 1];?></td>
                                            <td><?php echo $incidencia->estado;?></td>
                                            <td><?php echo $incidencia->nombre?></td>
                                            <td><?php echo $incidencia->ciclo?></td>
                                            <td><?php echo $incidencia->asignado;?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-flat btn-primary btn-view" value="<?php echo $incidencia->id?>" data-toggle="modal" data-target="#modal-default">
                                                        <span class="fa fa-eye"></span>
                                                    </button>
                                                    <?php if ($permisos->update == 1): ?>
                                                       <a href="<?php echo base_url()?>backend/incidencias/edit/<?php echo $incidencia->id;?>" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a> 
                                                    <?php endif ?>
                                                    
                                                </div>
                                            </td>

                                            

                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Incidencia</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->