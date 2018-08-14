
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permisos
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>
                        <form action="<?php echo base_url();?>configuraciones/permisos/update" method="POST">
                            <input type="hidden" name="idpermiso" value="<?php echo $permiso->id;?>">                 
                            <div class="form-group">
                                <label for="rol">Roles:</label>
                                <input type="text" name="rol" id="rol" class="form-control" value="<?php echo $permiso->rol?>" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label for="menu">Menus:</label>
                                <input type="text" name="rol" id="rol" class="form-control" value="<?php echo $permiso->menu?>" disabled="disabled">
                            </div>
                            <div class="form-group" style="display: <?php echo $menu->leer == 0 ? "none":"block"; ?>">
                                <label for="read">Leer:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="read" value="1" <?php echo $permiso->read == 1 ? "checked":"";?>>Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="read" value="0" <?php echo $permiso->read == 0 ? "checked":"";?>>No
                                </label>
                            </div>
                            <div class="form-group" style="display: <?php echo $menu->insertar == 0 ? "none":"block"; ?>">
                                <label for="read">Agregar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="insert" value="1" <?php echo $permiso->insert == 1 ? "checked":"";?>>Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="insert" value="0" <?php echo $permiso->insert == 0 ? "checked":"";?>>No
                                </label>
                            </div>
                            <div class="form-group" style="display: <?php echo $menu->editar == 0 ? "none":"block"; ?>">
                                <label for="read">Editar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="update" value="1" <?php echo $permiso->update == 1 ? "checked":"";?>>Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="update" value="0" <?php echo $permiso->update == 0 ? "checked":"";?>>No
                                </label>
                            </div>
                            <div class="form-group" style="display: <?php echo $menu->eliminar == 0 ? "none":"block"; ?>">
                                <label for="read">Eliminar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="delete" value="1" <?php echo $permiso->delete == 1 ? "checked":"";?>>Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="delete" value="0" <?php echo $permiso->delete == 0 ? "checked":"";?>>No
                                </label>
                            </div>
                             <div class="form-group">
                                <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
                                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
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
