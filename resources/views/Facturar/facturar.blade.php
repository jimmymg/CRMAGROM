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
                            Facturacion <small>Contabilidad</small>
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
                                    <div class="table-responsive">
                                        <table class="table" id="table-pendietes-facturar">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pedido</th>
                                                    <th>Remision</th>
                                                    <th>Factura</th>
                                                    <th>Cliente</th>
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
        
        $(document).ready(function(){
            cargar_solicitudes();
        });

        $(document).on("click",".facturar",function(event){
                event.preventDefault();

            var $this = $(this);
            $this.hide();
            var id = $(this).attr("data-factura");
            var factura = $(this).parent().parent().find("input").val();


            if( factura == "" )
            {
                swal("Error","Factura Vacia","error")
                return ;
            }

            $.post('solicitarFactura/facturar',
            {
                id : id ,
                factura : factura ,
            })
            .done(function(data){
                cargar_solicitudes();

                swal("Facturado","Factura Guardada con Existo" , "success")
            })
            .error(function(){
                alert("Error al Facturar");
                 $this.show();
            });

        });

        function cargar_solicitudes()
        {
            $.get("solicitarFactura/pendientes")
            .done(function(data){
              
                console.log(data);
             
                var table = $("#table-pendietes-facturar tbody");

                var tbody = "";
                var boton = "";
                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {   
                    if( data[x].factura == null )
                    {
                        boton = '<div class="col-lg-8">'+
                                    '<input type="text" class="form-control">'+
                                '</div>'+
                                '<div class="col-lg-4">'+
                                    '<button data-factura="'+data[x].id+'" type="button" class="facturar btn btn-primary waves-effect">Guardar</button>'+
                                '</div>';
                    }else{
                        boton = data[x].factura;
                    }

                    tbody +=
                    "<tr>"+
                        "<td>"+(x+1)+"</td>"+
                        "<td>"+data[x].pedido+"</td>"+
                        "<td>"+data[x].remision+"</td>"+

                        "<td class='col-lg-4'>"+boton+"</td>"+

                        "<td>"+data[x].razon+"</td>"+
                        "<td>"+data[x].total+"</td>"+

                    "</tr>";
                }

                table.html(tbody);
            })
            .error(function(){
                alert("Error al Consular las Solicitudes Pendientes");
            });
        }
    </script>
</body>
</html>