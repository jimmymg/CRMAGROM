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
                            Pagos <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Historial de Pagos
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <button id="update_histotial" type="button" class="btn btn-primary"> 
                                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-lg-12" >
                                    <div id="load_historial" style="margin-left: calc(50% - 60px);margin-top: 10px;" class="loader"></div>
                                </div>

                                <div class="table-responsive col-lg-12">
                                    <table class="table" id="table-historial">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Orden de Compra</th>
                                                <th>Vendedor</th>
                                                <th>Factura</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Pendientes de Pagar
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <button id="update_table_pendientes" type="button" class="btn btn-primary"> 
                                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="col-lg-12" >
                                    <div id="load_pendietes" style="margin-left: calc(50% - 60px);margin-top: 10px;" class="loader"></div>
                                </div>

                                <div class="table-responsive col-lg-12">
                                    <table class="table" id="table-pendientes">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Orden de Compra</th>
                                                <th>Vendedor</th>
                                                <th>Factura</th>
                                                <th>Total</th>
                                                <th>Pendiente</th>
                                                <th>Moneda</th>
                                                <th>Pagar</th>
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
    @include('Pagos.modalPagar')
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
            
        $(document).ready(function(){
            pagos_pendientes();
            pagos_historial();
        });

        $("#update_histotial").click(function(){
            pagos_historial();
        });

        $("#update_table_pendientes").click(function(){
            pagos_pendientes();
        });


        function pagos_historial()
        {
            $("#load_historial").show();
            $("#table-historial").hide();
            
            $.get("Pagos/GetPagosHistorial")
            .done(function(data){
                console.log(data);
                var table = $("#table-historial tbody");
                var tbody = "";

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tbody +=
                    "<tr>"+
                        "<td>"+(x+1)+"</td>"+
                        "<td>"+data[x].orden_compra+"</td>"+
                        "<td>"+data[x].usuario+"</td>"+
                        "<td>"+data[x].factura+"</td>"+
                        "<td>"+data[x].total+"</td>"+
                    "</tr>";
                }
                table.html(tbody);
                $("#load_historial").hide();
                $("#table-historial").show();

            })
            .error(function(){
                alert("Error al Cargar el Historial de los Pagos");
            });
        }

        function pagos_pendientes()
        {   $("#table-pendientes").hide();
            $("#load_pendietes").show();
            $("#table-pendientes tbody").html("");
           // Pagos/getPagosPendientes/tipo/{tipo}/solicitud/{solicitud}
            $.get("Pagos/getPagosPendientes/tipo/0/solicitud/0")
            .done(function(data){
                
                var tbody = "";
                var table = $("#table-pendientes tbody");
                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tbody += 
                    "<tr>"+
                        "<td>"+(x+1)+"</td>"+
                        "<td>"+data[x].orden_compra+"</td>"+
                        "<td>"+data[x].usuario+"</td>"+
                        "<td>"+data[x].factura+"</td>"+
                        "<td>"+data[x].total+"</td>"+
                        "<td>"+data[x].pendiente_total+"</td>"+
                        "<td>"+data[x].moneda+"</td>"+
                        "<td><button data-solicitud='"+data[x].solicitud_id+"' type='button' class='pagar btn btn-warning'>Pagar</button></td>"+
                    "</tr>";
                }

                table.html(tbody);
                $("#table-pendientes").show();
                $("#load_pendietes").hide();
            })
            .error(function(){
                alert("Error al Consultar los Pagos Pendientes");
                $("#table-pendientes").show();
                $("#load_pendietes").hide();
            });
        }

    </script>
</body>
</html>