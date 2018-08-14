<section class="content-header">
    <h1>
        Avances <small>Proyecto</small>
    </h1>


</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <?php $cicloselected = ($ciclo) ? $ciclo:""; ?>
            <div class="row">
                <form action="<?php echo current_url();?>" method="POST">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="">Ciclo:</label>
                        <select name="ciclo" id="ciclo" class="form-control">
                            <option value="">Seleccione ciclo..</option>
                            <option value="1" <?php echo $cicloselected==1?"selected":"";?>>1</option>
                            <option value="2" <?php echo $cicloselected==2?"selected":"";?>>2</option>
                            <option value="3" <?php echo $cicloselected==3?"selected":"";?>>3</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="filtrar" value="Filtrar" class="btn btn-success btn-flat">
                    </div>
                </div>
                </form>
                <div class="col-md-4">
                    <table class="table table-bordered" id="tb-casos">
                        <tbody>
                            <tr>
                                <th>Total de Casos</th>
                                <td><?php echo count($totalCasos);?></td>
                            </tr>
                            <?php foreach ($estadoscasos as $ec): ?>
                                <tr>
                                    <th><?php echo $ec->descripcion?></th>
                                    <td><?php echo count($ec->casos);?></td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Total de Incidencias</th>
                                <td><?php echo count($totalIncidencias);?></td>
                            </tr>
                            <?php foreach ($estados as $ei): ?>
                                <tr>
                                    <th><?php echo $ei->descripcion?></th>
                                    <td><?php echo count($ei->incidencias);?></td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid box-success">
                        <div class="box-header with-border">
                            REPORTE DE EJECUCION DE ESTADOS POR DIA
                        </div>
                        <div class="box-body">
                            <div id="grafico" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-12">
                    <div class="box box-solid box-danger">
                        <div class="box-header with-border">
                            REPORTE POR PORCENTAJE DE LOS CASOS
                        </div>
                        <div class="box-body">
                            <div id="grafico-torta" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
<!-- <script>
    $(document).ready(function(){
        graficar();
    });
</script> -->
