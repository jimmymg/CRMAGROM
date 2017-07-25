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
                            Fase 7 <small>Post-Venta</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Post-Venta
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Fase 7 Post-Venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                   

                    <div class="col-sm-12 ">
                    
                        <h3 style="text-align: center">Llamada de Calidad</h3>
                        <h4 style="text-align: center">Preguntas para Evaluar y mejorar la Calidad de Nuestro Servicio</h4>

                        <h2><strong>¿Esta satisfecho con el producto y servicio?</strong></h2>

                       

                        <div style="margin-top:20px;" class="col-sm-12">
                            
                            <div class="col-sm-12">
                                <span style="font-size: 18pt">Si</span>
                                <input style=" height: 34px;" id="uno_si" type="checkbox" class="uno  col-sm-1" >
                            </div>

                            <div class="col-sm-12">
                                <span style="font-size: 18pt">Regular</span>
                                <input style=" height: 34px;" id="uno_regular" type="checkbox" class="uno  col-sm-1" >
                            </div>

                            <div class="col-sm-12">
                                <span style="font-size: 18pt">No</span>
                                <input style=" height: 34px;" id="uno_no" type="checkbox" class="uno  col-sm-1" >
                            </div>

                        </div>

                        <h2><strong>¿Como fue la actitud del personal?</strong></h2>

                        <div style="margin-top:20px;" class="col-sm-12">
                            
                            <div class="col-sm-12">
                                <span style="font-size: 18pt">Excelente</span>
                                <input style=" height: 34px;" id="dos_excelente" type="checkbox" class="dos  col-sm-1" >
                            </div>

                            <div class="col-sm-12">
                                <span style="font-size: 18pt">Bueno</span>
                                <input style=" height: 34px;" id="dos_bueno" type="checkbox" class="dos  col-sm-1" >
                            </div>

                            <div class="col-sm-12">
                                <span style="font-size: 18pt">Regular</span>
                                <input style=" height: 34px;" id="dos_regular" type="checkbox" class="dos  col-sm-1" >
                            </div>
                            <div class="col-sm-12">
                                <span style="font-size: 18pt">Malo</span>
                                <input style=" height: 34px;" id="dos_malo" type="checkbox" class="dos  col-sm-1" >
                            </div>

                            <!--
                            <input id="dos_bueno" type="checkbox" class="dos "><span>Bueno</span>
                            <input id="dos_regular" type="checkbox" class="dos "><span>Regular</span>
                            <input id="dos_malo" type="checkbox" class="dos "><span>Malo</span>
                            -->
                        </div>

                        <h2><strong>¿Que podriamos hacer para mejorar?</strong></h2>
                        <textarea id="opinion" style="margin-top: 20px;" class="form-control"></textarea>

                        <h2>*Recordar Leer los Comentarios para Realizar Preguntas</h2>
                        <h2>*Recordar Enviar o Tener a la Mano el Portafolio de Negocios y Enviarlo</h2>

                        <button id="finalizar_fase" style="margin-top:20px" type="button" class=" col-sm-12 waves-effect btn btn-danger btn-lg">Finalizar Proyecto</button>
                        
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
            
            $(".uno").click(function(){
                $('.uno').prop('checked', false);
                $(this).prop('checked', true);
               // $(this).attr("checked","true");
            });

            $(".dos").click(function(){
                $('.dos').prop('checked', false);
                $(this).prop('checked', true);
               // $(this).attr("checked","true");
            });

            $(document).on("click",".verProyecto",function(){
                var proyecto = $(this).attr("data-proyecto");
                $("#guardar_comentario").attr("data-proyecto",proyecto);
                $("#finalizar_fase").attr("data-proyecto",proyecto);
                cargar_proyecto(proyecto);
            });

            $("#guardar_comentario").click(function(){

                var proyecto   = $(this).attr("data-proyecto");
                var comentario = tinyMCE.get('comentario').getContent();

                $.post("Fase7/Ver_Proyecto/GuardarComentario",{
                    proyecto : proyecto ,
                    comentario : comentario
                })
                .done(function(){
                    consultar_seguimientos(proyecto);
                })
                .error(function(){
                    alert("Error al Guardar El Comentario");
                });

            });

            $("#finalizar_fase").click(function(){
                var respuesta_1 = "";

                var proyecto = $(this).attr("data-proyecto");

                if( $("#uno_si").is(":checked") )
                {
                    respuesta_1 = "si";
                }

                if( $("#uno_no").is(":checked") )
                {
                    respuesta_1 = "no";
                }

                if( $("#uno_regular").is(":checked") )
                {
                    respuesta_1 = "regular";
                }

                var respuesta_2 = "";

                if( $("#dos_excelente").is(":checked") )
                {
                    respuesta_2 = "excelente";
                }

                if( $("#dos_bueno").is(":checked") )
                {
                    respuesta_2 = "bueno";
                }

                if( $("#dos_regular").is(":checked") )
                {
                    respuesta_2 = "regular";
                }

                if( $("#dos_malo").is(":checked") )
                {
                    respuesta_2 = "malo";
                }

                var opinion = $("#opinion").val();

                $.post("Fase7/Ver_Proyecto/FinalizarProyecto",{
                    proyecto    : proyecto    ,
                    respuesta_1 : respuesta_1 ,
                    respuesta_2 : respuesta_2 ,
                    opinion     : opinion
                })
                .done(function(){
                    window.location.href = "Fase7";
                })
                .error(function(){
                    alert("Error al Finalizar el Proyecto");
                });
            }); 

            function cargar_proyecto(proyecto)
            {   
                
                $.get("Fase7/Ver_Proyecto/"+proyecto)
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
                $.get("Fase7/Ver_Proyecto/seguimientos/"+proyecto)
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
    </script>

</body>

</html>