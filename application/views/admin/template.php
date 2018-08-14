<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- SweetAlert  -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/sweetalert/sweetalert.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- DataTables Export -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables-export/css/buttons.dataTables.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Trumbowyg -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/trumbowyg/trumbowyg.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/summernote/summernote.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- SweetAlert  -->
    <script src="<?php echo base_url();?>assets/sweetalert/sweetalert.min.js"></script>

    <style>
        .color-user{
            color: #3c8dbc;
        }
        .celda-descripcion img{
            width: 400px !important;
        }
        .modal { overflow: auto !important; }
    </style>
    <!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>dashboard" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>APP</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>APP</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <form action="<?php echo base_url();?>backend/dashboard/setProyecto" class="navbar-form navbar-left" role="search" method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <select name="proyecto" class="form-control">
                                    <option value="">En General...</option>
                                    <?php echo $this->backend_lib->getProyectos();?>
                                </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-warning" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                          
                        </div>
                    </form>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $this->session->userdata("nombre")." - ".$this->session->userdata("nombres");?>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url();?>auth/logout">Cerrar Session</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Menú de Navegación</li>
                    <?php echo $this->backend_lib->getMenu();?>
                    
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php echo $contenido;?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Highcharts -->
<script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/highcharts/exporting.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Export -->
<script src="<?php echo base_url(); ?>assets/datatables-export/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables-export/js/buttons.print.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/jquery-print/jquery.print.js"></script>
<script src="<?php echo base_url();?>assets/trumbowyg/trumbowyg.min.js"></script>
<script src="<?php echo base_url();?>assets/summernote/summernote.js"></script>
<script>

  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
    var base_url = "<?php echo base_url();?>";
</script>

<script>
    $(document).ready(function () {
        function mensaje(){
            alert("hola");
        }
        $('.summernote').summernote({
            lang: 'fr-FR', // <= nobody is perfect :)
            height: 300,
            tab:3,
            toolbar : [
                ['style',['bold','italic','underline','clear']],
                ['font',['fontsize']],
                ['color',['color']],
                ['para',['ul','ol','paragraph']],
                ['link',['link']],
                ['picture',['picture']]
            ],
            callbacks : {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete : function(target) {
                     alert(target[0].src) 
                    deleteFile(target[0].src);
                }
            }
        });
        function uploadImage(image) {
            var data = new FormData();
            data.append("file",image);
            $.ajax ({
                data: data,
                type: "POST",
                url:  base_url + "ejecucion/casos/upload_image",// this file uploads the picture and 
                                 // returns a chain containing the path
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    console.log(url);
                    //var image = IMAGE_PATH + url;
                    $('.summernote').summernote("insertImage", url);
                    },
                    error: function(data) {
                        console.log(data);
                        }
            });
        }

        function deleteFile(src) {
            $.ajax({
                data: {src : src},
                type: "POST",
                url: base_url+"ejecucion/casos/delete_file", // replace with your url
                cache: false,
                success: function(resp) {
                    console.log(resp);
                }
            });
        }

    });
 
</script>
<script src="<?php echo base_url(); ?>assets/backend/script.js"></script>
</body>
</html>
