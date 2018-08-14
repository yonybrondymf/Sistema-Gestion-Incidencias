<section class="content-header">
    <h1>
        Proyectos <small> Listado</small>
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
        <input type="hidden" id="modulo" value="configuraciones/proyectos">
        <div class="box-body">
            <?php if ($permisos->insert == 1): ?>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>configuraciones/proyectos/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Proyecto</a>
                    </div>
                </div>
                <hr>
            <?php endif ?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tb-without-buttons">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Encargado</th>

                                    <th>Fecha Registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($proyectos as $p): ?>
                                    <tr>
                                        <td><?php echo $p->id?></td>
                                        <td><?php echo $p->nombre?></td>
                                        <td><?php echo $p->usuario?></td>
                                        <td><?php echo $p->fecregistro?></td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-flat btn-primary btn-view" value="<?php echo $p->id?>" data-toggle="modal" data-target="#modal-default">
                                                    <span class="fa fa-eye"></span>
                                                </button>
                                                <?php if ($permisos->update == 1): ?>
                                                    <a href="<?php echo base_url()?>configuraciones/proyectos/edit/<?php echo $p->id;?>" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                                                <?php endif ?>
                                                <?php if ($permisos->delete == 1): ?>
                                                    <a href="<?php echo base_url();?>configuraciones/proyectos/delete/<?php echo $p->id?>" class="btn btn-danger btn-flat btn-delete">
                                                    <span class="fa fa-times"></span>
                                                </a>
                                                <?php endif ?>
                                                
                                            </div>
                                            
                                        </td>

                                    </tr>
                                <?php endforeach ?>
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
        <h4 class="modal-title">Información del Proyecto</h4>
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