<section class="content-header">
    <h1>
        Usuarios <small> Editar</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>configuraciones/usuarios/store" method="POST">
                        
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Actualizar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        
                        <div class="form-group">
                            <label for="">Cedula:</label>
                            <input type="text" name="cedula" id="cedula" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required="required" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" class="form-control" required="required" id="password">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select name="rol" id="rol" required class="form-control">
                                <option value="">Seleccione Rol</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?php echo $rol->id?>"><?php echo $rol->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div >
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                            <a href="<?php echo base_url();?>configuraciones/usuarios" class="btn btn-danger btn-flat"> Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->