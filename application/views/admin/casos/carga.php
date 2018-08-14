<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Bien Hecho!", "<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error al Cargar!", "Haz click en el botón para volver intentarlo.", "error");
    </script>
<?php endif ?>
<section class="content-header">
    <h1>
        Carga Masiva <small>Casos</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box box-solid">
    
        <div class="box-body">
            <div class="callout callout-danger">
                <h4>Considere los siguientes puntos antes de subir su archivo!</h4>

                <ul>
                    <li>Se debe respetar los nombres de los encabezados y el siguiente orden (N°, Proyecto, Nombre, Estado, Fecha Ejecucion, Ciclo, Precondicion, Resultado, Fecha de Registro).</li>
                    <li>El valor en la columna "Proyecto" debe ser númerico, el cual indica el identificador (#) del proyecto. Dicho identificador lo puedes visualizar en Listado de Proyectos.</li>
                    <li>El valor en la columna "Estado" debe ser númerico, el cual indica el identificador (#) del estado. Dicho identificador lo puedes visualizar en Listado de Estados.</li>
                </ul>
                <a href="<?php echo base_url();?>ejecucion/casos/download">Descargar Ejemplo</a>
            </div>
            <form action="<?php echo base_url();?>ejecucion/casos/importar" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4  col-xs-12">
                        <div class="form-group">
                            <label for="file">Archivo(.xls o .xlsx):</label>
                            <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx" required="required">
                            
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">Subir</button>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Listado de Proyectos</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nombre</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($proyectos as $p): ?>
                                          <tr>  
                                            <td><?php echo $p->id;?></td>
                                            <td><?php echo $p->nombre;?></td>
                                          </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                          <!-- /.box -->
                    </div>
                    <div class="col-md-4">
                        <div class="box box-primary box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Listado de Estados</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Nombre</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($estados as $e): ?>
                                          <tr>  
                                            <td><?php echo $e->id;?></td>
                                            <td><?php echo $e->descripcion;?></td>
                                          </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            
            </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->