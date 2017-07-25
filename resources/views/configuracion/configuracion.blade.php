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
                            Configuracion <small>General</small>
                        </h1>
                    </div>
                </div>

                <div class="row">  

                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" data-toggle="modal" data-target="#menuProyecto">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-footer back-footer-red">
                                <i class="glyphicon glyphicon-cog"></i>
                                Proyectos
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12 waves-effect" data-toggle="modal" data-target="#modalMonedas">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-footer back-footer-red">
                                <i class="glyphicon glyphicon-cog"></i>
                                Monedas

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
    <div class="modal fade " id="menuProyecto" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    
                        
                        <button class="btn btn-default" id="tipos">Tipos</button>
                        <button class="btn btn-default" id="areas">Areas</button>
                        <button class="btn btn-default" id="estados">Estados</button>
                        <button class="btn btn-default" id="fuentes">Fuentes</button>

                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                    <input type="text" class="form-control" id="proyecto_campos_texto">
                    <button type="button" class="btn btn-danger" id="add">Add</button>

                    <div class="table-responsive" >
                            <table class="table table-bordered table-hover" id="dataTable-tipos">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th>Tipo</th>
                                        <th width="20%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>

                    <div class="table-responsive" >
                            <table class="table table-bordered table-hover" id="dataTable-areas">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th>Area</th>
                                        <th width="20%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>

                    <div class="table-responsive" >
                            <table class="table table-bordered table-hover" id="dataTable-estados">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>

                    <div class="table-responsive" >
                            <table class="table table-bordered table-hover" id="dataTable-fuentes">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fuente</th>
                                        <th>Acciones</th>
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

    <div class="modal fade " id="modalMonedas" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Moneda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <input type="text" class="form-control" id="text_moneda">
                    <button type="button" class="btn btn-danger" id="add_moneda">Agregar</button>

                    <div class="table-responsive" >
                            <table class="table table-bordered table-hover" id="table_monedas">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th>Moneda</th>
                                        <th width="20%">Acciones</th>
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
           
        $("#menuProyecto").on('show.bs.modal',function(){
            limpiar_proyectos_options();
        });

        $("#modalMonedas").on("show.bs.modal",function(){
            cargar_monedas();
        });   

        $("#tipos").click(function(){
            limpiar_proyectos_options();
            $(this).removeClass("btn-default");
            $(this).addClass("btn-primary");
            $("#dataTable-tipos").parent().show();
            $("#proyecto_campos_texto").show();
            $("#add").show();
            cargar_tipos();
        });

        $("#areas").click(function(){
            limpiar_proyectos_options();
            $(this).removeClass("btn-default");
            $(this).addClass("btn-primary");
            $("#dataTable-areas").parent().show();
            $("#proyecto_campos_texto").show();
            $("#add").show();
            cargar_areas();
        });

        $("#estados").click(function(){
            limpiar_proyectos_options();
            $(this).removeClass("btn-default");
            $(this).addClass("btn-primary");
            $("#dataTable-estados").parent().show();
            $("#proyecto_campos_texto").show();
            $("#add").show();
            cargar_estados();
        });

        $("#fuentes").click(function(){
            limpiar_proyectos_options();
            $(this).removeClass("btn-default");
            $(this).addClass("btn-primary");
            $("#dataTable-fuentes").parent().show();
            $("#proyecto_campos_texto").show();
            $("#add").show();
            cargar_fuentes();
        });

        $("#add_moneda").click(function(){
            var moneda = $("#text_moneda").val();

            $.post("Configuracion/postMoneda",{
                moneda : moneda
            })
            .done(function(data){
                console.log(data);
                cargar_monedas();

            })
            .error(function(error){
                alert("Error al Insertar");
            });
        });

        $("#add").click(function(){
            var texto = $("#proyecto_campos_texto").val();

            if( texto != "" )
            {
                if( $("#dataTable-tipos").parent().is(":visible") )
                {
                    $.post("Configuracion/postTipo",{
                        tipo : texto
                    })
                    .done(function(data){
                        if(data == 1)
                        {
                            alert("Ese Tipo ya Existe");
                            $("#proyecto_campos_texto").val('');
                        }
                        cargar_tipos();
                    })
                    .error(function(){
                        alert("Error al Insertar");
                    });
                }

                if( $("#dataTable-areas").parent().is(":visible") )
                {
                    $.post("Configuracion/postArea",{
                        area : texto
                    })
                    .done(function(data){
                        if(data == 1)
                        {
                            alert("Esa Area ya Existe");
                            $("#proyecto_campos_texto").val('');
                        }
                        cargar_areas();
                    })
                    .error(function(){
                        alert("Error al Insertar");
                    });
                }

                if( $("#dataTable-estados").parent().is(":visible") )
                {
                    $.post("Configuracion/postEstado",{
                        estado : texto
                    })
                    .done(function(data){
                        if(data == 1)
                        {
                            alert("Ese Estado ya Existe");
                            $("#proyecto_campos_texto").val('');
                        }
                        cargar_estados();
                    })
                    .error(function(){
                        alert("Error al Insertar");
                    });
                }

                if( $("#dataTable-fuentes").parent().is(":visible") )
                {
                    $.post("Configuracion/postFuente",{
                        fuente : texto
                    })
                    .done(function(data){
                        if(data == 1)
                        {
                            alert("Esa Fuente ya Existe");
                            $("#proyecto_campos_texto").val('');
                        }
                        cargar_fuentes();
                    })
                    .error(function(){
                        alert("Error al Insertar");
                    });
                }

            }else{
                alert("Vacio");
            }
        });

        function limpiar_proyectos_options()
        {   
            $("#proyecto_campos_texto").hide();
            $("#add").hide();

            $("#tipos").removeClass("btn-primary");
            $("#tipos").addClass("btn-default");
            $("#areas").removeClass("btn-primary");
            $("#areas").addClass("btn-default");
            $("#estados").removeClass("btn-primary");
            $("#estados").addClass("btn-default");
            $("#fuentes").removeClass("btn-primary");
            $("#fuentes").addClass("btn-default");

            $("#dataTable-tipos").parent().hide();
            $("#dataTable-areas").parent().hide();
            $("#dataTable-estados").parent().hide();
            $("#dataTable-fuentes").parent().hide();
        }

        function cargar_tipos()
        {
            $.get("Configuracion/getTipos")
            .done(function(data){
                console.log(data);
                var tabla = $("#dataTable-tipos").DataTable();
                tabla.clear();
                for( var x = 0 ; Object.keys(data).length ; x++ )
                {
                    tabla.row.add([
                            (x+1) ,
                            data[x]['nombre'] ,
                            "<button data-idTipo='"+data[x].id+"' class='btn'>Editar</button>"
                        ]).draw();
                }
            })
            .error(function(error){
                alert("Error al Consultar los Tipos");
                console.log(error);
            });
        }

        function cargar_areas()
        {
            $.get("Configuracion/getAreas")
            .done(function(data){
                console.log(data);
                var tabla = $("#dataTable-areas").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++)
                {
                    tabla.row.add([
                            x+1 ,
                            data[x]['nombre'] ,
                            "<button type='button' data-idArea='"+data[x].id+"' class='btn btn-default'>Editar</button>"
                        ]).draw();
                }
            })
            .error(function(error){
                alert("Error al Consultar Areas");
            });
        }

        function cargar_estados()
        {
            $.get("Configuracion/getEstados")
            .done(function(data){
                console.log(data);

                var tabla = $("#dataTable-estados").DataTable();
                tabla.clear();
                for(var x = 0 ; x < Object.keys(data).length ; x++)
                {
                    tabla.row.add([
                            (x+1) ,
                            data[x].nombre ,
                            "<button type='button' data-idEstado='"+data[x].id+"' class='btn btn-default'>Editar</button>"
                        ]).draw();
                }

            })
            .error(function(error){
                alert("Error Al Consultar Estados");
            });
        }

        function cargar_fuentes()
        {
            $.get("Configuracion/getFuentes")
            .done(function(data){
                console.log(data);
                var tabla = $("#dataTable-fuentes").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tabla.row.add([
                            x+1 ,
                            data[x].nombre ,
                            '<button type="button" data-idFuente="'+data[x].id+'" class="btn btn-default">Editar</button>'
                        ]).draw();
                }

            })
            .error(function(error){
                alert("Error Al Consultar Fuentes");
            });
        }

        function cargar_monedas()
        {
            $.get("Configuracion/getMonedas")
            .done(function(data){
                console.log(data);

                var tabla = $("#table_monedas").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++)
                {
                    tabla.row.add([
                            x+1 ,
                            data[x].nombre,
                            '<button type="button" data-idMomenda="'+data[x].id+'" class="btn btn-default">Editar</button>'
                        ]).draw();
                }
            })
            .error(function(error){
                alert("Error al Consultar Monedas");
            });
        }
    </script>

</body>

</html>