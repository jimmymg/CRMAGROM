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
                            Facturacion <small></small>
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
                                Pendientes de Solicitar Facturas
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
                                                    <th>Solicitar Factura</th>
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
            $("#factura").parent().hide();
        });  

     function cargar_solicitudes()
     {
        $.get("solcitarFactura/solicitudes")
        .done(function(data){
            console.log(data);

            var table = $("#table-solicitudes tbody");
            var tbody ="";
            var facturado = "";
            var estado = "";

            for( var x = 0 ; x < Object.keys(data).length ; x++ )
            {   

                facturado = data[x].facturado;
                estado = ( facturado == 0)?"Pendiente de Solicitar":"";
                estado = ( facturado == 1 )?"Facturado":estado;
                estado = ( facturado == 2 )?"Factura Solicitada":estado;
                estado = ( data[x].cancelado == 0 )?estado:"Cancelado";


                tbody += 
                "<tr>"+
                    "<td>"+(x+1)+"</td>"+
                    "<td>"+data[x].orden_compra+"</td>"+
                    "<td>"+data[x].fecha_solicitud+"</td>"+
                    "<td>"+data[x].usuario+"</td>"+
                    "<td>"+estado+"</td>"+
                    "<td> <button data-id='"+data[x].id+"' type='button' class='doIt btn btn-warning waves-effect'>Solicitar</button> </td>"+
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
        $("#id_solicitud").val(id);
        cargar_info_modal(id);

     });

    $("#solicitar_factura").click(function(event){
        event.preventDefault();
        $(this).hide();
        var id_solicitud =   $("#id_solicitud").val();
        var pedido = $("#folio_pedido").val();
        var remision = $("#folio_remision").val();

        if( pedido == "" || remision == "" )
        {
            swal("Error","Pedido o Remision estan vacios!","error")
            return;
        }

        $.post("solicitarFactura/solicitar",{
            pedido : pedido ,
            remision : remision ,
            solicitud : id_solicitud
        })
        .done(function(data){
            if( data == "Existe" )
            {
                swal("Error","Esa solicitud esta pendiente de Facturar","Error")
                $("#solicitar_factura").show();
                return ;
            }else{
                swal("Solicitada","La solicitud se guardo correctamente","success")
                $("#modalFacturar").modal("hide");
                return ;
            }
            s
        })
        .error(function(){
            alert("Error al Guardar la Solicitud de la Factura");
            $(this).show();
        });



    });

    </script>
</body>
</html>