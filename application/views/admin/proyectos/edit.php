<section class="content-header">
    <h1>
        Proyectos <small>Editar</small>
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>configuraciones/proyectos/update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idProyecto" value="<?php echo $proyecto->id;?>">
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        <div class="form-group">
                            <label for="nombre">Nombre del Proyecto:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required="required" value="<?php echo $proyecto->nombre;?>">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <select name="usuario" id="usuario" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($usuarios as $u): ?>
                                    <option value="<?php echo $u->id;?>" <?php echo $u->id==$proyecto->usuario_id?"selected":"";?>><?php echo $u->nombres." ".$u->apellidos?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                            <a href="<?php echo base_url();?>configuraciones/proyectos" class="btn btn-danger btn-flat">Volver</a>
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