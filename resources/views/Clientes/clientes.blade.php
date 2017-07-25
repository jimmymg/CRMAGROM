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
                            Clientes <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" data-target="#modalClientes" data-toggle="modal" class="btn btn-primary waves-effect">Nuevo
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Clientes
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-hover" id="dataTable-clientes">
                                        <thead>
                                            <tr>
                                                <th width="10%">#</th>
                                                <th width="20%">Nombre</th>
                                                <th >Correo</th>
                                                <th>Correo Alt.</th>
                                                    <th>Telefono</th>
                                                 <th>Celular</th>
                                                 <th>Empresa</th>
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
    

    <!-- /. WRAPPER  -->

    <!-- MODALS-->
    <div class="modal fade " id="modalClientes" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <span>Nombre</span>
                    <input type="text" id="cliente_nombre" class="form-control">
                    <span>Correo</span>
                    <input type="text" id="cliente_correo" class="form-control">
                    <span>Correo Alternativo</span>
                    <input type="text" id="cliente_correoA" class="form-control">
                    <span>Telefono</span>
                    <input type="text" id="cliente_telefono" class="form-control">
                    <span>Celular</span>
                    <input type="text" id="cliente_celular" class="form-control">
                    <span>Empresa</span>
                    <button type="buton" data-target="#modalEmpresas" data-toggle="modal" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>

                    <button type="button" class="btn btn-default" id="empresa_quitar">Quitar Empresa</button>

                    <h3 id="valor_empresa"></h3>
                    <h3 id="valor_empresa_direccion"></h3>
                    <h3 id="valor_empresa_ciudad"></h3>
                    <h3 id="valor_empresa_estado"></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="guardar_Cliente" >Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade " id="modalEmpresas" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar Empresa</h5>
                    <button style="float:right" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="dataTable-empresas">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="20%">Nombre</th>
                                    <th >Giro</th>
                                    <th>Direccion</th>
                                    <th>Ciudad</th>
                                    <th>Estado</th>
                                    <th width="10%">Seleccionar</th>
                                 </tr>
                             </thead>
                             <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

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

        $(document).ready(function(){
            
            cargar_Empresas();
            cargar_Clientes();

        });

        $("#guardar_Cliente").click(function(){

            var nombre     = $("#cliente_nombre").val();
            var correo1    = $("#cliente_correo").val();
            var correo2    = $("#cliente_correoA").val();
            var telefono   = $("#cliente_telefono").val();
            var celular    = $("#cliente_celular").val();
            var id_empresa = $("#valor_empresa").attr("data-empresa");
            var errorEmpresa = false;
            var errorGenerico = false;
            if( id_empresa == undefined ){
                id_empresa = 0;
                errorEmpresa = true;
            }

            if( nombre == "" || correo1 == "" || correo2 == "" || telefono == "" || celular == "" )
            {
                errorGenerico= true;
                errorEmpresa   = true;
            }

            
            //Validacion de la Empresa se tiene que seleccionar
            if( errorEmpresa == false )
            {

                $.post("Clientes/AgregarCliente",{
                    nombre     : nombre     ,
                    correo1    : correo1    ,
                    correo2    : correo2    ,
                    telefono   : telefono   ,
                    celular    : celular    ,
                    id_empresa : id_empresa ,
                    })
                .done(function(data){
                    swal(
                        '¡Guardado!',
                        'Cliente Guardado con Exito',
                        'success'
                        )
                    $("#modalClientes").modal("hide");
                    cargar_Clientes();
                })
                .error(function(error){
                    alert("Error al Insertar Clinete");
                });
                
            }else{
                if( errorGenerico == true )
                {

                    swal(
                        '¡Error!',
                        'Algun campo esta vacio',
                        'error'
                        )

                }else{
                    swal(
                        '¡Error!',
                        'Seleccione una Empresa',
                        'error'
                        )
                }
            }
        });

        $("#empresa_quitar").click(function(){
            $("#valor_empresa").html("");
            $("#valor_empresa").removeAttr("data-empresa");
            $("#valor_empresa_direccion").html("");
            $(".check-empresa").removeClass("glyphicon-check");
            $(".check-empresa").addClass("glyphicon-unchecked");

            $("#valor_empresa_ciudad").html('');
            $("#valor_empresa_estado").html('');
        });

        $(document).on("click",".check-empresa",function(){

            $(".check-empresa").removeClass("glyphicon-check");
            $(".check-empresa").addClass("glyphicon-unchecked");

            if( $(this).hasClass("glyphicon-unchecked") )
            {
                $(this).removeClass("glyphicon-unchecked");
                $(this).addClass("glyphicon-check");
                $("#valor_empresa").html("Empresa: "+$(this).attr("data-nombre"));
                
                $("#valor_empresa").attr("data-empresa",$(this).attr("data-empresa"));

                $("#valor_empresa_direccion").html("Direccion: "+$(this).attr("data-direccion"));
            
               $("#valor_empresa_ciudad").html("Ciudad: "+$(this).attr("data-ciudad"));

               $("#valor_empresa_estado").html("Estado: "+$(this).attr("data-estado"));
            }
        });

        function cargar_Empresas()
        {
            $.get("Empresas/getEmpresas")
            .done(function(data){
                console.log(data);

                var tabla = $("#dataTable-empresas").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++)
                {
                    tabla.row.add([
                            x+1 ,
                            data[x].nombre ,
                            data[x].giro ,
                            data[x].direccion ,
                            data[x].ciudad ,
                            data[x].estado ,
                            '<span data-empresa="'+data[x].id+'"  data-nombre="'+data[x].nombre+'" data-direccion="'+data[x].direccion+'" data-ciudad="'+data[x].ciudad+'" data-estado = "'+data[x].estado+'" class="glyphicon glyphicon-unchecked check-empresa fa-2x"></span>'
                            
                        ]).draw();
                }

            })
            .error(function(error){
                alert("Error al Consultar");
            });
        }

        function cargar_Clientes()
        {
            $.get('Clientes/getClientes')
            .done(function(data){
                console.log(data);

                var tabla = $("#dataTable-clientes").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tabla.row.add([
                            x+1 ,
                            data[x].nombre   ,
                            data[x].correo1  ,
                            data[x].correo2  ,
                            data[x].telefono ,
                            data[x].celular  ,
                            data[x].empresa
                        ]).draw();
                }

            })
            .error(function(error){
                alert("Error al Consultar Clientes");
            });
        }
    </script>