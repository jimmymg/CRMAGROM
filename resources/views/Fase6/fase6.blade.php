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
                            Fase 6 <small>Instalacion y Arranque</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Instalacion y Arranque
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
                                                <th>Ciudad</th>
                                                <th>Estado</th>
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
                                                <td>{{$proyecto->ciudad}}</td>
                                                <td>{{$proyecto->estado}}</td>
                                                <td>{{$proyecto->status}}</td>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Fase 6 Instalacion y Arranque</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                   

                    <div class="col-sm-12 ">
                        <div class="col-sm-12 col-lg-6">
                            <button id="new_seguimiento" type="button" class="btn btn-primary col-sm-12 waves-effect">Agenda Seguimiento</button>

                            <div id="add_seguimiento" >

                                <input id="seguimiento_fecha" type="datetime-local" class="form-control">
                                <select id="seguimiento_via" class="form-control">
                                    <option value="1">Correo</option>
                                    <option value="2">Telefon</option>
                                </select>
                                <textarea id="seguimiento_texto" class="form-control" placeholder="Escribir Seguimiento"></textarea>

                                <button id="guardar_seguimiento" type="button" class="btn btn-primary">Guardar</button>
                                <button id="cancelar_seguimiento" type="button" class="btn btn-danger">Cancelar</button>
                            </div>
                            
                        </div>

                        <div class="col-sm-12 col-lg-6">
                                <button id="new_visita" type="button" class="btn btn-warning col-sm-12 waves-effect">Agenda Visita</button>

                                <div id="add_visita" >
                                    <input id="visita_fecha" type="datetime-local" class="form-control">
                                    <span>Ciudad</span>
                                    <input id="visita_ciudad" class="form-control" type="text">
                                    <span>Estado</span>
                                    <input id="visita_estado" class="form-control" type="text">

                                    <button id="guardar_visita" type="button" class="btn btn-primary">Guardar</button>
                                    <button id="cancelar_visita" type="button" class="btn btn-danger">Cancelar</button>
                                </div>
                        </div>
                        

                        <div class="col-sm-12">
                            <h2 style="text-align: center; margin-top: 15px;">Reporte de Instalacion (Recordar Enviar al Cliente)</h2>
                            <div style="margin-top:20px" id="descargar_reporte"></div>
                            <input id="file_reporte" name="archivos[]" type="file" multiple class="file-loading">
                        </div>

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
                $("#add_visita").hide();
                $("#add_seguimiento").hide();
            });

            $("#new_seguimiento").click(function(){
                $("#add_seguimiento").show();
            });

            $("#new_visita").click(function(){
                $("#add_visita").show();
            });
           
           $("#cancelar_seguimiento").click(function(){
                $("#add_seguimiento").hide();
           });

           $("#cancelar_visita").click(function(){
                $("#add_visita").hide();
           });

           $(document).on("click",".verProyecto",function(){

                var proyecto = $(this).attr("data-proyecto");
                $("#guardar_seguimiento").attr("data-proyecto",proyecto);
                $("#guardar_visita").attr("data-proyecto",proyecto);
                $("#guardar_comentario").attr("data-proyecto",proyecto);
                $("#guardar_seguimiento").attr("data-proyecto",proyecto);
                $("#siguiente_fase").attr("data-proyecto",proyecto);
                cargar_proyecto(proyecto);

                var id = $(this).attr("data-proyecto");
                
                archivos(id, 0);
                
                $("#file_reporte").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase5/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 13 ,
                        proyecto :id ,
                    }
                });

                $("#file_reporte").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    archivos(id, 13);
                });

           });

            $("#guardar_seguimiento").click(function(){

                var texto = $("#seguimiento_texto").val();
                var fecha = $("#seguimiento_fecha").val();
                var via   = $("#seguimiento_via").val();
                var id    = $(this).attr("data-proyecto");
         
                $.post("Fase6/Ver_Proyecto/GuardarSeguimiento",{
                    texto : texto ,
                    fecha : fecha ,
                    via   : via   ,
                    proyecto : id
                })
                .done(function(){
                    $("#agendar_seguimiento").hide();

                    $("#seguimiento_texto").val('');
                    $("#seguimiento_fecha").val('');
                    $("#seguimiento_via").val(1);

                    $("#add_seguimiento").hide();
                    consultar_seguimientos(id);

                })
                .error(function(error){
                    alert("Error al guardar Seguimiento");
                });

            });

            $("#guardar_visita").click(function(){

                var fecha  = $("#visita_fecha").val();
                var ciudad = $("#visita_ciudad").val();
                var estado = $("#visita_estado").val();
                var proyecto = $(this).attr("data-proyecto");

                $.post("Fase6/Ver_Proyecto/GuardarVisita",{
                    fecha    : fecha    ,
                    ciudad   :ciudad    ,
                    estado   : estado   ,
                    proyecto : proyecto
                })
                .done(function(){
                    $("#add_visita").hide();
                    $("#visita_fecha").val('');
                    $("#visita_ciudad").val('');
                    $("#visita_estado").val('');
                })
                .error(function(){
                    alert("Error al Guardar la Visita");
                });

            });

            $("#guardar_comentario").click(function(){

                var comentario = tinyMCE.get('comentario').getContent();
                var proyecto   = $(this).attr("data-proyecto");

                $.post("Fase6/Ver_Proyecto/GuardarComentario",{
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

                $.post("Fase6/siguienteFase",{
                    proyecto : proyecto
                })
                .done(function(){
                    window.location.href = 'Fase6';
                })
                .error(function(){
                    alert("Error al pasar a la Fase 7");
                });
            });

            function cargar_proyecto(proyecto)
            {   
                
                $.get("Fase6/Ver_Proyecto/"+proyecto)
                .done(function(data){
                    console.log(data);

                    var seguimientos = data["seguimientos"];

                   
                    write_seguimientos(seguimientos);
                })
                .error(function(error){
                    alert("Error al Cargar el Proyecto");
                });
            }

            function consultar_seguimientos(proyecto)
            {
                $.get("Fase6/Ver_Proyecto/seguimientos/"+proyecto)
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

            

            $.get("Fase6/Ver_Proyecto/getarchivos/"+proyecto+"/"+tipo)
            .done(function(data){
                console.log("Archivos");
                console.log(data);
                //Si es cero quiere decir que en el data hay de todos los tipos
                var html = "";
                if( tipo == 0 )
                {
                    var cinco    = false;
                    var seis    = false;
              
                    var resultado = data["resultado"];

                    $("#descargar_reporte").html('');
                
                    

                    for( var x = 0 ; x < Object.keys(resultado).length ; x++ )
                    {
                        var type= resultado[x].id_tipo;
                        html = "";
                       
                            switch(type)
                            {
                                case 13:

                                    if( cinco == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo Cliente'+resultado[x].created_at+'</a>';
                                        $("#descargar_reporte").html(html);
                                       cinco= true;
                                    } 

                                break;
                                
                                
                            }
                    }

                }else{

                    var resultado = data["resultado"];
                    var x = 0;
                    switch(tipo)
                            {
                                case 13:
                                        $("#descargar_reporte").html('');
                                    
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo Cliente'+resultado[x].created_at+'</a>';
                                        $("#descargar_reporte").html(html);
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