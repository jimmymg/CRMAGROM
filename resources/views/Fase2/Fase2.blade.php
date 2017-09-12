<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styless-->
    @include("layouts.css")
    <link href="{{url('css/fileinput.min.css')}}" rel="stylesheet" />
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
                            Fase 2 <small>Anticipos y Adminpaq</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Anticipos y Adminpaq
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
                                                <th>Tipo</th>
                                                <th>Cliente</th>
                                                <th>Empresa</th>
                                                <th>Moneda</th>
                                                <th>Valor</th>
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
                                                    <button data-target="#modalProyecto" data-toggle="modal" type="button" class="btn verProyecto btn-primary" data-proyecto="{{$proyecto->id}}">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button>
                                                    {{$proyecto->nombre}}
                                                </td>
                                                <td>{{$proyecto->tipo}}</td>
                                                <td>{{$proyecto->cliente}}</td>
                                                <td>{{$proyecto->empresa}}</td>
                                                <td>{{$proyecto->moneda}}</td>
                                                <td>{{$proyecto->valor}}</td>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Fase2 Anticipos y Adminpaq</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                    <!-- Seccion de Fase 2 -->

                    <div id="cargando-Proyecto">
                        <div style="margin-left:45%" class="cargando2">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <input type="hidden" id="data-proyecto" value="">

                    <div class="col-sm-12">
                        <h2 id="titulo" style="text-align: center;">SERVICIO</h2>
                        <h3 id="nombre_proyecto" style="text-align: center;"></h3> 
                    </div>

                    <div class="col-sm-12" >
                        <div class="col-sm-6" id="place_anticipo_cliente">
                            
                            <h3 style="text-align: center;">Anticipo Cliente</h3>
                            <select id="anticipo_cliente" class="form-control">
                                <option value="2">No</option>
                                <option value="1">Si</option>
                                
                            </select>
                            <div>
                                <span>Monto Total:</span>
                                <input id="cliente_total" type="text" class="form-control">
                                <span>Abono:</span>
                                <input id="cliente_abono" type="text" class="form-control">
                                <span>Pendiente por Pagar:</span>
                                <input id="cliente_pendiente" type="text" class="form-control">
                                <span>Fecha del Siguiente Pago Del Cliente</span>
                                <input id="cliente_fecha" class="form-control" type="date">
                                <span>Comentarios Sobre Acuerdo de Pago</span>
                                <textarea id="cliente_acuerdo" class="form-control"></textarea>
                            
                            </div>
                        </div>

                        <div class="col-sm-6" id="place_anticipo_proveedor">

                            <h3 style="text-align: center;">Anticipo Proveedor</h3>
                            <select id="anticipo_proveedor" class="form-control">
                                <option value="2">No</option>
                                <option value="1">Si</option>
                                
                            </select>
                            <div>
                                <span>Monto Total:</span>
                                <input id="proveedor_total" type="text" class="form-control">
                                <span>Abono:</span>
                                <input id="proveedor_abono" type="text" class="form-control">
                                <span>Pendiente por Pagar:</span>
                                <input id="proveedor_pendiente" type="text" class="form-control">
                                <span>Fecha del Siguiente Pago Al Proveedor</span>
                                <input id="proveedor_fecha" class="form-control" type="date">
                                <span>Comentarios Sobre Acuerdo de Pago</span>
                                <textarea id="proveedor_acuerdo" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END Seccion de Fase 2-->
                    
                    <div class="col-sm-12">
                       

                        <h3 style="text-align: center;"><strong>Administradores</strong></h3>
                        <div id="proyecto_administradores" class="col-sm-12" style="margin-top:10px;">
                            
                        </div>

                        <div class="col-lg-12">
                            <div class="material-switch pull-left">
                                <input id="contado_c" name="someSwitchOption001" type="checkbox"/>
                                <label for="contado_c" class="label-primary"></label>
                            </div>
                            <label style="margin-left: 10px">Pago de Contado del Cliente</label>

                        </div>
                        <div class="col-lg-12">
                            <div class="material-switch pull-left">
                                <input id="contado_p" name="someSwitchOption001" type="checkbox"/>
                                <label for="contado_p" class="label-primary"></label>
                            </div>
                            <label style="margin-left: 10px">Pago de Contado al Proveedor</label>

                        </div>
                        <div class="col-lg-12">
                            <div class="material-switch pull-left">
                                <input id="producto_stock" name="someSwitchOption001" type="checkbox"/>
                                <label for="producto_stock" class="label-primary"></label>
                            </div>
                            <label style="margin-left: 10px">Ya se cuenta con el producto</label>

                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <h3>Folio del Pedido</h3>
                                <input id="numero_adminpac" style="margin-top:10px" type="text" class="form-control">
                            </div>
                        </div>

                        <h3>Archivos</h3>

                        <a id="place_c" download href="">
                            <span  class="glyphicon glyphicon-save-file fa-4" aria-hidden="true"></span>
                        Cotizacion</a>
                        
                        <a id="place_occ" download href="">
                            <span  class="glyphicon glyphicon-save-file fa-4" aria-hidden="true"></span>
                        Orden de Compra del Cliente</a>

                        <a id="place_ocp" download href="">
                            <span  class="glyphicon glyphicon-save-file fa-4" aria-hidden="true"></span>
                        Orden de Compra del Proveedor</a>

                        <a id="place_afp" download href="">
                            <span  class="glyphicon glyphicon-save-file fa-4" aria-hidden="true"></span>
                        Adjunto Formao Pedido</a>

                        <div id="place_file_ac">
                            <h4>Anticipo Cliente
                                <button type="button" class="btn waves-effect" id="archivos_anticipo_cliente">
                                    <span class="glyphicon glyphicon-folder-open" ></span>
                                </button> 
                            </h4>
                        
                            <div id="descargar_ac"></div>
                            <input id="file_anticipo_cliente" name="archivos[]" type="file" multiple class="file-loading">
                        </div>
                        <div id="place_file_ap">
                            <h4>Anticipo Proveedor
                                <button type="button" class="btn waves-effect" id="archivos_anticipo_proveedor">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                </button> 
                            </h4>

                            <div id="descargar_ap"></div>
                            <input id="file_anticipo_proveedor" name="archivos[]" type="file" multiple class="file-loading">
                        </div>
                            <button id="siguiente_fase" style="margin-top:20px;display:grid;" type="button" class=" col-sm-12 waves-effect btn btn-success btn-lg">
                            <i class="glyphicon glyphicon glyphicon-check fa-2x"></i>
                            Cambiar a Fase 3 Faccturacion</button>
                        

                        <div class="col-sm-12">
                            <h3 style="margin-top: 10px; margin-bottom:10px;">Comentarios y Seguimientos</h3>
                            <textarea id="comentario"></textarea>

                            <button style="margin-top: 10px;" id="guardar_comentario" type="button" class="btn btn-warning">Guardar Comentario</button>

                            <div id="lugar_comentarios" style="margin-top:10px;">
                            
                            </div>
                        </div>
                        
                    </div>
                

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    @include('Fase1.fase1Modals.vistaArchivos')
   
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    
    <script src="{{url('js/fileinput.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'#comentario' });</script>
    <script src="{{url('js/vistaArchivos.js')}}"></script>


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
                $("#anticipo_cliente").parent().find("div").hide();
                $("#anticipo_proveedor").parent().find("div").hide();
            });

            $("#anticipo_cliente").click(function(){

                if( $("#anticipo_cliente").val() == 1 )
                {
                    $(this).parent().find("div").show();
                }else{
                    $(this).parent().find("div").hide();
                }
                
            });

            $("#anticipo_proveedor").click(function(){

                if( $("#anticipo_proveedor").val() == 1 )
                {
                    $(this).parent().find("div").show();
                }else{
                    $(this).parent().find("div").hide();
                }
            });

            $("#contado_c").change(function(){
                if( $(this).is(":checked") )
                {   
                    $("#place_anticipo_cliente").hide();
                    $("#place_file_ac").hide();
                }else{
                    $("#place_anticipo_cliente").show();
                    $("#place_file_ac").show();
                }
            });

            $("#contado_p").change(function(){
                if( $(this).is(":checked") )
                {   
                    $("#producto_stock").prop("checked",false);
                    $("#place_anticipo_proveedor").hide();
                    $("#place_file_ap").hide();
                }else{
                    $("#place_file_ap").show();
                    $("#place_anticipo_proveedor").show();
                }
            });

            $("#producto_stock").change(function(){
                if( $(this).is(":checked") )
                {   
                    $("#contado_p").prop("checked",false);
                    $("#place_anticipo_proveedor").hide();
                    $("#place_file_ap").hide();
                }else{
                    $("#place_file_ap").show();
                    $("#place_anticipo_proveedor").show();
                }
            });

            $(document).on("click",".verProyecto", function(){
                
                $("#cargando-Proyecto").show();
               // $("#cargando-Proyecto").parent().find("div:nth-child(2)").hide();
                $("#cargando-Proyecto").parent().find("div:nth-child(3)").hide();
                $("#cargando-Proyecto").parent().find("div:nth-child(4)").hide();
                $("#cargando-Proyecto").parent().find("div:nth-child(5)").hide();

                $("#data-proyecto").val($(this).attr("data-proyecto"));
                var id = $("#data-proyecto").val();
                consultar_seguimientos(id);
                //$("#siguiente_fase").attr("data-proyecto",$(this).attr("data-proyecto"));

                cargar_proyecto(id);

                //Sirve para ver si ya se subio un archivo
                archivos( id , 0);

                $("#file_anticipo_cliente").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase2/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: function(previewId , index) {

                        return { "tipo" : 5 , "proyecto" : $("#data-proyecto").val() };
                    }
                });

                //Sirva para que cuando se suba un archivo lo muestre solo ese archivo
                $("#file_anticipo_cliente").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 5);
                });

                $("#file_anticipo_proveedor").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase2/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: function(previewId , index) {

                        return { "tipo" : 6 , "proyecto" : $("#data-proyecto").val() };
                    }
                });

                $("#file_anticipo_proveedor").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 6);
                });

            });//verProyecto

            $("#guardar_comentario").click(function(){

                var comentario = tinyMCE.get('comentario').getContent();
                var proyecto   = $("#data-proyecto").val();
    
                $.post("Fase1/Ver_Proyecto/GuardarComentario",{
                    comentario : comentario ,
                    proyecto   : proyecto
                })
                .done(function(){
                    //Recargar los Comentario y limpiar la caja de texto
                    consultar_seguimientos(proyecto);
                    tinyMCE.activeEditor.setContent('');
                })
                .error(function(){
                    alert("Error al Guardar el Comentario");
                });
            });

            $("#siguiente_fase").click(function(){

                
                var cliente_s   = $("#anticipo_cliente").val();
                var proveedor_s = $("#anticipo_proveedor").val();

                var proyecto  = $("#data-proyecto").val();
                
                var cliente = false;
                var cliente_total = "";
                var cliente_abono = "";
                var cliente_pendiente = "";
                var cliente_fecha_de_pago = "";
                var cliente_comentario = "";

                var proveedor = false;
                var proveedor_total = "";
                var proveedor_abono = "";
                var proveedor_pendiente = "";
                var proveedor_fecha_de_pago = "";
                var proveedor_comentario = "";

                var numero_admin = $("#numero_adminpac").val();

                var cliente_error = false;
                if( cliente_s  == 1 )
                {   
                    cliente = true;
                    cliente_total         = $("#cliente_total").val();
                    cliente_abono         = $("#cliente_abono").val();
                    cliente_pendiente     = $("#cliente_pendiente").val();
                    cliente_fecha_de_pago = $("#cliente_fecha").val();
                    cliente_comentario    = $("#cliente_acuerdo").val();

                    if( cliente_total == "" || cliente_abono == "" || cliente_pendiente == "" || cliente_fecha_de_pago == "" || cliente_comentario == ""  )
                    {
                        cliente_error = true;
                    }
                }

                var proveedor_error = false;
                if( proveedor_s == 1 )
                {   
                    proveedor = true;
                    proveedor_total         = $("#proveedor_total").val();
                    proveedor_abono         = $("#proveedor_abono").val();
                    proveedor_pendiente     = $("#proveedor_pendiente").val();
                    proveedor_fecha_de_pago = $("#proveedor_fecha").val();
                    proveedor_comentario    = $("#proveedor_acuerdo").val();

                    if( proveedor_total == "" || proveedor_abono == "" || proveedor_pendiente == "" || proveedor_fecha_de_pago == "" || proveedor_comentario == "" )
                    {
                        proveedor_error = true;
                    }
                }

                var tipo_error = 0;

                if( cliente == true && cliente_error == true )
                {
                    tipo_error = 1;
                }

                if( proveedor == true && proveedor_error == true )
                {
                    tipo_error = 2;
                }

                swal({
                    title: '¿Estas Seguro?',
                    text: "El Proyecto se Cambiara a la Fase 3 Facturacion",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function () {
                    
                    
                    if( numero_admin == "" )
                    {
                        swal("Error","Numero del Pedido esta vacio","error");
                        return 0;
                    }



                    if( tipo_error == 0 ){
                    
                    $.post("Fase2/siguienteFase",{
                        cliente                 : cliente_s                ,
                        cliente_total           : cliente_total           ,
                        cliente_abono           : cliente_abono           ,
                        cliente_pendiente       : cliente_pendiente       ,
                        cliente_fecha_de_pago   : cliente_fecha_de_pago   ,
                        cliente_comentario      : cliente_comentario      ,
                        proveedor               : proveedor_s             ,
                        proveedor_total         : proveedor_total         ,
                        proveedor_abono         : proveedor_abono         ,
                        proveedor_pendiente     : proveedor_pendiente     ,
                        proveedor_fecha_de_pago : proveedor_fecha_de_pago ,
                        proveedor_comentario    : proveedor_comentario    ,

                        proyecto                : proyecto                ,
                        numero_admin            : numero_admin            ,

                        contado_cliente         : ($("#contado_c").is(":checked"))?1:0 ,
                        contado_proveedor       : ($("#contado_p").is(":checked") )?1:0,
                        en_stock                : ($("#producto_stock").is(":checked"))?1:0
                    })
                    .done(function(data){
                        console.log(data);
                      
                            window.location.href = "Fase2";

                        
                    })
                    .error(function(error){
                        alert("Error al Guardar la Informacion");
                    });

                    }else{
                        switch(tipo_error)
                        {
                            case 1:
                                swal("Error","Un Campo en Cliente esta Vacio","error")
                            break;
    
                            case 2:
                                swal("Error","Un Campo en Proveedor esta Vacio","error")
                            break;
                        }

                    }
                }, function () {
                    // dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                    
                })
               


            });//End Siguiente Fase

            function cargar_proyecto(proyecto)
            {
                $.get("Fase2/Ver_Proyecto/"+proyecto)
                .done(function(data){
                    console.log(data);
                    var html = "";
                    var administradores = data["administradores"];
                    var proyecto        = data['proyecto'][0];
                    for( var x = 0 ; x < Object.keys(administradores).length  ; x++)
                    {

                        html+= '<div class="col-sm-3 waves-effect" >'+
                                    '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                        '<div class="panel-footer back-footer-green">'+administradores[x].nombre+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                         
                    }
                    $("#titulo").html(proyecto.tipo);
                    $("#proyecto_administradores").html(html);

                    $("#cargando-Proyecto").hide();
                    $("#cargando-Proyecto").parent().find("div:nth-child(3)").show();
                    $("#cargando-Proyecto").parent().find("div:nth-child(4)").show();
                    $("#cargando-Proyecto").parent().find("div:nth-child(5)").show();

                    $("#anticipo_cliente").parent().find("div").hide();
                    $("#anticipo_proveedor").parent().find("div").hide();
                })
                .error(function(error){
                    alert("Error al Cargar el Proyecto")
                });
            }

            function ver_archivos(archivos)
            {
                var info = archivos.resultado;
                console.log(archivos);
                var url = archivos.url+"/";
                    $("#place_c").hide();
                    $("#place_occ").hide();
                    $("#place_ocp").hide();
                    $("#place_afp").hide();
                

                for( var x = 0 ; x < Object.keys(info).length ; x++ )
                {
                    if( info[x].id_tipo == 1 )
                    {
                        $("#place_c").show();
                        $("#place_c").attr("href",url+""+info[x].ruta);
                    }

                    if( info[x].id_tipo == 2 )
                    {
                        $("#place_occ").show();
                        $("#place_occ").attr("href",url+""+info[x].ruta);
                    }

                    if( info[x].id_tipo == 3 )
                    {
                        $("#place_ocp").show();
                        $("#place_ocp").attr("href",url+""+info[x].ruta);
                    }

                    if( info[x].id_tipo == 4 )
                    {
                        $("#place_afp").show();
                        $("#place_afp").attr("href",url+""+info[x].ruta);
                    }
                }
            }

            function archivos(proyecto , tipo)
            {   

            $.get("Fase2/Ver_Proyecto/getarchivos/"+proyecto+"/"+tipo)
            .done(function(data){
                /*
                console.log("Archivos");
                console.log(data);*/
                //Si es cero quiere decir que en el data hay de todos los tipos
                ver_archivos(data);
                var html = "";
                if( tipo == 0 )
                {
                    var cinco    = false;
                    var seis    = false;
              
                    var resultado = data["resultado"];

                    $("#descargar_ac").html('');
                    $("#descargar_ap").html('');
                    

                    for( var x = 0 ; x < Object.keys(resultado).length ; x++ )
                    {
                        var type= resultado[x].id_tipo;
                        html = "";
                       
                            switch(type)
                            {
                                case 5:

                                    if( cinco == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo Cliente'+resultado[x].created_at+'</a>';
                                        $("#descargar_ac").html(html);
                                       cinco= true;
                                    } 

                                break;
                                case 6:
                                
                                        if( seis == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo Proveedor'+resultado[x].created_at+'</a>';
                                        $("#descargar_ap").html(html);
                                       seis = true;

                                        } 
                                break;
                                
                            }
                    }

                }else{

                    var resultado = data["resultado"];
                    var x = 0;
                    switch(tipo)
                            {
                                case 5:
                                        $("#descargar_cotizacion").html('');
                                    
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo Cliente'+resultado[x].created_at+'</a>';
                                        $("#descargar_ac").html(html);
                                break;

                                case 6:
                                        $("#descargar_ap").html('');
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Anticipo Proveedor'+resultado[x].created_at+'</a>';
                                        $("#descargar_ap").html(html);
                                break;
                                
                            }
                }
            })
            .error(function(){
                alert("Error Al Consultar las Cortizaciones");
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
    </script>

</body>

</html>