<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
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
                           Bienvenido <small>{{Auth::user()->nombre}}</small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">


               
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="oportunidades">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-thumbs-up fa-5x"></i>
                                <h3>{{$activos}} Activos</h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Oportunidades

                            </div>
                        </div>
                    </div>
                
                @if( Auth::user()->id_area == 1 || Auth::user()->id_area == 3 || Auth::user()->id_area == 4 )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="anticipos_adminpac">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-credit-card fa-5x"></i>
                                <h3> Pendientes</h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Anticipos y Adminpac

                            </div>
                        </div>
                    </div>
                @endif

                @if( Auth::user()->id_area == 1  || Auth::user()->id_area == 5 || Auth::user()->id_area == 6 )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="facturacion">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon glyphicon-check fa-5x"></i>
                                <h3> Pendientes</h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Facturacion

                            </div>
                        </div>
                    </div>
                @endif
                @if( Auth::user()->id_area == 1 || Auth::user()->id_area == 8 )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="logistica">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon glyphicon-road fa-5x"></i>
                                <h3> Pendientes</h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Logistica

                            </div>
                        </div>
                    </div>
                 @endif   
                </div>
                
               
                <div class="row">
                 @if( Auth::user()->id_area == 1 || Auth::user()->id_area == 3 || Auth::user()->id_area == 4 || Auth::user()->id_area == 5 || Auth::user()->id_area == 6 )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="pendientes_administrativos">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-book fa-5x"></i>
                                <h3> Pendientes</h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Pendientes Administrativos

                            </div>
                        </div>
                    </div>
                @endif
                @if( Auth::user()->id_area == 1  || Auth::user()->id_area == 4 || Auth::user()->id_area == 7 )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="instalacion_arranque">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-wrench fa-5x"></i>
                                <h3>15 Pendientes</h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Instalacion y Arranque

                            </div>
                        </div>
                    </div>
                @endif
                @if( Auth::user()->id_area == 1  )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="postventa">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-repeat fa-5x"></i>
                                <h3> Pendientes</h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Post Venta

                            </div>
                        </div>
                    </div>
                @endif
                    
                </div>

                <div class="row">  

                @if( Auth::user()->id_area == 1  )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="usuarios">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="material-icons fa-5x" >account_circle</i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Usuarios

                            </div>
                        </div>
                    </div>
                @endif
                
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="clientes">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="material-icons fa-5x" >supervisor_account</i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Clientes

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="empresas">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="material-icons fa-5x" >business</i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Empresas
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="marcas">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="material-icons fa-5x" >grade</i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Marcas
                            </div>
                        </div>
                    </div>
                    
                    @if( Auth::user()->id_area == 1  )
                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="configuration">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-cog fa-5x"></i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Configuracion

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" id="calendar">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-cog fa-5x"></i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                                Prueba Google Calendar

                            </div>
                        </div>
                    </div>
                @endif
                </div>
                
				<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')

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
            /*
        $("#exit").click(function(){
            $("#form-exit").submit();
        });*/
       
        $(document).ready(function(){
            //var ancho = $("html").width();
            
          
        });


        $("#usuarios").click(function(){
            window.location.href = 'Usuarios';
        });

        $("#oportunidades").click(function(){
            window.location.href = 'Fase1';
        });

        $("#configuration").click(function(){
            window.location.href = 'Configuracion';
        });

        $("#clientes").click(function(){
            window.location.href = 'Clientes';
        });

        $("#marcas").click(function(){
            window.location.href = 'Marcas';
        });

        $("#empresas").click(function(){
            window.location.href = 'Empresas';
        });

        $("#anticipos_adminpac").click(function(){
            window.location.href = 'Fase2';
        });

        $("#facturacion").click(function(){
            window.location.href = 'Fase3';
        });

        $("#logistica").click(function(){
            window.location.href = 'Fase4';
        });

        $("#pendientes_administrativos").click(function(){
            window.location.href = 'Fase5';
        });

        $("#instalacion_arranque").click(function(){
            window.location.href = 'Fase6';
        });

        $("#postventa").click(function(){
            window.location.href = 'Fase7';
        });
        //Prueba de Correos
        $("#calendar").click(function(){
            window.location.href = 'GoogleCalendar';
        });
        //Prueba de Google Calendar
    </script>

</body>

</html>