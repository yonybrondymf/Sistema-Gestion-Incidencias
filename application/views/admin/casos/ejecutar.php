<section class="content-header">
    <h1>
        Casos <small> Listado</small>
    </h1>

</section>


<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Bien Hecho!", "<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
        <input type="hidden" id="modulo" value="ejecucion/casos">
    
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tb-without-buttons">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Ciclo</th>
                                    <th>Proyecto</th>
                                    <th>Fecha de Creación</th>

                                    <th>Estado</th>
                                    <th>Fecha de Ejecución</th>

                                    
                                    
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php if (!empty($casos)): ?>
                                    <?php foreach ($casos as $c): ?>
                                        <?php $dataCaso = $c->nombre."*".$c->ciclo; ?>
                                        <tr>
                                            <td><?php echo $c->id?></td>
                                            <td><?php echo $c->nombre?></td>
                                            <td><?php echo $c->ciclo;?></td>
                                            <td><?php echo $c->proyecto?></td>
                                            
                                            <td><?php echo $c->fecregistro?></td>
                                            <td><?php echo $c->descripcion?></td>
                                            <td><?php echo $c->fecejecucion?></td>
                                            <td>
                                            
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-flat btn-primary btn-view-caso" value="<?php echo $c->id."*".$c->estado;?>" data-toggle="modal" data-target="#modal-default" title="Ver">
                                                        <span class="fa fa-eye"></span>
                                                    </button>
                                                    <?php if ($permisos->update == 1): ?>
                                                        <a href="<?php echo base_url()?>ejecucion/casos/edit/<?php echo $c->id;?>" class="btn btn-warning btn-flat" title="Editar"><i class="fa fa-pencil"></i></a>
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
                <h4 class="modal-title">Informacion del Caso</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Información</a></li>
                    <li><a data-toggle="tab" href="#menu1">Historial de Cambios</a></li>
                    <li><a data-toggle="tab" href="#menu3">Incidencias Asociadas</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                    
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <br>
                        <table class="table" id="tb-historial">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
               
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-reportar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Reportar Incidencia</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url();?>backend/incidencias/store" method="POST">
                    <input type="hidden" name="modulo" value="ejecucion">
                    <input type="hidden" name="caso" id="caso">
                    <div class="form-group">
                            <label for="resumen">Resumen:</label>
                            <textarea name="resumen" id="resumen" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioridad:</label>
                            <select name="prioridad" id="prioridad" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reproducibilidad">Reproducibilidad:</label>
                            <select name="reproducibilidad" id="reproducibilidad" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <option value="1">Siempre</option>
                                <option value="2">Aveces</option>
                                <option value="3">Casi Nunca</option>
                                <option value="4">Irreproducible</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($estadosIncidencias as $e): ?>
                                    <option value="<?php echo $e->id;?>"><?php echo $e->descripcion;?></option>
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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asignado">Asignado:</label>
                            <select name="asignado" id="asignado" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <option value="<?php echo $usuario->id ?>"><?php echo $usuario->nombres." ".$usuario->apellidos ?></option>
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <textarea name="descripcion" id="descripcion" class="summernote"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comentario">Comentario:</label>
                            <textarea name="comentario" id="comentario" class="form-control"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                        </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->