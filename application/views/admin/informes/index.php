<section class="content-header">
    <h1>
        Descargar <small>Informe</small>
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-sm-8 col-xs-12">
                    <form action="<?php echo base_url();?>backend/informes/exportar" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">¿Qué desea descargar?</label>
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label><input type="radio" name="modulo" value="1" required="required">Incidencias</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="modulo" value="2">Casos</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Generar Excel">
                            
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