<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
     <link href="{{url('js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
     <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    
</head>

<body>
    <div id="wrapper">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Fase 4 <small>Compra/Logistica</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Compra/Logistica
                                <button class="btn">Filtrar</button>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" 
                                    id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Proyecto</th>
                                                <th>Factura</th>
                                                <th>Cliente</th>
                                                <th>Empresa</th>
                                                <th>Status</th>
                                                <th>Creado Por</th>
                                                <th>Creado En</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $proyectos as $proyecto )
                                            <tr>
                                                <td>{{$contador++}}</td>
                                                <td>
                                                    <button data-target="#modalProyecto" data-toggle="modal" type="button" class="btn verProyecto" data-proyecto="{{$proyecto->id}}">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>{{$proyecto->nombre}}
                                                </td>
                                                <td>{{$proyecto->factura}}</td>
                                                <td>{{$proyecto->cliente}}</td>
                                                <td>{{$proyecto->empresa}}</td>
                                                <td>{{$proyecto->estado}}</td>
                                                <td>{{$proyecto->usuario}}</td>
                                                <td>{{$proyecto->created_at}}</td>
                                            </tr>
                                        @endforeach  
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

    <div class="modal fade " id="modalProyecto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Fase 4 Compra/Logistica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                 
                    <div class="col-sm-12">
                        
                        <h4>Gastos de Importacion Real</h4>
                        <input id="importacion" style="margin-top:10px" type="number" class="form-control">

                        <h4>Gastos de Transporte Real</h4>
                        <input id="transporte" style="margin-top:10px" type="number" class="form-control">

                        <h4>Numero de Compra del Producto en Sistema</h4>
                        <input id="numero_compra" style="margin-top:10px" type="text" class="form-control">

                        <h4>Notificar Fecha de Ingreso del Producto</h4>
                        <input id="fecha_ingreso" type="text" class="form-control">

                        <h4>Notificar Fecha de Entrega del Producto</h4>
                        <span style="margin-top: 5px; margin-bottom: 10px">(Administrador del Proyecto Informa al Cliente)</span>
                        <input id="fecha_entrega" type="text" class="form-control">

                        <h4>Numero de Guia</h4>
                        <input id="guia" type="text" class="form-control">
                     
                        <button id="siguiente_fase" style="margin-top:20px" type="button" class=" col-sm-12 waves-effect btn btn-success btn-lg">Cambiar de Fase</button>
                        
                    </div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

   
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'#comentario' });</script>
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
               
            });

            $(document).on("click",".verProyecto", function(){
                $("#siguiente_fase").attr("data-proyecto",$(this).attr("data-proyecto"));
            });

            $("#siguiente_fase").click(function(){

                var importacion   = $("#importacion").val();
                var transporte    = $("#transporte").val();
                var numero_compra = $("#numero_compra").val();
                var fecha_ingreso = $("#fecha_ingreso").val();
                var fecha_entrega = $("#fecha_entrega").val();
                var guia          = $("#guia").val();
                var proyecto      = $(this).attr("data-proyecto");

                $.post("Fase4/siguienteFase",{

                    importacion   : importacion   ,
                    transporte    : transporte    ,
                    numero_compra : numero_compra ,
                    fecha_ingreso : fecha_ingreso ,
                    fecha_entrega : fecha_entrega ,
                    guia          : guia          ,
                    proyecto      : proyecto
                })
                .done(function(data){
                    window.location.href = "Fase4";
                })
                .error(function(error){
                    alert("Error al Cambiar de Fase");
                }); 

            });
    </script>

</body>

</html>