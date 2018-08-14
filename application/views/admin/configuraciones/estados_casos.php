<section class="content-header">
    <h1>
        Estados de Casos <small> Listado</small>
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
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-9">
                    <?php if ($permisos->insert == 1): ?>
                        <button type="button" class="btn btn-primary btn-flat btn-add-estado" data-toggle="modal" data-target="#modal-default">Agregar Estado</button>
                        <hr>
                    <?php endif ?>
                    
                    <table id="tb-without-buttons" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripcion</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($estados)) :?>
                                <?php foreach ($estados as $estado): ?>
                                    <tr>
                                        <td><?php echo $estado->id;?></td>
                                        <td><?php echo $estado->descripcion;?></td>
                                        <td>
                                            <?php if ($permisos->update == 1): ?>
                                                <button type="button" class="btn btn-warning btn-flat btn-edit-estado" value="<?php echo $estado->id."*".$estado->descripcion;?>" data-toggle="modal" data-target="#modal-default">
                                                    <span class="fa fa-pencil"></span>
                                                </button>
                                            <?php endif ?>
                                            <?php if ($permisos->delete == 1): ?>
                                                    <a href="<?php echo base_url();?>configuraciones/estadoscasos/delete/<?php echo $estado->id?>" class="btn btn-danger btn-flat btn-delete">
                                                    <span class="fa fa-times"></span>
                                                </a>
                                                <?php endif ?>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif;?>
                        </tbody>
                    </table>
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
        <h4 class="modal-title">Información Estado</h4>
      </div>
      <form action="<?php echo base_url();?>configuraciones/estadoscasos/save" method="POST" id="form-estado">
      <div class="modal-body">
        <div class="alert alert-error alert-dismissible" id="error" style="display: none">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <div class="msgerror"></div>
          
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required="">
            <input type="hidden" name="idEstado" id="idEstado">
        </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-flat"> Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->