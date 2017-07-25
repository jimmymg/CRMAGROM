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
    @include("layouts.cargando")
    
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Fase 3 <small>Facturacion</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Facturacion
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
                                                <th>Cliente</th>
                                                <th>Moneda</th>
                                                <th>Creado Por</th>
                                                <th>Status</th>
                                                <th>Creado El</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $proyectos as $proyecto )
                                            <tr>   
                                                <td>{{$contador++}}</td>
                                                <td>
                                                    <button data-target="#modalProyecto" data-toggle="modal" type="button" class="btn verProyecto" data-proyecto="{{$proyecto->id}}">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                    {{$proyecto->nombre}}
                                                </td>
                                                <td>{{$proyecto->cliente}}</td>
                                                <td>{{$proyecto->moneda}}</td>
                                                <td>{{$proyecto->usuario}}</td>
                                                <td>{{$proyecto->estado}}</td>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Fase 3 Facturacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                    
                    <div class="col-sm-12">
                       
                        <h3 style="text-align: center;"><strong>Administradores del Proyecto</strong></h3>
                        <div id="proyecto_administradores" class="col-sm-12" style="margin-top:10px;">
                            
                            

                        </div>

                        <h4>NUMERO DE LA FACTURA POR NUMERO ADMINPAC</h4>
                        <h2 style="text-align: center;" id="factura"></h2>

                        <h3>Factura Anticipo o Finiquito</h3>
                        <div style="margin-top:20px" id="descargar_anticipo"></div>
                        <input  id="file_anticipo" name="archivos[]" type="file" multiple class="file-loading">

                        <h3>XML</h3>
                        <div style="margin-top:20px" id="descargar_xml"></div>
                        <input id="file_xml" name="archivos[]" type="file" multiple class="file-loading">

                        <h3>Anticipo o Pago Proveedor ( Solo Mary )</h3>
                        <div style="margin-top:20px" id="descargar_pago_proveedor"></div>
                        <input id="file_pago_proveedor" name="archivos[]" type="file" multiple class="file-loading">
                     
                        <button id="siguiente_fase" style="margin-top:20px" type="button" class=" col-sm-12 waves-effect btn btn-success btn-lg">Cambiar de Fase</button>
                        
                    </div>
                    
                    <div class="col-sm-12">
                        <h3 style="margin-top: 10px; margin-bottom:10px;">Comentarios y Seguimientos</h3>
                        <textarea id="comentario"></textarea>

                        <button style="margin-top: 10px;" id="guardar_comentario" type="button" class="btn btn-warning">Guardar Comentario</button>

                        <div id="lugar_comentarios" style="margin-top:10px;">
                            
                        </div>
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
    <script src="{{url('js/fileinput.min.js')}}"></script>
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
                $("#guardar_comentario").attr("data-proyecto",$(this).attr("data-proyecto"));
                cargaproyecto($(this).attr("data-proyecto"));
                consultar_seguimientos($(this).attr("data-proyecto"));

                var id = $(this).attr("data-proyecto");
                archivos(id, 0);
                
                $("#file_anticipo").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase3/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 7 ,
                        proyecto :id ,
                    }
                });

                $("#file_anticipo").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 7);
                });

                $("#file_xml").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase3/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 8 ,
                        proyecto :id ,
                    }
                });

                $("#file_xml").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 8);
                });

                $("#file_pago_proveedor").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase3/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 9 ,
                        proyecto :id ,
                    }
                });

                $("#file_pago_proveedor").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 9);
                });



            });

            $("#guardar_comentario").click(function(){

                    var comentario = tinyMCE.get('comentario').getContent();
                    var proyecto   = $(this).attr("data-proyecto");

                    $.post("Fase3/Ver_Proyecto/GuardarComentario",{
                        comentario : comentario ,
                        proyecto   : proyecto
                    })
                    .done(function(){
                        //Recargar los Comentario y limpiar la caja de texto
                        consultar_seguimientos(proyecto);
                    })
                    .error(function(){
                        alert("Error al Guardar el Comentario");
                    });
            });

            $("#siguiente_fase").click(function(){

                var proyecto = $(this).attr("data-proyecto");

                $.post("Fase3/siguienteFase",{
                    proyecto : proyecto
                }).done(function(data){


                        window.location.href = "Fase3";

                    
                })
                .error(function(error){
                    alert("Error al Guardar la Informacion");
                });;

            });

        function cargaproyecto(proyecto)
        {
            $.get("Fase3/Ver_Proyecto/"+proyecto)
            .done(function(data){

                var html = "";
                $("#factura").html( data["factura"][0].numero_adminpac );

                var administradores = data["administradores"];
                for( var x = 0  ; x < Object.keys(administradores).length ; x++ )
                {
                    html += '<div class="col-sm-6 waves-effect" >'+
                                '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                    '<div class="panel-footer back-footer-green">'+administradores[x].nombre+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                }

                $("#proyecto_administradores").html(html);
            })
            .error(function(error){
                alert("Error al Cargar el Proyecto");
            });
        }

        function consultar_seguimientos(proyecto)
        {
            $.get("Fase1/Ver_Proyecto/cargar_com_seg/"+proyecto)
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

        function archivos(proyecto , tipo)
            {   
            $.get("Fase3/Ver_Proyecto/getarchivos/"+proyecto+"/"+tipo)
            .done(function(data){
                console.log("Archivos");
                console.log(data);
                //Si es cero quiere decir que en el data hay de todos los tipos
                var html = "";
                if( tipo == 0 )
                {
                    var siete    = false;
                    var ocho     = false;
                    var nueve    = false;

                    var resultado = data["resultado"];

                    $("#descargar_anticipo").html('');
                    $("#descargar_xml").html('');
                    $("#descargar_pago_proveedor").html('');

                    for( var x = 0 ; x < Object.keys(resultado).length ; x++ )
                    {
                        var type= resultado[x].id_tipo;
                        html = "";
                       
                            switch(type)
                            {
                                case 7:

                                    if( siete == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Factura Anticipo o Finiquito '+resultado[x].created_at+'</a>';
                                        $("#descargar_anticipo").html(html);
                                       siete= true;
                                    } 

                                break;
                                case 8:
                                
                                        if( ocho == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>XML '+resultado[x].created_at+'</a>';
                                        $("#descargar_xml").html(html);
                                       ocho = true;

                                        } 
                                break;

                                case 9:
                                
                                        if( nueve == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo o Pago Proveedor '+resultado[x].created_at+'</a>';
                                        $("#descargar_pago_proveedor").html(html);
                                       nueve = true;

                                        } 
                                break;
                                
                            }
                    }

                }else{

                    var resultado = data["resultado"];
                    var x = 0;
                    switch(tipo)
                            {
                                case 7:
                                        $("#descargar_anticipo").html('');
                                    
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Factura Anticipo o Finiquito'+resultado[x].created_at+'</a>';
                                        $("#descargar_anticipo").html(html);
                                break;

                                case 8:
                                        $("#descargar_xml").html('');
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>XML '+resultado[x].created_at+'</a>';
                                        $("#descargar_xml").html(html);
                                break;

                                case 9:
                                        $("#descargar_pago_proveedor").html('');
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo o Pago Proveedor'+resultado[x].created_at+'</a>';
                                        $("#descargar_pago_proveedor").html(html);
                                break;
                                
                            }
                }
            })
            .error(function(){
                alert("Error Al Consultar las Cortizaciones");
            });
        }
    </script>

</body>

</html>