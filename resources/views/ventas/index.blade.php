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
                            Ventas <small>Formato de Excel</small>
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
                                Ventas
                                <button type="button" id="go_nueva" class="btn btn-success">Nueva Solicitud de Pedido</button>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <button id="update_table" type="button" class="btn btn-primary">Actualizar 
                                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-lg-12" >
                                    <div style="margin-left: calc(50% - 60px);margin-top: 10px;" class="loader"></div>
                                </div>

                                <div class="table-responsive col-lg-12">
                                    <table class="table" id="table-ventas">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Orden de Compra</th>
                                                <th>Vendedor</th>
                                                <th>Cantidad de Facturas</th>
                                                <th>Total</th>
                                                <th>Pendiente</th>
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
            
        //responsivo_ChangeDataTable('place_of_dataTables-index');
        $("#go_nueva").click(function(){
            window.location.href = 'ventas/nueva';
        });

        $(document).ready(function(){
            $("#table-ventas").hide();
        
            cargar_ordenes_compras();
        });

        $("#update_table").click(function(){
            $(".loader").show();
            $("#table-ventas").hide();
            cargar_ordenes_compras();
        });

        function cargar_ordenes_compras()
        {
            $.get("ventas/getVentas")
            .done(function(data){
                console.log(data);
                var table = $("#table-ventas tbody");
                var tbody = "";
                for( var x = 0 ;x < Object.keys(data).length ; x++)
                {
                    tbody += 
                    "<tr>"+
                        "<td>"+(x+1)+"</td>"+
                        "<td>"+data[x].orden_compra+"</td>"+
                        "<td>"+data[x].usuario+"</td>"+
                        "<td>"+data[x].facturas+"</td>"+
                        "<td>"+data[x].total+"</td>"+
                        "<td>"+data[x].pendiente+"</td>"+
                    "</tr>";

                    
                }
                $(".loader").hide();
                table.html(tbody);
                $("#table-ventas").show();
            
            })
            .error(function(){
                alert("Error al Cargar las Ventas");
                $(".loader").hide();
                $("#table-ventas").show();
              
            });
        }
    </script>
</body>
</html>