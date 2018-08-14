<section class="content-header">
    <h1>
        Casos de Pruebas <small>Editar</small>
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>ejecucion/casos/update" method="POST" enctype="multipart/form-data">
                        
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        <input type="hidden" name="idCaso" value="<?php echo $caso->id;?>">
                        <div class="form-group">
                            <label for="proyecto">Proyectos:</label>
                            <select name="proyecto" id="proyecto" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($proyectos as $proyecto): ?>
                                    <option value="<?php echo $proyecto->id;?>" <?php echo $proyecto->id == $caso->proyecto_id?"selected":"";?>><?php echo $proyecto->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre del Caso:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $caso->nombre;?>" required="required">
                        </div>
                        <div class="form-group">
                            <label for="ciclo">Ciclo:</label>
                            <select name="ciclo" id="ciclo" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <option value="1" <?php echo $caso->ciclo == 1?"selected":"";?>>1</option>
                                <option value="2" <?php echo $caso->ciclo == 2?"selected":"";?>>2</option>
                                <option value="3" <?php echo $caso->ciclo == 3?"selected":"";?>>3</option>
                            </select>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="precondicion">Precondicion:</label>
                            <textarea name="precondicion" id="precondicion" class="form-control"><?php echo $caso->precondicion?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="resultado">Resultado Esperado:</label>
                            <textarea name="resultado" id="resultado" class="form-control"><?php echo $caso->resultado?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
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