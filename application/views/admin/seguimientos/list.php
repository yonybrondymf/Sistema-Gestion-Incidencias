<section class="content-header">
    <h1>
        Seguimientos <small> Listado</small>
    </h1>

</section>


    
<!-- Main content -->
<section class="content">
    <?php foreach ($estados as $estado): ?>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Incidencias <?php echo $estado->descripcion;?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="tb-without-buttons" class="table no-margin">
                    <thead>
                        <tr>
                            <th>Nro Incidencia</th>
                            <th>Fecha de Registro</th>
                            <th>Fecha de Termino</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($estado->incidencias)): ?>
                            <?php foreach ($estado->incidencias as $incidencia): ?>
                                <tr>
                                    <td><?php echo $incidencia->id;?></td>
                                    <td><?php echo $incidencia->fecregistro;?></td>
                                    <?php $nuevafecha = strtotime ( '+'.$configuraciones->dias.' day' , strtotime ( $incidencia->fecregistro ) ) ;?>
                                    <td><?php echo  date( 'Y-m-d' , $nuevafecha); ?></td>
                                    <td><?php echo $estado->descripcion;?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-flat btn-historial" data-target="#modal-default" data-toggle="modal" value="<?php echo $incidencia->id;?>">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        
                        
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <?php endforeach ?>
</section>
<!-- /.content -->




<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Informacion de la Incidencia</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#historial" aria-controls="historial" role="tab" data-toggle="tab">Historial</a>

                    </li>
                    <li role="presentation"><a href="#cambio" aria-controls="cambio" role="tab" data-toggle="tab">Cambiar Estado</a>

                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="historial"></div>
                    <div role="tabpanel" class="tab-pane" id="cambio">
                        <br>
                        <form action="<?php echo base_url();?>backend/seguimientos/savecambio" method="POST">
                            <input type="hidden" name="idIncidencia" id="idIncidencia">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required="required">
                                    <option value="">Seleccione estado...</option>
                                    <?php foreach ($estados as $estado): ?>
                                        <option value="<?php echo $estado->id;?>"><?php echo $estado->descripcion;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comentario">Comentario</label>
                                <textarea name="comentario" id="comentario" rows="5" class="form-control" required="required"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Guardar" name="guardar" class="btn btn-success btn-flat">
                            </div>
                        </form>
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