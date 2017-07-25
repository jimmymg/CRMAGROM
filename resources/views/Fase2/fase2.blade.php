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
                            Fase 2 <small>Anticipos y Adminpac</small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Anticipos y Adminpac
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
                                                    <button data-target="#modalProyecto" data-toggle="modal" type="button" class="btn verProyecto" data-proyecto="{{$proyecto->id}}">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Fase2 Anticipos y Adminpac</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                    <!-- Seccion de Fase 2 -->

                    <div class="col-sm-12">
                        <h2 style="text-align: center;">SERVICIO</h2>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            
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
                                <span>Fecha de Pago Del Cliente</span>
                                <input id="cliente_fecha" class="form-control" type="date">
                                <span>Comentarios Sobre Acuerdo de Pago</span>
                                <textarea id="cliente_acuerdo" class="form-control"></textarea>
                            
                            </div>
                        </div>

                        <div class="col-sm-6">

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
                                <span>Fecha de Pago Al Proveedor</span>
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

                        <h3>NUMERO ADMINPAC</h3>
                        <input id="numero_adminpac" style="margin-top:10px" type="text" class="form-control">

                        <h3>Archivos</h3>
                        <h4>Anticipo Cliente
                            <button class="btn waves-effect">
                                <span class="glyphicon glyphicon-folder-open"></span>
                            </button> 
                        </h4>
                        
                        <div id="descargar_ac"></div>
                        <input id="file_anticipo_cliente" name="archivos[]" type="file" multiple class="file-loading">

                        <h4>Anticipo Proveedor
                            <button class="btn waves-effect">
                                <span class="glyphicon glyphicon-folder-open"></span>
                            </button> 
                        </h4>

                        <div id="descargar_ap"></div>
                        <input id="file_anticipo_proveedor" name="archivos[]" type="file" multiple class="file-loading">

                        <button id="siguiente_fase" style="margin-top:20px" type="button" class=" col-sm-12 waves-effect btn btn-success btn-lg">Siguiente Fase</button>
                        
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

            $(document).on("click",".verProyecto", function(){
                $("#siguiente_fase").attr("data-proyecto",$(this).attr("data-proyecto"));
                cargar_proyecto($(this).attr("data-proyecto"));
                var id = $(this).attr("data-proyecto");
                archivos( id , 0);

                $("#file_anticipo_cliente").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase2/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 5 ,
                        proyecto :id ,
                    }
                });

                $("#file_anticipo_cliente").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 5);
                });

                $("#file_anticipo_proveedor").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase2/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 6 ,
                        proyecto :id ,
                    }
                });

                $("#file_anticipo_proveedor").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos(id, 6);
                });

            });

            $("#siguiente_fase").click(function(){

                var cliente_s   = $("#anticipo_cliente").val();
                var proveedor_s = $("#anticipo_proveedor").val();

                var proyecto  = $(this).attr("data-proyecto");
                
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

                var proyecto = $(this).attr("data-proyecto");
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

                    if( cliente_total == "" || cliente_abono == "" || cliente_pendiente == "" || cliente_fecha_depago == "" || cliente_comentario == ""  )
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
                        numero_admin            : numero_admin
                    })
                    .done(function(data){

                        if( data == "Error Campos Vacios" || data == "Error Numero AdminPac Vacio" )
                        {
                            alert("Error no selecciono ninguno de los dos Anticipos o Numero de AdminPac esta vacio");
                        }else{

                            window.location.href = "Fase2";

                        }
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

            });

            function cargar_proyecto(proyecto)
            {
                $.get("Fase2/Ver_Proyecto/"+proyecto)
                .done(function(data){
                    console.log(data);
                    var html = "";
                    var administradores = data["administradores"];
                    for( var x = 0 ; x < Object.keys(administradores).length  ; x++)
                    {

                        html+= '<div class="col-sm-3 waves-effect" >'+
                                    '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                        '<div class="panel-footer back-footer-green">'+administradores[x].nombre+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                         
                    }

                    $("#proyecto_administradores").html(html);

                })
                .error(function(error){
                    alert("Error al Cargar el Proyecto")
                });
            }

            function archivos(proyecto , tipo)
            {   

            

            $.get("Fase2/Ver_Proyecto/getarchivos/"+proyecto+"/"+tipo)
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

    </script>

</body>

</html>