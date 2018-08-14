<section class="content-header">
    <h1>
        Días de solución <small> Información</small>
    </h1>

</section>

<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro Actualizado!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Registrar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            
            <p>Mediante este formulario Ud. puede establecer la cantidad de días para la solución de las incidencias</p>
                
            <form action="#" method="POST" id="form-dias">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="number" name="dias" class="form-control" min="1" required="required" value="<?php echo $configuracion->dias;?>">
                            <span class="input-group-addon" id="basic-addon2">Días</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-flat">Guardar</button>
                    </div>
                </div>
            
            </form>

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->

