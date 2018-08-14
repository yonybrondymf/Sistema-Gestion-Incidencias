<section class="content-header">
    <h1>
        Incidencias <small>Editar</small>
    </h1>
    

</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>backend/incidencias/update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idIncidencia" value="<?php echo $incidencia->id;?>">
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        <div class="form-group">
                            <label for="resumen">Resumen:</label>
                            <textarea name="resumen" id="resumen" class="form-control"><?php echo $incidencia->resumen;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioridad:</label>
                            <select name="prioridad" id="prioridad" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <option value="1" <?php echo $incidencia->prioridad == 1?"selected":"";?>>1</option>
                                <option value="2" <?php echo $incidencia->prioridad == 2?"selected":"";?>>2</option>
                                <option value="3" <?php echo $incidencia->prioridad == 3?"selected":"";?>>3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reproducibilidad">Reproducibilidad:</label>
                            <select name="reproducibilidad" id="reproducibilidad" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <option value="1" <?php echo $incidencia->reproducibilidad == 1?"selected":"";?>>Siempre</option>
                                <option value="2" <?php echo $incidencia->reproducibilidad == 2?"selected":"";?>>Aveces</option>
                                <option value="3" <?php echo $incidencia->reproducibilidad == 3?"selected":"";?>>Casi Nunca</option>
                                <option value="4" <?php echo $incidencia->reproducibilidad == 4?"selected":"";?>>Irreproducible</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($estados as $estado): ?>
                                    <option value="<?php echo $estado->id;?>" <?php echo $incidencia->estado == $estado->id?"selected":"";?>><?php echo $estado->descripcion;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="adjunto">Adjunto:</label>
                            <input type="file" name="adjunto" id="adjunto" class="form-control" accept=".doc, .docx">
                        </div>
                        <div class="form-group">
                            <label for="ciclo">Ciclo:</label>
                            <select name="ciclo" id="ciclo" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <option value="1" <?php echo $incidencia->ciclo == 1?"selected":"";?>>1</option>
                                <option value="2" <?php echo $incidencia->ciclo == 2?"selected":"";?>>2</option>
                                <option value="3" <?php echo $incidencia->ciclo == 3?"selected":"";?>>3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asignado">Asignado:</label>
                            <select name="asignado" id="asignado" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario->id ?>" <?php echo $usuario->id==$incidencia->asignado?"selected":"";?>><?php echo $usuario->nombres." ".$usuario->apellidos ?></option>
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $incidencia->email;?>">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <textarea name="descripcion" id="descripcion" class="summernote"><?php echo $incidencia->descripcion;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comentario">Comentario:</label>
                            <textarea name="comentario" id="comentario" class="form-control"><?php echo $incidencia->comentario;?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                            <a href="<?php echo base_url();?>incidencias" class="btn btn-danger btn-flat">
                                Volver
                            </a>
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