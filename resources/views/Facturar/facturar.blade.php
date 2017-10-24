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
                            Facturar <small>Recordar que ustedes crean Pedido y Remision, los que Facturan son los de Contabilidad</small>
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
                                Pendientes de Facturar
                            </div>
                            <div class="panel-body">

                                <div class="col-lg-12">
                                    <div class="col-lg-3">
                                        <label>N° Compra</label>
                                        <input type="text" class="form-control" id="numero_compra_filter">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha</label>
                                        <input type="date" class="form-control" id="fecha_filter">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Estado</label>
                                        <select class="form-control">
                                            <option>Pendiente</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12" style="margin-top:15px;margin-bottom: 15px;">
                                        <button type="button" class="waves-effect btn btn-primary col-lg-11">Filtrar</button>
                                        <button type="button" class="waves-effect btn btn-success col-lg-1">Todos</button>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table" id="table-solicitudes">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Orden de Compra</th>
                                                    <th>Fecha</th>
                                                    <th>Solicitado Por</th>
                                                    <th>Estado</th>
                                                    <th>Do it!</th>
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
                </div>

                <footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

    <!-- MODALS -->
    @include('Facturar.Do_It_Modal')

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
        $(document).ready(function(){
            cargar_solicitudes();
        });  

     function cargar_solicitudes()
     {
        $.get("facturar/solicitudes")
        .done(function(data){
            console.log(data);

            var table = $("#table-solicitudes tbody");
            var tbody ="";
            var facturado = "";
            var estado = "";

            for( var x = 0 ; x < Object.keys(data).length ; x++ )
            {   

                facturado = data[x].facturado;
                estado = ( facturado == 0)?"Pendiente":facturado;
                estado = ( data[x].cancelado == 0 )?estado:"Cancelado";


                tbody += 
                "<tr>"+
                    "<td>"+(x+1)+"</td>"+
                    "<td>"+data[x].orden_compra+"</td>"+
                    "<td>"+data[x].fecha_solicitud+"</td>"+
                    "<td>"+data[x].usuario+"</td>"+
                    "<td>"+estado+"</td>"+
                    "<td> <button data-id='"+data[x].id+"' type='button' class='doIt btn btn-warning waves-effect'>Do It!</button> </td>"+
                "</tr>";
            }

            table.html(tbody);
        })
        .error(function(){
            alert("Error al Cargar las Solicitudes");
        });
     }

     $(document).on("click",".doIt" , function(){
        $("#modalFacturar").modal();
        var id = $(this).attr("data-id");

        cargar_info_modal(id);

     });

    </script>
</body>
</html>