<section class="content-header">
    <h1>
        Usuarios <small> Listado</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">  
            <?php if ($permisos->insert == 1): ?>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>configuraciones/usuarios/add" class="btn btn-primary btn-flat">
                            <span class="fa fa-plus"></span> Agregar Usuario
                        </a>
                    </div>
                </div> 
                <hr>
            <?php endif ?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="tb-without-buttons" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cedula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Cambiar Contraseña</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?php echo $usuario->id?></td>
                                        <td><?php echo $usuario->cedula?></td>
                                        <td><?php echo $usuario->nombres?></td>
                                        <td><?php echo $usuario->apellidos?></td>
                                        <td><?php echo $usuario->email?></td>
                                        <td><button id="change-password" type="buttton" value="<?php echo $usuario->id;?>" class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-cogs"></i> Cambiar Contraseña</button></td>
                                        <td><?php echo $usuario->nombre?></td>
                                        <td><?php echo $usuario->estado == 0 ? "Inactivo":"activo";?></td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <?php if ($permisos->update == 1): ?>
                                                    <a href="<?php echo base_url()?>configuraciones/usuarios/edit/<?php echo $usuario->id;?>" class="btn btn-warning btn-flat"><i class="fa fa-pencil"></i></a>
                                                <?php endif ?>
                                                <?php if ($permisos->delete == 1): ?>
                                                    <a href="<?php echo base_url();?>configuraciones/usuarios/delete/<?php echo $usuario->id?>" class="btn btn-danger btn-flat btn-delete">
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
        <h4 class="modal-title">Cambio de Contraseña</h4>
      </div>
      <form action="#" method="POST" id="form-change-password">
      <div class="modal-body">
        <input type="hidden" name="idusuario">
        <div class="error"></div>
        <div class="form-group">
            <label for="">Nueva Contraseña:</label>
            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nueva Contraseña" required>
        </div>
        <div class="form-group">
            <label for="">Repetir Nueva Contraseña:</label>
            <input type="password" class="form-control" name="repeatpassword" id="newpassword" placeholder="Repetir Nueva Contraseña" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->