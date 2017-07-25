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
                            Usuarios <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <button type="button" id="nuevo_usuario" class="btn btn-primary">Nuevo Usuario</button>
                        </div>
                        <div class="col-sm-6" id="formulario_usuario" >
                            <span>Usuario</span>
                            <input id="txt_usuario" type="text" class="form-control">

                            <span>Nombre</span>
                            <input id="txt_nombre" type="text" class="form-control">

                            <span>Correo</span>
                            <input id="txt_correo" type="text" class="form-control">
                            <span>Contraseña</span>
                            <input id="password" type="password" class="form-control">


                            <span>Area</span>
                            <select id="cmb_area" class="form-control">
                                <option value="0">Seleccionar Area</option>
                                <option value="1">Administrador</option>
                                <option value="2">Proyectos</option>
                                <option value="3">Ventas</option>
                                <option value="4">Servicios</option>
                                <option value="5">Facturas</option>
                                <option value="6">Proveedor</option>
                                <option value="7">Instalacion</option>
                                <option value="8">Logistica</option>
                            </select>

                            <button id="guardar" class="btn btn-success">Guardar</button>
                            <button id="cancelar" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Usuarios
                                <button class="btn">Filtrar</button>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" 
                                    id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Usario</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Area</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $usuarios as $usuario )
                                            <tr>
                                                <td>{{$contador++}}</td>
                                                <td>{{$usuario->usuario}}</td>
                                                <td>{{$usuario->nombre}}</td>
                                                <td>{{$usuario->correo}}</td>
                                                <td>{{$usuario->area}}</td>
                                            
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
        
        $(document).ready(function(){
            $("#formulario_usuario").hide();
        });

        $("#nuevo_usuario").click(function(){
            $("#formulario_usuario").show();
        });
        $("#cancelar").click(function(){

            $("#txt_usuario").val('');
            $("#txt_nombre").val('');
            $("#txt_correo").val('');
            $("#cmb_area").val(0);
            $("#password").val('');

            $("#formulario_usuario").hide();
        });
        $("#guardar").click(function(){

            var usuario = $("#txt_usuario").val();
            var nombre  = $("#txt_nombre").val();
            var correo  = $("#txt_correo").val();
            var area    = $("#cmb_area").val();
            var password = $("#password").val();

            var error   = false;
            if( usuario == "" || nombre == "" || correo == "" || area == 0){
                error = true;
            }
            if( error == false )
            {
                $.post("Usuarios/insertar",{
                    usuario : usuario ,
                    nombre  : nombre  ,
                    correo  : correo  ,
                    area    : area    ,
                    password : password
                })
                .done(function(data){

                })
                .error(function(){
                    alert("Error al Guardar el Usuario");
                });
            }else{
                alert("Porfavor llene todos los campos");
            }
          
        });

      

           
    </script>

</body>

</html>