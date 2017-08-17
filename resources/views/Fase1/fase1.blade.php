<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
    <link href="{{url('css/fileinput.min.css')}}" rel="stylesheet" />
     <link href="{{url('js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
     <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
     <!-- Plugin DateTimePicker CSS -->
    <link href="{{url('plugins/bootstrap-datetimepicker-malot/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" />
    
    
</head>

<body >
@include("layouts.cargando")
    
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Fase 1 <small>Oportunidades</small>
                        </h1>
                    </div>
                </div>

                <div style="margin-bottom:20px" class="row">
                    <div class="col-sm-12">
                            <button id="estado_proceso" type="button" class="btn btn-lg btn-success waves-effect">En Proceso</button>
                            <button id="estado_enespera" type="button" class="btn btn-lg btn-warning waves-effect">Pausados</button>
                            <button type="button" class="btn btn-lg btn-default waves-effect">Finalizados</button>
                            <button type="button" class="btn btn-lg btn-danger waves-effect">Cancelados</button>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">Nuevo Proyecto</button>
                    </div>
                </div>

                <div id="place_of_dataTables-index" class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Oportunidades
                                <button class="btn">Filtrar</button>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" 
                                    id="dataTables-index">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Inicador</th>
                                                <th width="30%">Proyecto</th>
                                                <th>Tipo</th>
                                                <th>Moneda</th>
                                                <th>Valor</th>
                                                <th>Area</th>
                                                <th>Cliente</th>
                                                <th>Empresa</th>
                                                <th>Estado</th>
                                                <th>Creado Por</th>
                                                <th>Fuente</th>
                                                <th>Creado el</th>
                                                <th>Cancelar</th>
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

    <!-- MODALS -->

    <div class="modal fade " id="modalProyecto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                    <input type="hidden" id="data-proyecto">
                    <div class="col-sm-6">
                        <div class="form-horizontal">
                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="inputDefault">
                                    <button id="editar_proyecto" type="button" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    Proyecto:
                                    </button>
                                </label>
                                <div class="col-sm-9">
                                    <h2><strong id="look_proyecto"></strong></h2>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="inputDefault">
                                    <button id="editar_descripcion" type="button" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    Descripcion:
                                    </button>
                                </label>
                                <div class="col-sm-9">
                                    <h3 id="look_descripcion"></h3>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="inputDefault">
                                    <button id="editar_valor" type="button" class="btn btn-primary btn-sm">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    Valor:
                                    </button>
                                </label>
                                <div class="col-sm-9">
                                    <h3 id="look_valor"></h3>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault">Tipo:</label>
                                <div class="col-sm-9">
                                    <h4 id="look_tipo" style="padding: 0;">Tipo</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault">Moneda:</label>
                                <div class="col-sm-9">
                                    <h4 id="look_moneda" style="padding: 0;">Moneda</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault">Area:</label>
                                <div class="col-sm-9">
                                    <h4 id="look_area" style="padding: 0;">Area</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault">     <button id="contactos_extras" type="button" class="btn btn-primary"> 
                                        <span class="glyphicon glyphicon-plus-sign"></span> 
                                        Cliente:
                                    </button>
                                </label>
                                <div class="col-sm-9">
                                    <h4 style="padding: 0;" id="look_cliente"></h4>
                                    <ul class="list-group">
                                        <li class="list-group-item">Correo 1:<strong id="look_correo1"></strong></li>
                                        <li class="list-group-item">Correo 2:<strong id="look_correo2"></strong></li>
                                        <li class="list-group-item">Telefono:<strong id="look_telefono"></strong></li>
                                        <li class="list-group-item">Celular:<strong id="look_celular"></strong></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault">Empresa:</label>
                                <div class="col-sm-9">
                                    <h4 style="padding: 0;" id="look_empresa"></h4>
                                    <ul class="list-group">
                                        <li class="list-group-item">Giro:<strong id="look_giro"></strong></li>
                                        <li class="list-group-item">Direccion:<strong id="look_direccion"></strong></li>
                                        <li class="list-group-item">Ciudad:<strong id="look_ciudad"></strong></li>
                                        <li class="list-group-item">Estado:<strong id="look_estado"></strong></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault">Status:</label>
                                <div class="col-sm-9">
                                    <h4 style="padding: 0;" id="look_status"></h4>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="inputDefault" >Fuente:</label>
                                <div class="col-sm-9">
                                    <h4 style="padding: 0;" id="look_fuente"></h4>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3 style="text-align: center;"><strong>Marcas</strong></h3>

                        <div id="proyecto_marcas" class="col-sm-12" style="margin-top:10px;" >
                            
                           

                        </div>

                        <h3 style="text-align: center;"><strong>Admins</strong></h3>
                        <div id="proyecto_administradores" class="col-sm-12" style="margin-top:10px;">
                            
                           

                        </div>

                        <button type="button" id="mostrar_agendar_seguimiento" class="btn waves-effect btn-primary col-sm-12">Registrar Seguimiento</button>

                        <!--Todos los campos relacionados son registrar seguimiento tienen agendar para no confundirse-->
                        <!-- El Agendar Seguimiento de Verdad se llmara AS -->
                        <div id="agendar_seguimiento">
                            <p>Esta seccion es para registrar un seguimiento, es para validar que se realizo un seguimiento.</p>
                            <textarea id="seguimiento_texto" class="form-control" placeholder="Escribir Seguimiento..."></textarea>
                            <input id="seguimiento_fecha" type="datetime-local" class="form-control">
                            <select id="seguimiento_via" class="form-control">
                                <option value="1">Email</option>
                                <option value="2">Telefono</option>
                            </select>
                            <button type="button" id="guardar_seguimiento" class="btn btn-primary">Guardar</button>

                            <button  type="button" class="btn btn-danger" id="close_agendar_seguimiento">Cancelar</button>
                        </div>

                        <button style="margin-top: 25px;" id="agendar_recordatorio_seguimiento" type="button" class="btn btn-warning col-sm-12 waves-effect">Agendar Recordatorios de Seguimientos</button>

                        <button style="margin-top: 10px;" data-target="#GoogleCalendarModal" data-toggle="modal" type="button" class="btn col-sm-12 waves-effect">

                            <img width="200px" src="{{url('/img/google_calendar.png')}}">

                        </button>

                        <h3>Archivos</h3>
                        <h4>Cotizacion(Obligatorio) 
                            <button class="btn waves-effect " id="archivos_cotizacion">
                                <span class="glyphicon glyphicon-folder-open"></span>
                            </button> 
                        </h4>

                        <div id="descargar_cotizacion">
                        </div>

                        <div id="palce_of_cotizacion">
                            <input id="cotizacion" name="archivos[]" type="file" multiple class="file-loading">
                        </div>

                        <h4>Orden De Compra Cliente(Obligatorio)
                            <button class="btn waves-effect">
                                <span class="glyphicon glyphicon-folder-open"></span>
                            </button> 
                        </h4>

                        <div id="descargar_ordencompra"></div>

                        <input id="ordencompra" name="archivos[]" type="file" multiple class="file-loading">

                        <h4>Orden De Compra Proveedor
                            <button class="btn waves-effect">
                                <span class="glyphicon glyphicon-folder-open"></span>
                            </button> 
                        </h4>

                        <div id="descargar_ordenproveedor"></div>

                        <input id="ordenproveedor" name="archivos[]" type="file" multiple class="file-loading">

                        <h4>Adjunto Formato Pedido
                            <button class="btn waves-effect">
                                <span class="glyphicon glyphicon-folder-open"></span>
                            </button> 
                        </h4>

                        <div id="descargar_formatopedido"></div>

                        <input id="formatopedido" name="archivos[]" type="file" multiple class="file-loading">

                     
                        <button id="siguiente_fase" style="margin-top:20px" type="button" class=" col-sm-12 waves-effect btn btn-success btn-lg">Siguiente Fase</button>
                        
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

    @include('Fase1.fase1Modals.NuevoProyecto')
    @include('Fase1.fase1Modals.Marcas')
    @include('Fase1.fase1Modals.Clientes')
    @include('Fase1.fase1Modals.Administradores')
    @include('Fase1.proyectosModals.agendar')
    @include('Fase1.fase1Modals.vistaArchivos')
    @include('Fase1.fase1Modals.Editar')
    @include('Fase1.fase1Modals.ContactosExtras')
    @include('Fase1.fase1Modals.GoogleCalendar')
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <!-- plugin datetimepicker JS -->
    <script src="{{url('plugins/bootstrap-datetimepicker-malot/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{url('plugins/bootstrap-datetimepicker-malot/js/locales/bootstrap-datetimepicker.es.js')}}"></script>
    <!-- END plugin datetimepicker JS -->
    <script src="{{url('js/fileinput.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'#comentario' });</script>

    <script src="{{url('js/vistaArchivos.js')}}"></script>
    <!-- JS  -->
    <script src="{{url('js/Fase1/editar_proyecto_general.js')}}"></script>
    <script src="{{url('js/Fase1/cargar_tabla.js')}}"></script>
    <script src="{{url('js/Fase1/contactos_extras.js')}}"></script>
    <!-- End JS  -->
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
            
        responsivo_ChangeDataTable('place_of_dataTables-index');


            var f = new Date();
            //alert(f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ":" + f.getMinutes() +":00" );
        $(".form_datetime").datetimepicker({

            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
            todayBtn: false ,
            startDate: f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ":" + f.getMinutes() +":00",
            language: 'es'

        });

  $("#money").on({
  "focus": function(event) {
    $(event.target).select();
  },
  "keyup": function(event) {
    $(event.target).val(function(index, value) {
      return value.replace(/\D/g, "")
        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    });
  }
});

        $("#modalAgendar").on('hidden.bs.modal' , function(e){
            $("body").addClass("modal-open");
        });

        $("#GoogleCalendarModal").on('hidden.bs.modal' , function(e){
            $("body").addClass("modal-open");
        });

        $("#agendar_el_recordatorio").click(function(){
            var fecha        = $("#fecha_agendado").val();
            var recordatorio = $("#texto_recordatorio").val();
            var via          = $("#via_agendar").val();

            var error=false;

            var proyecto = $(this).attr("data-proyecto");

            if( via == 0 )
            {
                error = true;
                swal("Error","Seleccione una via","error")
            }

            if( fecha == "" )
            {   
                error = true;
                swal("Error","Agregar una fecha","error")
            }

            if( recordatorio == "" )
            {   
                error = true;
                swal("Error","No se ha agregado ningun recordatorio ","error")
            }  

            if( error == false )
            {   
                $.post("Fase1/Ver_Proyecto/AgendarRecordatorio",{
                    proyecto : proyecto ,
                    via : via ,
                    fecha : fecha ,
                    recordatorio : recordatorio
                })
                .done(function(data){
                    swal("Agendado","El Recordatorio se Agendo","success")
                })
                .error(function(){
                    alert("Error al Agendar el Recordatorio");
                });
            }
                
             
        });//end agendar_el_recordatorio

        //Google Calendar Inicio
        $("#add_event_calendar").click(function(){
            var date = $("#gc_date").val();
            var time = $("#gc_time").val();
            var re   = $("#gc_recordatorio").val();
            var proyecto = $("#agendar_el_recordatorio").attr('data-proyecto');
            $.post('addEvent',{
                date  : date ,
                time  : time ,
                re    : re   ,
                proyecto : proyecto
            })
            .done(function(data){
                
                swal("Guardado","Se añadio un nuevo Evento en Google Calendar","success")
            })
            .error(function(){

            });
        });
        //Google Calendar End
        
            $(document).ready(function(){
                
                cargar_marcas();
                cargar_clientes();
                cargar_Administradores();
                cargar_campos_generales();
                $("#agendar_seguimiento").hide();
                
                $("#modalNuevo").find('.modal-footer').find('.cargando2').hide();

            });


            $("#agendar_recordatorio_seguimiento").click(function(){
                $("#modalAgendar").modal('show');
            });

        $("body").on("click","#cancelar",function(){

            var proyecto = $(this).attr("data-proyecto");

            swal({
                title: '¿Deseas Cancelar Este Proyecto?',
                text: "Este Proyecto se Mostrara en Proyectos Cancelados",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Cancelarlo!'
            }).then(function () {
                swal(
                    'Cancelado!',
                    'El Proyecto fue Cancelado.',
                    'success'
                    )
                $.post("Fase1/Proyectos/CambiarEstado",{
                    proyecto    : proyecto ,
                    nuevoEstado : 3
                })
                .done(function(){
                    location.reload();
                })
                .error(function(error){
                    alert("Error al Cancelar El Proyecto Intentelo otra vez");
                });
            })

            
        });

        $("#estado_proceso").click(function(){
            window.location.href = "Fase1/Proyectos/EnProceso";
        });

        $("#estado_enespera").click(function(){
            window.location.href = "Fase1/Proyectos/EnEspera";
        });

        $("#mostrar_agendar_seguimiento").click(function(){
            $("#agendar_seguimiento").show();
        });
        $("#close_agendar_seguimiento").click(function(){
            $("#agendar_seguimiento").hide();
        });

        $("#guardar_Nuevo_Proyecto").click(function(){

            $(this).hide();
            $("#modalNuevo").find('.modal-footer').find('.cargando2').show();

            var proyecto    = $("#proyecto").val();
            var descripcion = $("#descripcion").val();
            var cmb_Tipo    = $("#cmb_Tipo").val();
            var cmb_Valor   = $("#cmb_Valor").val();
            var cmb_Area    = $("#cmb_Area").val();
            var money       = $("#money").val();

            var arr_marcas  = []; 

            $("#lugar_marcas").find(".col-sm-3").each(function(n){
                
                var id = $(this).attr("id");

                arr_marcas.push(id);
            });

            var cliente = $("#cliente_seleccionado").find("ul").attr("data-cliente");

            var estatus = $("#cmb_Estatus").val();
            var fuentes = $("#cmb_Fuentes").val();
            var administradores = [];

            $("#lugar_administradores").find(".col-sm-3").each(function(n){

                var admin = $(this).attr("data-administrador");

                administradores.push(admin);
            });

            var error = false;

            if( proyecto == "" || descripcion == "" || arr_marcas.length == 0 || administradores.length == 0 ){
                error = true;
            }

            if( error == false ){

            $.post("Fase1/Guardar_Proyecto",{

                proyecto         : proyecto        ,
                descripcion      : descripcion     ,
                cmb_Tipo         : cmb_Tipo        ,
                cmb_Valor        : cmb_Valor       ,
                cmb_Area         : cmb_Area        ,
                arr_marcas       : arr_marcas      ,
                cliente          : cliente         ,
                estatus          : estatus         ,
                fuentes          : fuentes         ,
                administradores  : administradores ,
                money            : money

            })
            .done(function(data){
                window.location.href = "Fase1";
                console.log(data);
            })
            .error(function(error){
                $("#guardar_Nuevo_Proyecto").show();
                $("#modalNuevo").find('.modal-footer').find('.cargando2').hide();
                alert("Error Llame a jimmy o intentelo otra vez");
            });

            }else{
                swal('Error','¡Llene todos los Campos!','error')
                $("#guardar_Nuevo_Proyecto").show();
                $("#modalNuevo").find('.modal-footer').find('.cargando2').hide();
               
            }
        });

        $(document).on("click",".check-marca",function(){


            if( $(this).hasClass("glyphicon-unchecked") )
            {
                $(this).removeClass("glyphicon-unchecked");
                $(this).addClass("glyphicon-check");

                var html = '<div class="col-sm-3 waves-effect" id="'+$(this).attr("data-marca")+'">'        +
                                '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                   
                                    '<div class="panel-footer back-footer-green">'+
                                        $(this).attr("data-nombre")+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                $("#lugar_marcas").append(html);

            }else{
                var marca = $(this).attr("data-marca");
                $(document).find("#"+marca).remove();

                $(this).addClass("glyphicon-unchecked");
                $(this).removeClass("glyphicon-check");  
            }


        });

        $(document).on("click",".check-cliente", function(){

            $(".check-cliente").removeClass("glyphicon-check");
            $(".check-cliente").addClass("glyphicon-unchecked");

             if( $(this).hasClass("glyphicon-unchecked") )
            {
                $(this).removeClass("glyphicon-unchecked");
                $(this).addClass("glyphicon-check");

                $("#cliente_seleccionado").html(

                        '<ul class="list-group" data-cliente="'+$(this).attr("data-clinte")+'" >'+
                            '<li class="list-group-item">Cliente: <strong>'+$(this).attr("data-nombre")+'</strong></li>'+
                            '<li class="list-group-item">Correo 1: <strong>'+$(this).attr("data-correo1")+'</strong></li>'+
                            '<li class="list-group-item">Correo 2: <strong>'+$(this).attr("data-correo2")+'</strong></li>'+
                            '<li class="list-group-item">Telefono: <strong>'+$(this).attr("data-telefono")+'</strong></li>'+
                            '<li class="list-group-item">Celular: <strong>'+$(this).attr("data-celular")+'</strong></li>'+
                        '</ul>'
                    );
                $("#empresa_seleccionada").html(

                        '<ul class="list-group">'+
                            '<li class="list-group-item">Empresa: <strong>'+$(this).attr("data-empresa")+'</strong></li>'+
                            '<li class="list-group-item">Giro: <strong>'+$(this).attr("data-giro")+'</strong></li>'+
                            '<li class="list-group-item">Direccion: <strong>'+$(this).attr("data-direccion")+'</strong></li>'+
                            '<li class="list-group-item">Ciudad: <strong>'+$(this).attr("data-ciudad")+'</strong></li>'+
                        '</ul>'

                    );
            }
        });

        $(document).on("click",".check-administrador",function(){

            if( $(this).hasClass("glyphicon-unchecked") )
            {
                $(this).removeClass("glyphicon-unchecked");
                $(this).addClass("glyphicon-check");

                var html = '<div class="col-sm-3 waves-effect" id="admin'+$(this).attr("data-usuario")+'" data-administrador="'+$(this).attr("data-usuario")+'">'        +
                                '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                   
                                    '<div class="panel-footer back-footer-green">'+
                                        $(this).attr("data-nombre")+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                $("#lugar_administradores").append(html);

            }else{
                $(this).addClass("glyphicon-unchecked");
                $(this).removeClass("glyphicon-check"); 

                var usuario = $(this).attr("data-usuario");
                $(document).find("#admin"+usuario).remove();
            }
        });

        $("#modalProyecto").on( "hidden.bs.modal" , function(){
            $("#palce_of_cotizacion").html('');
        });

        $(document).on("click",".verProyecto", function(){
            //Aqui es dodne empieza todo
            var id = $(this).attr("data-proyecto");
            $("#agendar_el_recordatorio").attr("data-proyecto",id);
            //#####Editar
            $("#data-proyecto").val(id);
            //########
            archivos( $("#data-proyecto").val() , 0);

            $("#palce_of_cotizacion").html(
                    '<input id="cotizacion" name="archivos[]" type="file" multiple class="file-loading">'
                );

            $("#cotizacion").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase1/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData: {
                        tipo: 1 ,
                        proyecto : $("#data-proyecto").val() ,
                    }
                });

            $("#cotizacion").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos($("#data-proyecto").val() , 1);
                });

            $("#ordencompra").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase1/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData : {
                        tipo : 2 ,
                        proyecto :$("#data-proyecto").val() ,
                    }
                });

            $("#ordencompra").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    
                    archivos($("#data-proyecto").val() , 2);
                });

            $("#ordenproveedor").fileinput({
                    showCaption : true ,
                    uploadUrl   : 'Fase1/Ver_Proyecto/Archivos',
                    uploadAsync : true  ,
                    showPreview : false ,
                    uploadExtraData : {
                        tipo : 3 ,
                        proyecto : $("#data-proyecto").val() ,
                    }
                });

            $("#ordenproveedor").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    archivos( $("#data-proyecto").val() , 3);
                });

            $("#formatopedido").fileinput({
                    showCaption : true  ,
                    uploadUrl   : 'Fase1/Ver_Proyecto/Archivos' ,
                    uploadAsync: true   ,
                    showPreview: false  ,
                    uploadExtraData: {
                        tipo: 4         ,
                        proyecto : $("#data-proyecto").val() ,
                    }
                });

            $("#formatopedido").on('fileuploaded',function(){
                    /*Archivos Subidos*/
                    archivos( $("#data-proyecto").val() , 4);
                });
            

            $.get("Fase1/Ver_Proyecto/"+id)
            .done(function(data){
                console.log("Administradores del Proyecto:");
                console.log(data); 
                var proyecto = data["proyecto"][0];
                var marcas   = data["marcas"];
                var administradores = data["administradores"];
                var seguimientos    = data["seguimientos"];

                $("#CE_nuevo").attr("data-proyecto" , proyecto.id );

                $("#look_proyecto").html(proyecto.nombre);
                $("#look_descripcion").html(proyecto.descripcion);
                $("#look_valor").html(proyecto.valor);
                $("#look_tipo").html(proyecto.tipo);
                $("#look_moneda").html(proyecto.moneda);
                $("#look_area").html(proyecto.area);
                $("#look_cliente").html(proyecto.cliente);
                $("#look_correo1").html(proyecto.correo1);
                $("#look_correo2").html(proyecto.correo2);
                $("#look_telefono").html(proyecto.telefono);
                $("#look_celular").html(proyecto.celular);

                $("#look_empresa").html(proyecto.empresa);
                $("#look_giro").html(proyecto.giro);
                $("#look_direccion").html(proyecto.direccion);
                $("#look_ciudad").html(proyecto.ciudad);
                $("#look_estado").html(proyecto.estado);

                $("#look_status").html(proyecto.status);
                $("#look_fuente").html(proyecto.fuente);

                var html_marcas = "";
                var html_admin  = "";

                $("#guardar_seguimiento").attr("data-proyecto",proyecto.id);
                $("#guardar_comentario").attr("data-proyecto", proyecto.id);
                $("#siguiente_fase").attr("data-proyecto", proyecto.id);
               /*Aqui ya se tienen los seguimientos*/
               write_seguimientos(seguimientos);
                for( var x = 0 ; x < Object.keys(marcas).length ; x++ )
                {
                    html_marcas+='<div class="col-sm-6 waves-effect">'+
                                    '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                    '   <div class="panel-footer back-footer-green">'+marcas[x].nombre+'</div>'+
                                    '</div>'+
                                '</div>';
                }

                for( var x = 0 ; x < Object.keys(administradores).length; x++ )
                {
                    html_admin += '<div class="col-sm-6 waves-effect">'+
                                    '<div class="panel panel-primary text-center no-boder bg-color-green">'+
                                    '   <div class="panel-footer back-footer-green">'+administradores[x].asignado+'</div>'+
                                    '</div>'+
                                '</div>';
                }

                $("#proyecto_marcas").html(html_marcas);
                $("#proyecto_administradores").html(html_admin);

            })
            .error(function(error){
                alert("Error al Cargar Proyecto");
            });
        });

        $("#guardar_seguimiento").click(function(){
            var texto = $("#seguimiento_texto").val();
            var fecha = $("#seguimiento_fecha").val();
            var via   = $("#seguimiento_via").val();
            var id    = $(this).attr("data-proyecto");
         
            $.post("Fase1/Ver_Proyecto/GuardarSeguimiento",{
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
                consultar_seguimientos(id);

            })
            .error(function(error){
                alert("Error al guardar Seguimiento");
            });

        });

        $("#guardar_comentario").click(function(){

            var comentario = tinyMCE.get('comentario').getContent();
            var proyecto   = $(this).attr("data-proyecto");

            $.post("Fase1/Ver_Proyecto/GuardarComentario",{
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

            $.post("Fase1/Ver_Proyecto/siguienteFase",{
                proyecto : proyecto
            })
            .done(function(){
                window.location.href = "Fase1";
            })
            .error(function(error){

            });
        });

        /*################################################################################*/
        /* Seccion Cerrando Modales*/

        $("#modalAdministradores").on("hidden.bs.modal",function(){
      
            $("body").addClass("modal-open");
            $("body").css("padding-right","17px");
        });

        $("#modalMarcas").on("hidden.bs.modal",function(){

            $("body").addClass("modal-open");
            $("body").css("padding-right","17px");
        });

        $("#modalClientes").on("hidden.bs.modal",function(){

            $("body").addClass("modal-open");
            $("body").css("padding-right","17px");
        });
        
        /*#######################################################*/
        function cargar_campos_generales()
        {
            $.get("Fase1/getCamposGenerales")
            .done(function(data){
                console.log("Campos Generales:");
                console.log(data);

                var html = "";
          
                for( var x = 0 ; x < Object.keys(data["tipos"]).length ; x++ )
                {
                    html += "<option value='"+data["tipos"][x].id+"'>"+data["tipos"][x].nombre+"</option>";
                }
                $("#cmb_Tipo").html(html);

                html = "";
                for( var x = 0 ; x < Object.keys(data["valores"]).length ; x++ )
                {   
                    html += "<option value='"+data["valores"][x].id+"'>"+data["valores"][x].nombre+"</option>";
                }
                $("#cmb_Valor").html(html);

                html = "";
                for( var x = 0 ; x < Object.keys(data["areas"]).length ; x++ )
                {
                    html += "<option value='"+data["areas"][x].id+"'>"+data["areas"][x].nombre+"</option>";
                }
                $("#cmb_Area").html(html);

                html = "";
                for( var x = 0 ; x < Object.keys(data["estatus"]).length ; x++ )
                {
                    html += "<option value='"+data["estatus"][x].id+"'>"+data["estatus"][x].nombre+"</option>";
                }
                $("#cmb_Estatus").html(html);

                html = "";
                for( var x = 0 ; x < Object.keys(data["fuentes"]).length ; x++ )
                {
                    html += "<option value='"+data["fuentes"][x].id+"'>"+data["fuentes"][x].nombre+"</option>";
                }
                $("#cmb_Fuentes").html(html);
            })
            .error(function(error){
                alert("Error al Consultar a Campos Generalos");
            });
        }
        function cargar_marcas()
        {
            $.get("Marcas/getMarcas")
            .done(function(data){
                var tabla = $("#dataTables-Marcas").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tabla.row.add([

                        data[x].nombre ,
                        '<span data-marca="'+data[x].id+'" data-nombre="'+data[x].nombre+'"  class="glyphicon glyphicon-unchecked check-marca fa-2x"></span>'

                        ]).draw();
                }
            })
            .error(function(error){

            });
        }

        function cargar_clientes()
        {
            $.get("Clientes/getClientes")
            .done(function(data){
                console.log("Clientes:");
                console.log(data);
                var tabla = $("#dataTables-Clientes").DataTable();
                tabla.clear();
                
                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {   
                 
                    var campos =' data-clinte="'+data[x].id+'" data-nombre="'+data[x].nombre+'" '+
                                ' data-empresa="'+data[x].empresa+'" data-correo1="'+data[x].correo1+'"'+ 
                                ' data-correo2="'+data[x].correo2+'" data-telefono="'+data[x].telefono+'"'+
                                ' data-celular="'+data[x].celular+'" '+
                                ' data-giro="'+data[x].giro+'" data-direccion="'+data[x].direccion+'" '+
                                ' data-ciudad="'+data[x].ciudad+'"';

                    tabla.row.add([
                        x+1 ,
                        data[x].nombre  ,
                        data[x].empresa ,
                        data[x].ciudad  ,
                        data[x].estado  ,
                         '<span'+campos+' class="glyphicon glyphicon-unchecked check-cliente fa-2x"></span>'
                        ]).draw();
                }

            })
            .error(function(error){
                alert("Error al Cargar los Clientes");
            });
        }

        function cargar_Administradores()
        {
            $.get("Fase1/getAdministradores")
            .done(function(data){

                var tabla = $("#dataTables-Administradores").DataTable();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tabla.row.add([
                            data[x].nombre ,
                            '<span data-usuario="'+data[x].id+'" data-nombre="'+data[x].nombre+'" class="glyphicon glyphicon-unchecked check-administrador fa-2x"></span>'
                        ]).draw();
                }
            })
            .error(function(error){
                alert("Error al cargar los Administradores");
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
        
            $.get("Fase1/Ver_Proyecto/getarchivos/"+proyecto+"/"+tipo)
            .done(function(data){
                console.log("Archivos");
                console.log(data);
                console.log("/////////////////////")
                //Si es cero quiere decir que en el data hay de todos los tipos
                var html = "";
                if( tipo == 0 )
                {
                    console.log("Tipo 0");
                    var uno    = false;
                    var dos    = false;
                    var tres   = false;
                    var cuatro = false;
                    var resultado = data["resultado"];

                    $("#descargar_cotizacion").html('');
                    $("#descargar_ordencompra").html('');
                    $("#descargar_ordenproveedor").html('');
                    $("#descargar_formatopedido").html('');
                 
                    for( var x = 0 ; x < Object.keys(resultado).length ; x++ )
                    {
                        console.log("For");
                        var type= parseInt(resultado[x].id_tipo);
                        html = "";
                       
                        console.log(type);
                        //type=1;

                            switch(type)
                            {
                                case 1:
                                
                                    if( uno == false ){
                                        
                                        
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultima Cotizacion'+resultado[x].created_at+'</a>';
                                        $("#descargar_cotizacion").html(html);
                                       uno = true;
                                    } 

                                break;
                                case 2:
                                
                                        if( dos == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultima Orden de Compra'+resultado[x].created_at+'</a>';
                                        $("#descargar_ordencompra").html(html);
                                       dos = true;

                                        } 
                                break;
                                case 3:
  
                                       if( tres == false ){
                                        tres = true;
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultima Orden de Copra Proveedor'+resultado[x].created_at+'</a>';
                                            $("#descargar_ordenproveedor").html(html);
                                            
                                        }  

                                    break;
                                case 4:
                                        if( cuatro == false ){
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultimo Formato Pedido'+resultado[x].created_at+'</a>';
                                        $("#descargar_formatopedido").html(html);
                                       cuatro = true;
                                        } 
                                    break;
                            }
                    }

                }else{

                    var resultado = data["resultado"];
                    var x = 0;
                    switch(tipo)
                            {
                                case 1:
                                        $("#descargar_cotizacion").html('');
                                    
                                    
                                    
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultima Cotizacion'+resultado[x].created_at+'</a>';
                                        $("#descargar_cotizacion").html(html);
                                    
                                    
                                break;
                                case 2:
                                
                                        $("#descargar_ordencompra").html('');
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultima Orden de Compra'+resultado[x].created_at+'</a>';
                                        $("#descargar_ordencompra").html(html);
                                        
                                break;
                                case 3:
                                        $("#descargar_ordenproveedor").html('');
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultima Orden de Copra Proveedor'+resultado[x].created_at+'</a>';
                                            $("#descargar_ordenproveedor").html(html);
                                            
                                        

                                    break;
                                case 4:
                                        $("#descargar_formatopedido").html('');
                                        var url = data["url"]+"/"+resultado[x].ruta;
                                        html +=
                                        '<span class="glyphicon glyphicon-file"></span>'+

                                        '<a href="'+url+'" download>Ultimo Formato Pedido'+resultado[x].created_at+'</a>';
                                        $("#descargar_formatopedido").html(html);
                                     
                                    break;
                            }
                }
            })
            .error(function(){
                alert("Error Al Consultar las Cotizaciones");
            });
        }

        function currency(value, decimals, separators) {
            decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
            separators = separators || ['.', "'", ','];
            var number = (parseFloat(value) || 0).toFixed(decimals);
            if (number.length <= (4 + decimals))
                return number.replace('.', separators[separators.length - 1]);
            var parts = number.split(/[-.]/);
            value = parts[parts.length > 1 ? parts.length - 2 : 0];
            var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
            separators[separators.length - 1] + parts[parts.length - 1] : '');
            var start = value.length - 6;
            var idx = 0;
            while (start > -3) {
                result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
                + separators[idx] + result;
            idx = (++idx) % 2;
            start -= 3;
            }
        return (parts.length == 3 ? '-' : '') + result;
    }
    </script>

</body>

</html>