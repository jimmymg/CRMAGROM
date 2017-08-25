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
<style>
        .hover-red:hover {
            color:red;
            cursor: pointer;
            cursor: hand;
        }
    </style>
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
                                    <table style="text-align:center" class="table table-bordered table-hover" id="dataTable-clientes">
                                        <thead>
                                            <tr>
                                                <th width="2%">#</th>
                                                <th width="15%">Nombre</th>
                                                <th width="30%">Empresa</th>
                                                <th>Cargo</th>
                                                <th >Correo</th>
                                                <th>Correo Alt.</th>
                                                <th>Telefono</th>
                                                <th>Celular</th>
                                                <th width="10%">Creado Por</th>
                                                <th width="10%">Modificado Por</th>
                                                <th>Acciones</th>
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
                    <span>Cargo</span>
                    <input type="text" id="cliente_cargo" class="form-control">
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


    <div class="modal fade " id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Cliente</h5>
                    <button style="float:right" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <div id="cargando-Cliente-a-Editar" >
                        <div style="margin-left:45%; " class="preloader">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div id="modal-body-content">

                        <div class="col-lg-6">
                            <span>Nombre</span>
                            <input type="text" id="editar_cliente_nombre" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <span>Cargo</span>
                            <input type="text" id="editar_cliente_cargo" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <span>Correo</span>
                            <input type="text" id="editar_cliente_correo" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <span>Correo Alternativo</span>
                            <input type="text" id="editar_cliente_correoA" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <span>Telefono</span>
                            <input type="text" id="editar_cliente_telefono" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <span>Celular</span>
                            <input type="text" id="editar_cliente_celular" class="form-control">
                        </div>
                    
                        <input type="hidden" id="editar_cliente_empresa" >
                        <input type="hidden" id="editar_cliente_cliente" >
                        <button data-target="#modalEmpresas" data-toggle="modal" style="margin-top:10px" type="button" class="col-s12 btn btn-primary   ">Empresa</button>
                        <h3>Nombre:</h3>
                        <h3>Ciudad:</h3>
                        <h3>Estado:</h3>
                    </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editar" >Guardar</button>
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
////////////////////////////////////////////////////////////////////////////////////////////////
        $(document).ready(function(){
            
            cargar_Empresas();
            cargar_Clientes();

        });
