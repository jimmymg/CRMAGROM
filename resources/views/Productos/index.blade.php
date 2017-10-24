<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
    <link href="{{url('css/fileinput.min.css')}}" rel="stylesheet" />
     <link href="{{url('js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
     <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
     <!-- Plugin DateTimePicker CSS -->
    <link href="{{url('plugins/bootstrap-datetimepicker-malot/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" />
    
    
</head>
<style>
    .loader {
   
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<body >
@include("layouts.cargando")
    
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Productos <small>No se maneja existencia aun</small>
                        </h1>
                    </div>
                </div>

                <div style="margin-bottom:20px" class="row">
               
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Productos
                                <button type="button" id="nuevo_producto" class="btn btn-success waves-effect">Nuevo Producto</button>
                            </div>
                            <div class="panel-body">

                                <div class="col-lg-12 bg-success" style="margin-bottom: 10px;margin-top:10px;">
                                    
                                    <div class="col-lg-12" style="margin-top:10px">
                                        <div class="material-switch pull-left">
                                            <input id="lleva_serie" name="someSwitchOption001" type="checkbox">
                                            <label for="lleva_serie" class="label-primary"></label>
                                        </div>
                                        <label style="margin-left: 10px">¿Lleva Series?</label>
                        
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Producto</label>
                                        <input class="form-control">
                                    </div><!--
                                    <div class="col-lg-2" style="margin-bottom:10px">
                                        
                                        Todabia no manejan existencias de los productos solo lo que se vende
                                        <label>Cantidad</label>
                                        <input class="form-control">
                                        
                                    </div>-->
                                    <div class="col-lg-2" >
                                        <button style="margin-top:20px" type="button" id="capturar_series" class="btn btn-primary waves-effect col-lg-12">Capturar Series</button>
                                    </div>
                                    <div class="col-lg-2" style="margin-bottom:10px">
                                        <button style="margin-top:20px" type="button" id="guardar_producto" class="btn btn-success waves-effect">Guardar</button>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                          
                                    <div style="margin-left: calc(50% - 60px);margin-top: 10px;" class="loader"></div>
                          
                                </div>
                                <div class="table-responsive " style="padding-right: 15px;">
                                    <table class="table table-striped table-bordered table-hover" id="table-productos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Alta</th>
                                                <th>Creado Por</th>
                                                <th>¿Series?</th>
                                                <th>Existencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>

                <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

    <!-- MODALS -->


    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <!-- plugin datetimepicker JS -->
    <script src="{{url('plugins/bootstrap-datetimepicker-malot/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{url('plugins/bootstrap-datetimepicker-malot/js/locales/bootstrap-datetimepicker.es.js')}}"></script>
    <!-- END plugin datetimepicker JS -->
    <script src="{{url('js/fileinput.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="{{url('js/tinymce/tinymce.min.js')}}"></script>

    <script>tinymce.init({ selector:'#comentario' });</script>

    <!-- JS  -->
 
    <!-- End JS  -->
    <script>
        Waves.init();
        $('#main-menu').metisMenu();

        $(window).bind("load resize", function () {
            if ($(this).width() < 768) {
                $('div.sidebar-collapse').addClass('collapse')
            } else {
                    $('div.sidebar-collapse').removeClass('collapse')
            }
        });
            
        $("#table-productos").hide();
        $(document).ready(function(){

            llenarTabla();
        });

        function llenarTabla()
        {
            $.get('productos/todos')
            .done(function(data){
                console.log(data);

                var table = $("#table-productos").DataTable();
                table.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {   
                 
    

                    table.row.add([
                        x+1 ,
                        data[x].producto   ,
                        data[x].fecha_alta ,
                        data[x].created_by ,
                        data[x].lleva_series ,
                        data[x].existencia
                        ]).draw();
                }

                $(".loader").parent().hide();
                $("#table-productos").show();
            })
            .error(function(){
                alert("Error al Consultar los Productos");
            });
        }
    </script>
</body>
</html>