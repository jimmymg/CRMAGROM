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
    @include("layouts.cargando")
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Facturar <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Numero de Pedido de Adminpaq
                            </div>
                            <div class="panel-body">
                                <div class="col-md-1">
                                    <label>Serie:</label>
                                    <input type="text" class="form-control" id="serie" value="A">
                                </div>
                                <div class="col-md-2">
                                    <label>Folio:</label>
                                    <input type="number" class="form-control" id="serie">
                                </div>
                             
                                <br>
                               
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-primary">Buscar Pedido</button>
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" class="btn btn-success">Guardar Pedido</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Informacion del Pedido
                            </div>
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>
                </div>

				<footer ></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

 
 
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
    </script>
</body>
</html>