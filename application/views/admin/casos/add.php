<section class="content-header">
    <h1>
        Casos de Pruebas <small>Registro</small>
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <form action="<?php echo base_url();?>ejecucion/casos/store" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6  col-xs-12">
                    
                        
                        <?php if ($this->session->flashdata("error")): ?>
                            <script>
                                swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
                            </script>
                        <?php endif ?>
                        <div class="form-group">
                            <label for="proyecto">Proyectos:</label>
                            <select name="proyecto" id="proyecto" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($proyectos as $proyecto): ?>
                                    <?php 
                                        $p = "";
                                        if ($this->session->userdata("proyecto")) {
                                            $p = $this->session->userdata("proyecto_id");
                                        }
                                    ?>
                                    <option value="<?php echo $proyecto->id;?>" <?php echo $proyecto->id == $p ? "selected":"";?>><?php echo $proyecto->nombre;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre del Caso:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required="">
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
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado" class="form-control" required="required">
                                <option value="">Seleccione...</option>
                                <?php foreach ($estados as $estado): ?>
                                    <?php $selected = strtolower($estado->descripcion) == "no ejecutado" ?"selected":""; ?>
                                    <option value="<?php echo $estado->id;?>" <?php echo $selected;?>><?php echo $estado->descripcion;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="precondicion">Precondicion:</label>
                            <textarea name="precondicion" id="precondicion" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="resultado">Resultado Esperado:</label>
                            <textarea name="resultado" id="resultado" class="form-control"></textarea>
                        </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-primary btn-flat" id="btn-add-paso">
                            Agregar Paso
                        </button>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered" id="tb-pasos">
                            <thead>
                                <tr>
                                    <th colspan="2">Pasos</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="guardar" class="btn btn-success btn-flat" value="Guardar">
                </div>
            </div>
        </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->