/////////////////////////////////////////////////////////////////////////////////////////////////////////
        $("#guardar_Cliente").click(function(){

            var nombre     = $("#cliente_nombre").val();
            var cargo      = $("#cliente_cargo").val();
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

            if( nombre == "" || correo1 == "" || telefono == "" || celular == "" || cargo == "" )
            {
                errorGenerico= true;
                errorEmpresa   = true;
            }

            
            //Validacion de la Empresa se tiene que seleccionar
            if( errorEmpresa == false )
            {

                $.post("Clientes/AgregarCliente",{
                    nombre     : nombre     ,
                    cargo      : cargo      ,
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
//////////////////////////////////////////////////////////////////////////////////////////////
        $("#empresa_quitar").click(function(){
            $("#valor_empresa").html("");
            $("#valor_empresa").removeAttr("data-empresa");
            $("#valor_empresa_direccion").html("");
            $(".check-empresa").removeClass("glyphicon-check");
            $(".check-empresa").addClass("glyphicon-unchecked");

            $("#valor_empresa_ciudad").html('');
            $("#valor_empresa_estado").html('');
        });
///////////////////////////////////////////////////////////////////////////////////////////////
        $(document).on("click",".check-empresa",function(){

            $(".check-empresa").removeClass("glyphicon-check");
            $(".check-empresa").addClass("glyphicon-unchecked");

            if( $(this).hasClass("glyphicon-unchecked") )
            {
                $(this).removeClass("glyphicon-unchecked");
                $(this).addClass("glyphicon-check");

                if( $("#modalEditar").hasClass("in") )
                {
                    

                    var empresa = $(this).attr("data-empresa");
                    var nombre = $(this).attr("data-nombre");
                    var ciudad = $(this).attr("data-ciudad");
                    var estado = $(this).attr("data-estado");

                    $("#editar_cliente_empresa").val(empresa);

                    $("#modalEditar .modal-body").find('h3').each(function(n){
                        $("#editar_cliente_empresa").val();
                        switch(n){
                            case 0: $(this).html("Nombre: "+nombre);
                            break;

                            case 1: $(this).html("Ciudad: "+ciudad);
                            break;

                            case 2: $(this).html("Estado: "+estado);
                            break;
                        }
                    });


                }else{
 

                    $("#valor_empresa").html("Empresa: "+$(this).attr("data-nombre"));
                
                    $("#valor_empresa").attr("data-empresa",$(this).attr("data-empresa"));

                    $("#valor_empresa_direccion").html("Direccion: "+$(this).attr("data-direccion"));
            
                    $("#valor_empresa_ciudad").html("Ciudad: "+$(this).attr("data-ciudad"));

                    $("#valor_empresa_estado").html("Estado: "+$(this).attr("data-estado"));
                }

                
            }
        });
///////////////////////////////////////////////////////////////////////////////////////////////
        $(document).on("click",".editar",function(){
            $("#modalEditar .modal-body #modal-body-content").hide();
            $("#cargando-Cliente-a-Editar").show();
            var cliente = $(this).attr("data-cliente");

            $("#modalEditar").modal();

            cargar_Cliente(cliente);
        });

       $('#modalEmpresas').on('hidden.bs.modal', function (e) {
            $("body").addClass("modal-open");
        });

       $("#editar").click(function(){
            

            var cliente     = $("#editar_cliente_cliente").val();
            var nombre      = $("#editar_cliente_nombre").val();
            var cargo       = $("#editar_cliente_cargo").val(); 
            var correo      = $("#editar_cliente_correo").val();
            var correoA     = $("#editar_cliente_correoA").val();
            var telefono    = $("#editar_cliente_telefono").val();
            var celular     = $("#editar_cliente_celular").val();


            var empresa = $("#editar_cliente_empresa").val();

            if( nombre == "" )
            {   
                return alert("Error Nombre Vacio");
            }

            if( cargo == "" ){ return alert("Error Cargo Vacio"); }

            if( correo == "" ){ return alert("Error Correo Vacio"); }

            if( correoA == "" ){ correoA == 'N/A'; }
            
            if( telefono == "" ){ return alert("Error Telefono Vacio"); }

            if( celular == "" ){ return alert("Error Celular Vacio"); }
            
            $.post("Clientes/ActualizarCliente",
                {
                    cliente     : cliente , 
                    nombre      : nombre ,
                    cargo       : cargo ,
                    correo      : correo ,
                    correoA     : correoA ,
                    telefono    : telefono ,
                    celular     : celular ,
                    empresa     : empresa
                })
            .done(function(){
                alert("Cliente Actualizado");
                cargar_Clientes();
            })
            .error(function(){
                alert("Error al Actualizar el Cliente");
            });

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

        function cargar_Cliente(cliente)
        {
            $.get('Clientes/getCliente/'+cliente)
            .done(function(data){
                console.log("Solo un Cliente:");
                console.log(data);
                data = data[0];
                //

                $("#editar_cliente_nombre").val(data.nombre);
                $("#editar_cliente_cargo").val(data.cargo);
                $("#editar_cliente_correo").val(data.correo1);
                $("#editar_cliente_correoA").val(data.correo2);
                $("#editar_cliente_telefono").val(data.telefono);
                $("#editar_cliente_celular").val(data.celular);
                //id cliente
                $("#editar_cliente_cliente").val(data.id);
                $("#editar_cliente_empresa").val(data.id_empresa);

                $("#modalEditar .modal-body ").find("h3").each(function(n){

                    switch(n)
                    {
                        case 0:
                            $(this).html("Nombre: "+data.empresa);
                        break;

                        case 1:
                            $(this).html("Ciudad: "+data.ciudad);
                        break;

                        case 2:
                            $(this).html("Estado: "+data.estado);
                        break;
                    }
                });
                $("#modalEditar .modal-body #modal-body-content").show();
                $("#cargando-Cliente-a-Editar").hide();
            })
            .error(function(){
                alert("Error al Consultar al Cliente");
            });
        }

        function cargar_Clientes()
        {
            $.get('Clientes/getClientes')
            .done(function(data){
                console.log(data);

                var tabla = $("#dataTable-clientes").DataTable();
                tabla.clear();
                var empresa  = "";
                var correo1 = "";
                var correo2 = "";
                var n1 = null;
                var n2 = null;
                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {   

                    empresa = 
                            '<ul class="list-group">'+
                                '<li class="list-group-item"><strong>Nombre</strong> '+data[x].empresa+'</li>'+
                                '<li class="list-group-item"><strong>Direccion</strong> '+data[x].direccion+'</li>'+
                                '<li class="list-group-item"><strong>Ciudad</strong> '+data[x].ciudad+'</li>'+
                                '<li class="list-group-item"><strong>Estado</strong> '+data[x].estado+'</li>'+
                            '</ul>';
                    correo1 = data[x].correo1;
                    n1 = correo1.split('@');
                    correo2 = data[x].correo2;
                    n2 = correo2.split('@');

                    tabla.row.add([
                            x+1 ,
                            data[x].nombre   ,
                            empresa          ,
                            data[x].cargo    ,
                            (n1[1] != undefined)?n1[0]+" @"+n1[1]:n1[0]  ,
                            (n2[1] != undefined)?n2[0]+" @"+n2[1]:n2[0]  ,
                            data[x].telefono ,
                            data[x].celular  ,
                            data[x].created_by ,
                            data[x].updated_by ,
                            "<span data-cliente='"+data[x].id+"' class='editar glyphicon glyphicon-edit fa-3x hover-red'></span>"
                        ]).draw();
                }

            })
            .error(function(error){
                alert("Error al Consultar Clientes");
            });
        }
    </script>