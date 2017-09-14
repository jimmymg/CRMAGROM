<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
    <link href="{{url('css/fileinput.min.css')}}" rel="stylesheet" />
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
                            Proyectos <small>En Proceso</small>
                        </h1>
                    </div>
                </div>
                <input type="hidden" id="origin_url" value="{{url('/')}}">
                <div class="col-sm-12">

                    <h3>Total de Proyectos Activos: <strong>{{$cantidad}}</strong></h3>
                    <h4>Cantidad de Proyectos {{$cantidad}} </h4>
                    <h4>Ordenado por Fecha de Creacion el mas reciente</h4>
                    <nav aria-label="...">
                        <ul class="pagination ">
                        <!--
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Anterior</a>
                            </li>
                        -->
                            <!-- <span class="sr-only">(current)</span> Poner Dentro de Etiqueta JS <a> -->
                            @for( $i = 1 ; $i <= $limitless ; $i++ )
                            <!-- Hay un If en el Class -->
                            <li class="page-item  @if($i == 1) active @endif ">
                                <a class="page-link" data-pivote="{{$pivote}}" href="#">{{$i}}
                                @if( $i == 1 )
                                    <span class="sr-only">(current)</span>
                                @endif
                                </a>
                                
                                <?php $pivote = $pivote + 6; ?>
                            </li>
                            @endfor
                        <!--
                            <li class="page-item">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        -->
                        </ul>
                    </nav>
                </div>

                <div class="col-sm-12" id="lugar_proyectos">
                 
                    
                    @foreach( $proyectos as $proyecto )
                    <div class="col-md-4 col-sm-12 col-xs-12 waves-effect" data-proyecto="{{$proyecto->id}}" >
                        <div class="panel panel-primary text-center  bg-color-black">
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <h4>Proyecto: {{$proyecto->nombre}}</h4>
                                    <span>Tipo: <strong>{{$proyecto->tipo}}</strong></span>
                                    <span>Area: <strong>{{$proyecto->area}}</strong></span>
                                    <span>Moneda: <strong>{{$proyecto->moneda}}</strong></span>
                                </div>
                                <div class="col-sm-12">
                                    <button id="showcliente" data-target="#modalClientes" data-toggle="modal" data-cliente="{{$proyecto->IDCLIENTE}}" style="margin-top:10px" type="button" class="btn btn-primary">Cliente: <strong>{{$proyecto->cliente}}</strong></button>

                                    <button id="showempresa" data-target="#modalEmpresas" data-toggle="modal" data-empresa="{{$proyecto->IDEMPRESA}}" style="margin-top:10px" type="button" class="btn btn-primary">Empresa: <strong>{{$proyecto->empresa}}</strong></button>
                                </div>
                                <div class="col-sm-12">
                                    <h4>Creado Por: <strong>{{$proyecto->usuario}}</strong></h4>
                                    <h4>Creado El: <strong>{{$proyecto->created_at}}</strong></h4>
                                </div>
                                <div class="col-sm-12">
                                    <button id="showarchivos" style="margin-top:10px" type="button" class="btn col-sm-12  btn-primary">Archivos</button> 
                                    <button id="showseguimientos" style="margin-top:10px" type="button" class="btn col-sm-12  btn-success">Seguimientos y Comentarios</button> 
                                </div>
                                <div class="col-sm-12">
                                    <h2>En Fase 2 de 7</h2>

                                    <button id="showinformacion" style="margin-top:10px;" type="button" class="btn btn-primary">Informacion</button>

                                    <h4>Siguiente Pago del Cliente: <strong>{{$proyecto->a_c}}</strong></h4>
                                    <h4>Siguiente Pago al Proveedor: <strong>{{$proyecto->a_p}}</strong></h4>
                                </div>
                                <div class="col-sm-12">
                                    <button id="cambiar_pausado" type="button" class="btn btn-warning col-sm-12">PAUSAR</button>
                                    <button id="cambiar_cancelado" type="button" class="btn btn-danger col-sm-12">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


               
				<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

    <!-- MODALS -->
    @include('Fase1.proyectosModals.clientes')
    @include('Fase1.proyectosModals.empresas')
    @include('Fase1.proyectosModals.archivos')
    @include('Fase1.proyectosModals.seguimientos')
    @include('Fase1.proyectosModals.informacion')
   
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <script src="{{url('js/fileinput.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
   
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
            $(".place").hide();
        });
        /*Cambiar las Fases del Proyecto*/
        $("body").on("click","#cambiar_pausado",function(){

            var proyecto = $(this).parent().parent().parent().parent().attr("data-proyecto");
            $.post("CambiarEstado",{
                proyecto    : proyecto ,
                nuevoEstado : 2
            }).done(function(){
                location.reload();
            }).error(function(error){
                alert("Error al Actualizar el Estado del Proyecto")
            });
        });
        $("body").on("click","#cambiar_cancelado",function(){
            var proyecto = $(this).parent().parent().parent().parent().attr("data-proyecto");
            $.post("CambiarEstado",{
                proyecto    : proyecto ,
                nuevoEstado : 3
            }).done(function(){
                location.reload();
            }).error(function(error){
                alert("Error al Actualizar el Estado del Proyecto");
            });
        });
        //////////////////////////////////
        $(document).on("click",".page-link",function(){

            var pivote = $(this).attr("data-pivote");

            if( !$(this).parent().hasClass("active") ){
                
                var active = $("body").find(".active");
                active.removeClass("active");
                active.find("span").remove();

                $(this).parent().addClass("active");
                var html_actual = $(this).html();
                $(this).html( html_actual + '<span class="sr-only">(current)</span>' );

                consultar_proyectos(pivote);
            }
        });
        
        $("body").on("click","#showcliente" , function(){
            
            cargar_InformacionCliente($(this).attr("data-cliente"));
        });

        $("body").on("click","#showempresa" , function(){
            cargar_InformacionEmpresa($(this).attr("data-empresa"));
        });

        $("body").on("click","#showarchivos",function(){
            $("#modalArchivos").modal("show");
            var proyecto = $(this).parent().parent().parent().parent().attr("data-proyecto");

            cargar_Archivos( proyecto );
        });

        $("body").on("click","#showseguimientos",function(){
            $("#modalSeguimientos").modal("show");
            var proyecto = $(this).parent().parent().parent().parent().attr("data-proyecto");
            consultar_seguimientos(proyecto);
        });

        $("body").on("click","#showinformacion",function(){
            $("#modalInformacion").modal("show");
            var proyecto = $(this).parent().parent().parent().parent().attr("data-proyecto");
            cargar_informacion_fase(proyecto);
        });

        $("#see_1").click(function(){

            desplegar("place_1");
        });

        $("#see_2").click(function(){

             desplegar("place_2");
        });

        $("#see_3").click(function(){

             desplegar("place_3");
        });

        $("#see_4").click(function(){

             desplegar("place_4");
        });

        $("#see_5").click(function(){

             desplegar("place_5");
        });

        $("#see_6").click(function(){

             desplegar("place_6");
        });

        $("#see_7").click(function(){

             desplegar("place_7");
        });

        function desplegar(id)
        {
            if( !$("#"+id).is(":visible") )
            {
                $(".place").hide(); 
            }
            $("#"+id).toggle();
        }

        function consultar_proyectos(pivote)
        {
            $.get('EnProceso/'+pivote+'/estado/1')
            .done(function(data){
                console.log("6 Proyectos:");
                console.log(data);
                write_proyectos(data);
            })
            .error(function(){
                alert("Error al Consultar Los Proyectos");
            });
        }

        function write_proyectos(data)
        {
            var html= "";

            for( var x = 0 ; x < Object.keys(data).length ; x++ )
            {   
                abono_cliente   = ( data[x].a_c == null )?"":data[x].a_c;
                abono_proveedor = ( data[x].a_p == null )?"":data[x].a_p;
                html+=
            '<div class="col-md-4 col-sm-12 col-xs-12 waves-effect" data-proyecto="'+data[x].id+'" >'+
                '<div class="panel panel-primary text-center  bg-color-black">'+
                    '<div class="panel-body">'+
                        '<div class="col-sm-12">'+
                            '<h4>Proyecto: '+data[x].nombre+'</h4>'+
                            '<span>Tipo: <strong>'+data[x].tipo+'</strong></span>'+
                            '<span>Area: <strong>'+data[x].area+'</strong></span>'+
                            '<span>Moneda: <strong>'+data[x].moneda+'</strong></span>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<button id="showcliente" data-target="#modalClientes" data-toggle="modal" data-cliente="'+data[x].IDCLIENTE+'" style="margin-top:10px" type="button" class="btn btn-primary">'+
                            'Cliente: <strong>'+data[x].cliente+'</strong></button>'+
                            '<button id="showempresa" data-target="#modalEmpresas" data-toggle="modal" data-empresa="'+data[x].IDEMPRESA+'" style="margin-top:10px" type="button" class="btn btn-primary">'+
                            'Empresa: <strong>'+data[x].empresa+'</strong></button>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<h4>Creado Por: <strong>'+data[x].usuario+'</strong></h4>'+
                            '<h4>Creado El: <strong>'+data[x].created_at+'</strong></h4>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<button id="showarchivos" style="margin-top:10px" type="button" class="btn col-sm-12  btn-primary">Archivos</button>'+
                            '<button id="showseguimientos" style="margin-top:10px" type="button" class="btn col-sm-12  btn-success">Seguimientos y Comentarios</button>'+ 
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<h2>En Fase '+data[x].fase+' de 7</h2>'+

                            '<button id="showinformacion" style="margin-top:10px;" type="button" class="btn btn-primary">Informacion</button>'+
                            
                            '<h4>Siguiente Pago del Cliente: <strong>'+abono_cliente+'</strong></h4>'+
                            '<h4>Siguiente Pago al Proveedor: <strong>'+abono_proveedor+'</strong></h4>'+
                        '</div>'+
                        '<div class="col-sm-12">'+
                            '<button id="cambiar_pausado" type="button" class="btn btn-warning col-sm-12">PAUSAR</button>'+
                            '<button id="cambiar_cancelado" type="button" class="btn btn-danger col-sm-12">CANCELAR</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
            }

            $("#lugar_proyectos").html(html);
        }

        function cargar_InformacionCliente(cliente)
        {
            $.get('InformacionCliente/'+cliente)
            .done(function(data){
                $("#cliente_nombre").html(data[0].nombre);
                $("#cliente_correo_1").html(data[0].correo1);
                $("#cliente_correo_2").html(data[0].correo2);
                $("#cliente_telefono").html(data[0].telefono);
                $("#cliente_celuar").html(data[0].celular);
            })
            .error(function(error){
                alert("Error al Cargar los Clientes");
            });
        }

        function cargar_InformacionEmpresa(empresa)
        {
            $.get('InformacionEmpresa/'+empresa)
            .done(function(data){
                $("#empresa_nombre").html( data[0].nombre );
                $("#empresa_giro").html( data[0].giro );
                $("#empresa_direccion").html( data[0].direccion );
                $("#empresa_ciudad").html( data[0].ciudad );
                $("#empresa_estado").html( data[0].estado );
            })
            .error(function(error){
                alert("Error al Cargar la Empresa");
            });
        }

        function consultar_seguimientos(proyecto)
        {
            $.get("Seguimientos/"+proyecto)
            .done(function(data){
                console.log("Cargar Seguimientos:");
                console.log(data);
                
                write_seguimientos(data);
                


            })
            .error(function(){
                alert("Error al cargar los comentarios y los seguientos");
            });
        }

        function write_seguimientos(data)
        {
            var html = "";

            for( var x = 0 ; x < Object.keys(data).length ; x++ )
            {
                
                if( data[x].via == null )
                {
                   //Es un Comentario
                    html+= '<div class="panel panel-primary">'+
                                '<div style="text-align: left; font-size: 10pt;margin-left:10px;margin-top:10px;">'+data[x].created_at+' <strong>'+data[x].nombre+'</strong> Comentario:</div>'+
                                '<div  style="font-size: 14pt;margin-left:20px;margin-bottom:10px;">'+data[x].seguimiento+'</div>'+
                            '</div>';
                }else{
                    //Es un Seguimiento
                 
                    var via = "Telefono";
                    
                    if( data[x].via == 1){ via = "Correo"; }

                html +=    '<div class="panel panel-danger" >'+
                                '<div style="text-align: left; font-size: 10pt;margin-left:10px;margin-top:10px;">'+data[x].fecha+' <strong>'+data[x].nombre+'</strong> Seguimiento (Via: '+via+')'+
                                '</div>'+
                                '<div  style="font-size: 14pt;margin-left:20px;margin-bottom:10px;">'+
                                data[x].seguimiento+
                                '</div>'+
                            '</div>';
                }
            }
            
            $("#lugar_comentarios").html(html);
        }

        function cargar_Archivos(proyecto)
        {   limpiar_archivos();
            $.get('Archivos/'+proyecto)
            .done(function(data){
                console.log("Archivos de un Proyecto:");
                console.log(data);
                var Fase1 = data["fase1"] ;
                var Fase2 = data["fase2"] ;
                var Fase3 = data["fase3"] ;
                var Fase5 = data["fase5"] ;
                var Fase6 = data["fase6"] ;
                var url   = $("#origin_url").val();
                var a = false , b = false , c = false , d = false;
                var e = false , f = false;
                var g = false , h = false , i = false;
                var j = false , k = false , l = false;
                var m = false;

                if( Object.keys(Fase1).length > 0 ){

                    for( var x = 0 ; x < Object.keys(Fase1).length ; x++ )
                    {
                        if( Fase1[x].id_tipo == 1 && a == false )
                        {
                            $("#cotizacion").html(
                            '<a href="'+url+'/'+Fase1[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            a = true;
                        }

                        if( Fase1[x].id_tipo == 2 && b == false )
                        {
                            $("#compra_cliente").html(
                            '<a href="'+url+'/'+Fase1[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            b = true;
                        }

                        if( Fase1[x].id_tipo == 3 && c == false )
                        {
                            $("#compra_proveedor").html(
                            '<a href="'+url+'/'+Fase1[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            c = true;
                        }

                        if( Fase1[x].id_tipo == 4 && d == false )
                        {
                            $("#formato_pedido").html(
                            '<a href="'+url+'/'+Fase1[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            d = true;
                        }
                    }//End FOR
                }
                //Fase 2
                if( Object.keys(Fase2).length > 0 )
                {
                    for( var x = 0 ; x < Object.keys(Fase2).length ; x++ )
                    {
                        if( Fase2[x].id_tipo == 5 && e == false )
                        {
                            $("#anticipo_cliente").html(
                            '<a href="'+url+'/'+Fase2[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            e = true;
                        }

                        if( Fase2[x].id_tipo == 6 && f == false )
                        {
                            $("#anticipo_proveedor").html(
                            '<a href="'+url+'/'+Fase2[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            f = true;
                        }
                    }//End FOR
                }
                //Fase 3
                if( Object.keys(Fase3).length > 0 )
                {
                    for( var x = 0 ; x < Object.keys(Fase3).length ; x++ )
                    {

                        if( Fase3[x].id_tipo == 7 && g == false )
                        {
                            $("#factura_anticipo").html(
                            '<a href="'+url+'/'+Fase3[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            g = true;
                        }

                        if( Fase3[x].id_tipo == 8 && h == false )
                        {
                            $("#xml").html(
                            '<a href="'+url+'/'+Fase3[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            h = true;
                        }

                        if( Fase3[x].id_tipo == 9 && i == false )
                        {
                            $("#anticipo_o_pago_proveedor").html(
                            '<a href="'+url+'/'+Fase3[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            i = true;
                        }
                    }//End FOR
                }
                //Fase 4 NULL
                //Fase 5
                if( Object.keys(Fase5).length > 0 )
                {
                    for( var x = 0 ; x < Object.keys(Fase5).length ; x++ )
                    {

                        if( Fase5[x].id_tipo == 10 && j == false )
                        {
                            $("#factura_anticipo").html(
                            '<a href="'+url+'/'+Fase5[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            j = true;
                        }

                        if( Fase5[x].id_tipo == 11 && k == false )
                        {
                            $("#xml").html(
                            '<a href="'+url+'/'+Fase5[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            k = true;
                        }

                        if( Fase5[x].id_tipo == 12 && l == false )
                        {
                            $("#anticipo_o_pago_proveedor").html(
                            '<a href="'+url+'/'+Fase5[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            l = true;
                        }
                    }//End FOR
                }

                if( Object.keys(Fase6).length > 0 )
                {
                    for( var x = 0 ; x < Object.keys(Fase6).length ; x++ )
                    {

                        if( Fase6[x].id_tipo == 13 && m == false )
                        {
                            $("#reporte").html(
                            '<a href="'+url+'/'+Fase6[x].ruta+'" class="" download>'+
                                '<span class="glyphicon glyphicon-file"></span>'+
                            '</a>'
                                );
                            m = true;
                        }

                    }//End FOR
                }
            })
            .error(function(error){
                alert("Error al Cargar los Archivos");
            });
        }

        function limpiar_archivos()
        {
            $("#cotizacion").html('');
            $("#compra_cliente").html('');
            $("#compra_proveedor").html('');
            $("#formato_pedido").html('');

            $("#anticipo_cliente").html('');
            $("#anticipo_proveedor").html('');

            $("#factura_anticipo").html('');
            $("#xml").html('');
            $("#anticipo_o_pago_proveedor").html('');
        }

        function cargar_informacion_fase(proyecto)
        {   
            $.get("InformacionGeneral/"+proyecto)
            .done(function(data){
                console.log("Información de las Fases:");
                console.log(data);
                var marcas = '<h2 style="text-align: center;">Marcas</h2>';
                var admins = '<h2 style="text-align: center;">Admins</h2>';
            
                //Fase1
                    $("#i_proyecto").html(data["fase1"]['proyecto'][0].nombre);
                    $("#i_descripcion").html(data["fase1"]['proyecto'][0].descripcion);
                    $("#i_tipo").html(data["fase1"]['proyecto'][0].tipo);
                    $("#i_area").html(data["fase1"]['proyecto'][0].area);
                    $("#i_fuente").html(data["fase1"]['proyecto'][0].fuente);

                    for( var x = 0 ; x < Object.keys(data["fase1"]["marcas"]).length; x++ )
                    {
                        marcas += '<h4 style="text-align: center;" class="col-sm-6 btn btn-warning">'+data["fase1"]["marcas"][x].nombre+'</h4>';
                    }
                    $("#i_marcas").html( marcas );

                    for( var x = 0 ; x < Object.keys(data["fase1"]["administradores"]).length ; x++ )
                    {
                        admins += '<h4 style="text-align: center;" class="col-sm-6 btn btn-warning">'+data["fase1"]["administradores"][x].nombre+'</h4>';
                    }
                    $("#i_administradores").html(admins);
                //Fase2
                if( Object.keys(data["fase2"]).length > 0 )
                {
                    for( var x = 0 ; x < Object.keys(data["fase2"]).length ; x++ )
                    {
                       switch(data["fase2"][x].tipo)
                       {
                            case 1:
                                $("#i_total_cliente").html(data["fase2"][x].monto_total);
                                $("#i_abono_cliente").html(data["fase2"][x].abono);
                                $("#i_pendiente_cliente").html(data["fase2"][x].pendiente);
                                $("#i_fecha_cliente").html(data["fase2"][x].fecha_pago);
                            break;

                            case 2:
                                $("#i_total_proveedor").html(data["fase2"][x].monto_total);
                                $("#i_abono_proveedor").html(data["fase2"][x].abono);
                                $("#i_pendiente_proveedor").html(data["fase2"][x].pendiente);
                                $("#i_fecha_proveedor").html(data["fase2"][x].fecha_pago);
                            break;
                       }

                       $("#i_adminpac").html(data["fase2"][x].numero_adminpac);
                    }
                }
                //Fase4
                if( Object.keys(data["fase4"]).length > 0 )
                {
                    $("#importacion").html(data["fase4"][0].gastos_importacion_real);
                    $("#transporte").html(data["fase4"][0].gastos_transporte_real);
                    $("#numero_compra_producto").html(data["fase4"][0].numero_compra);
                    $("#fecha_ingreso").html(data["fase4"][0].fecha_ingreso);
                    $("#fecha_entrega").html(data["fase4"][0].fecha_entrega);

                    $("#numero_guia").html(data["fase4"][0].guia);
                }
                //Fase6
                if( Object.keys(data["fase6"]).length > 0)
                {
                    $("#visita").html(  'Fecha: '+data["fase6"][0].fecha+
                                        ' Ciudad: '+data["fase6"][0].ciudad+
                                        ' Estado: '+data["fase6"][0].estadi);
                }
                //Fase7
                if( Object.keys(data["fase7"]).length > 0 )
                {
                    for( var x = 0 ; x < Oject.keys(data["fase7"]).length; x++ )
                    {
                        switch( data["fase7"][x].pregunta )
                        {
                            case 1: 
                                $("#pregunta_1").html(data["fase7"][x].respuesta);
                            break;
                            case 2:
                                $("#pregunta_2").html(data["fase7"][x].respuesta);
                            break;
                            case 3:
                                $("#pregunta_3").html(data["fase7"][x].respuesta);
                            break;
                        } 
                    }
                }
            })
            .error(function(error){
                alert("Error al cargar informacion de las fases");
            });
        }

    </script>

</body>

</html>