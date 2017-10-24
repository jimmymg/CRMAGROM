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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.css" >
    
    
</head>

<body >
@include("layouts.cargando")
    
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner" style="margin-bottom: 0px;padding-bottom: 0px;">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Nueva <small>Solicitud</small>
                        </h1>
                    </div>
                </div>

                <div style="margin-bottom:20px" class="row">
               
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Solicitud
                                <span class="glyphicon glyphicon-eye-open hide_card_body" style="font-size: 14pt"></span>
                                <input type="hidden" value="0" id="solicitud_id">
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                    <!--
                                        <div class="col-lg-12">
                                            <div class="material-switch pull-left">
                                                <input id="contado_c" name="someSwitchOption001" type="checkbox"/>
                                                <label for="contado_c" class="label-primary"></label>
                                            </div>

                                            <label style="margin-left: 10px">Venta Rapida *Esto tipo de vena son cuando no se hizo una cotizacion, el producto tiene que estar en stock sino se tiene que levantar como pro</label>

                                        </div>
                                    -->

                                        <div class="col-lg-12">
                                            <label>Proyectos</label>
                                            <div class="col-lg-12">
                                                <select id="seleccionarProyecto" class="form-control select2-single" >
                                                    <optgroup label="Proyectos">
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="alert " id="alerta">
                                           
                                        </div>

                                        <label>Orden de Compra</label>
                                        <input type="text" class="form-control" id="numero_orden">

                                        <button id="buscar_orden" style="margin-top:10px" type="button" class="btn btn-primary col-lg-12 waves-effect">Buscar y Guardar Orden de Compra</button>
                                    </div>

                                    <div class="col-lg-12" id="card_comun">
                                        <label>Fecha de Solicitud</label>
                                        <input type="date" class="form-control" id="fecha_solicitud">

                                        <label>Vendedor</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->nombre}}">
                                    </div>

                                    <div class="col-lg-6" id="card_facturacion">

                                        <legend>DATOS DE FACTURACION</legend>
                                        <label>Razón Social</label>
                                        <input id="razon" type="text" class="form-control">
                                        <label>Dirección</label>
                                        <input id="direccion" type="text" class="form-control">
                                        <label>RFC</label>
                                        <input id="rfc" type="text" class="form-control">
                                        <label>Telefono</label>
                                        <input id="telefono" type="text" class="form-control">

                                    </div>  

                                    <div class="col-lg-6" id="card_cobranza">

                                        <legend>DATOS PARA COBRANZA</legend>

                                        <label>Moneda</label>
                                        <select id="moneda" class="form-control">
                                            <option value="1">MN</option>
                                            <option value="2">USD</option>
                                        </select>
                                        <label>Solicitó</label>
                                        <input id="solicito" type="text" class="form-control">
                                        <label>Metodo de Pago</label>
                                        <input id="metodo_pago" type="text" class="form-control">
                                        <label>Vencimiento</label>
                                        <input id="vencimiento" type="number" class="form-control" placeholder="Cantidad de Dias">

                                    </div>

                                    <div class="col-lg-12" id="card_add_pagos">
                                        <legend>Monto de la Factura</legend>
                                        <input id="subtotal_input" type="hidden">
                                        <div class="col-lg-12">
                                            <label>*Total de los Productos:$<strong class="total" style="color:green;"></strong></label><br>
                                            <label>Recuerda Antes Agregar los Productos con el costo SIN IVA</label>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Anticipo % (Si es un solo pago 100%)</label>

                                            <input id="porc" type="number" class="form-control" placeholder="Porcentaje" min="30" max="100">

                                            <button id="calcular" type="button" class="btn btn-warning waves-effect">
                                            Calcular</button>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Subtotal: $ <strong class="subtotal_anticipo"></strong></label><br>
                                            <label>IVA: $ <strong class="iva_anticipo"></strong></label><br>
                                            <label>Total: $ <strong class="total_anticipo"></strong></label>
                                        </div>
                                    </div>

                                     <div class="col-lg-12">
                                        <button id="guardar" style="margin-top:10px;" type="button" class="btn btn-success" disabled >Solicitar Factura</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>   

                    <h1 style="text-align: center;margin-bottom: 10px;" id="nc" >Numero de Compra:<strong></strong></h1>
                    
                    <div class="col-sm-12" id="card_solicitudes">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Solicitudes Realizados
                            
                                <span class="glyphicon glyphicon-eye-open hide_card_body" style="font-size: 14pt"></span>
                                
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <table class="table" id="table-solicitudes">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Razon Social</th>
                                                <th>RFC</th>
                                                <th>Telefono</th>
                                                <th>Moneda</th>
                                                <th>Solicito</th>
                                                <th>Metodo de Pago</th>
                                                <th>Vencimiento</th>
                                                <th>Total</th>
                                                <th>Factura</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12" >

                    <div class="col-sm-12 col-md-6 col-lg-6" id="card_productos">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Productos
                                <span class="glyphicon glyphicon-eye-open hide_card_body" style="font-size: 14pt"></span>

                                <button  type="button" class="btn btn-primary" id="add_producto">Añadir</button>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <table class="table" id="table-productos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>¿Series?</th>
                                                <th>Cantidad</th>
                                                <th>Total</th>
                                                <th>Ver Series</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6" id="card_pagos">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Pagos
                                <span class="glyphicon glyphicon-eye-open hide_card_body" style="font-size: 14pt"></span>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>%</th>
                                                <th>Total</th>
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

                    <div class="col-sm-12 col-md-12 col-lg-12">

                    <div class="col-sm-12 col-md-6 col-lg-6" id="card_facturas">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Facturas
                                <span class="glyphicon glyphicon-eye-open hide_card_body" style="font-size: 14pt"></span>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Factura</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6" id="card_total">
                    <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Total
                                <span class="glyphicon glyphicon-eye-open hide_card_body" style="font-size: 14pt"></span>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <label>SubTotal: $<strong class="subtotal"></strong></label><br>
                                    <label>IVA: $<strong class="iva"></strong></label><br>
                                    <label>Total: $<strong class="total"></strong></label>
                                </div>

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
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <!-- plugin datetimepicker JS -->
    <script src="{{url('plugins/bootstrap-datetimepicker-malot/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{url('plugins/bootstrap-datetimepicker-malot/js/locales/bootstrap-datetimepicker.es.js')}}"></script>
    <!-- END plugin datetimepicker JS -->
    <script src="{{url('js/fileinput.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="{{url('js/tinymce/tinymce.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/i18n/es.js"></script>
    <script>tinymce.init({ selector:'#comentario' });</script>

     <!-- MODALS -->
    @include('ventas.addProductoModal')
 
    <!-- End JS  -->
    <script>
    //Vista de Pagos Vista de Facturas y Modal de Ver Series
        Waves.init();
        $('#main-menu').metisMenu();

        $(window).bind("load resize", function () {
            if ($(this).width() < 768) {
                $('div.sidebar-collapse').addClass('collapse')
            } else {
                    $('div.sidebar-collapse').removeClass('collapse')
            }
        });
        
        ed_campos(2);

        $("document").ready(function(){
            cargar_proyectos();
            $("#alerta").hide();
        });


        $("#buscar_orden").click(function(){
            var orden    = $("#numero_orden").val();
            var proyecto = $("#seleccionarProyecto").val();
       
            if( $("#seleccionarProyecto").val() == null)
            {
                swal("Error","Seleccione un Proyecto","error")
                return ;
            }


            $.get("nueva/getOrden/"+orden+"/proyecto/"+proyecto)
            .done(function(data){
                console.log(data);
                
                if( data['respuesta'] == 'error' ){ 
                    swal( "Error" , "Ese Numero de Compra ya existe con otro Proyecto" , "error" )
                    return; }

                if(data['respuesta'] == "nuevo")
                {
                    //Funcion para Aparecer los Campos 
                    //Funcion para Llenar los Campos
                    
                    $("#guardar").show();
                    $("#solicitud_id").val(data['orden_id']);
                    ed_campos(1);
                    swal("Primera Solicitud del Numero de Compra: "+orden+" Se guardo Correctamente ");

                    $("#cantidad_productos").val('0');
                    $("#product_total").val('0');
                }else{
                    //Funcion para Apareer los Cmapos  
                    $("#guardar").show();
                    ed_campos(1);
                    $("#solicitud_id").val(data['orden_id']);
                    calcular_total(data['orden_id']);
                }

                cargar_solicitudes($("#solicitud_id").val());
                llenar_tablas_productos($("#solicitud_id").val());
            })
            .error(function(){
                ed_campos(2);
                alert("Error al Buscar la Orden");
            });
        });//END buscar_orden

        $("#guardar").click(function(event){

            event.preventDefault();
            $(this).hide();

            var orden_compra = $("#numero_orden").val();
            var solicitud    = $("#fecha_solicitud").val();
            var razon        = $("#razon").val();
            var direccion    = $("#direccion").val();
            var rfc          = $("#rfc").val();
            var telefono     = $("#telefono").val();

            var moneda       = $("#moneda").val();
            var solicito     = $("#solicito").val();
            var metodo_pago  = $("#metodo_pago").val();
            var vencimiento  = $("#vencimiento").val();
            var porcentaje   = $("#porc").val();
            //alert( moneda + " " + solicito +" "+metodo_pago+" "+vencimiento );
           
            if( porcentaje == "" )
            {
                swal("Error","Anticipo esta vacio","error")
                $("#guardar").show();

                return ;
            }

            if( porcentaje < 1 && porcentaje > 100 )
            {
                swal("Error", "El Procentaje tiene que ser mayor a 0 y menor o igual a 100")
                $("#guardar").show();
                return ;
            }

            if( orden_compra == "" )
                { swal("Error","Orden de Compra Vacio","error"); 
                    $("#guardar").show();
                     return; 
                }
            if( razon == "" )
                { swal("Error","Razon Social Vacio","error"); 
                    $("#guardar").show();
                     return; 
                }
            if( solicitud == "" )
                { swal("Error","Fecha de Solicitud Vacia","error"); 
                    $("#guardar").show();
                     return; 
                }
            if( direccion == "" )
                { swal("Error","Direccion Vacio","error"); 
                    $("#guardar").show();
                     return; 
                }
            if( rfc == "")
                { swal("Error","RFC vacio","error"); 
                    $("#guardar").show();
                     return; 
                }

            
            var subtotal = $("#subtotal_input").val() * ( porcentaje / 100 );

            $.post('nueva/solicitarFactura',{
                orden_compra : orden_compra ,
                solicitud    : solicitud ,
                razon        : razon ,
                direccion    : direccion ,
                rfc          : rfc ,
                telefono     : telefono ,

                moneda       : moneda ,
                solicito     : solicito ,
                metodo_pago  : metodo_pago ,
                vencimiento  : vencimiento ,
                porcentaje   : porcentaje ,
                subtotal     : subtotal ,
                iva          : subtotal * .16 ,
                total        : subtotal * 1.16
            })
            .done(function(data){

                if( data == "Solicitud En Espera" )
                {
                    swal("Error","Hay una Solicitud en Espera, No puedes tener mas de una solicitud en espera por proyecto","error")
                    $("#guardar").show();
                    return;
                }

                swal("Solicitud Enviada","Se guardo la solicitud","success")

                cargar_solicitudes($("#solicitud_id").val());

                $("#numero_orden").val('');
                $("#fecha_solicitud").val('');
                $("#razon").val('');
                $("#direccion").val('');
                $("#rfc").val('');
                $("#telefono").val('');

                $("#moneda").val('');
                $("#solicito").val('');
                $("#metodo_pago").val('');
                $("#vencimiento").val('');
                $("#porc").val('');

                $(".subtotal_anticipo").html("");
                $(".iva_anticipo").html("");
                $(".total_anticipo").html("");

                $("#guardar").show();
            })
            .error(function(){
                alert("Error al Solicitar la Factura");
                $("#guardar").show();
            });
            

        });

        $("body").on("click",".hide_card_body" , function(){

            if( $(this).hasClass('glyphicon-eye-open') )
            {
                $(this).parent().parent().find(".panel-body").hide();
                $(this).removeClass('glyphicon-eye-open');
                $(this).addClass('glyphicon-eye-close');
            }else{
                $(this).parent().parent().find(".panel-body").show();
                $(this).removeClass('glyphicon-eye-close');
                $(this).addClass('glyphicon-eye-open');
            }
        });

        $("#seleccionarProyecto").change(function(){
            ed_campos(2);
            $("#numero_orden").val('');
            var id = $(this).val();

            var orden = '';
            $("#seleccionarProyecto").find('option').each(function(n){
                if( $(this).val() == id )
                {
                    orden = $(this).attr('data-orden');
                }
            });
          
            if( orden == 'null' ){
                $("#numero_orden").removeAttr("disabled");
                
                $("#alerta").removeClass("alert-warning");
                $("#alerta").addClass("alert-info");
                $("#alerta").show();
                $("#alerta").html("<strong>Mensaje</strong> Este Proyecto no tiene numero de compra");
            }else{
               
                $("#numero_orden").val(orden);
                $("#numero_orden").attr("disabled","disabled");

                $("#alerta").removeClass("alert-info");
                $("#alerta").addClass("alert-warning");
                $("#alerta").show();
                $("#alerta").html("<strong>Mensaje</strong> Este Proyecto YA tiene un numero de compra");
                ed_campos(2);
            }

        });
        //Calcular
        $("#calcular").click(function(){
            $("#guardar").attr("disabled","disabled");

            if( $("#porc").val() > 100 )
            {
                swal("Error","El Anticipo no debe de ser mayor a 100","warning")
                $("#guardar").attr("disabled","disabled");
                return;
            }

            if( $("#porc").val() == "" )
            {
                swal("Error","El Anticipo no debe de estar vacio","warning")
                $("#guardar").attr("disabled","disabled");
                return;
            }

            if( $("#porc").val() < 1  )
            {
                swal("Error","El Anticipo no debe de ser menor o igual a 0","warning")
                $("#guardar").attr("disabled","disabled");
                return;
            }

             $.get("nueva/calcular/orden/"+$("#solicitud_id").val() )
             .done(function(data){

                var total = data;
                var anticipo = $("#porc").val();
                $("#subtotal_input").val(total);
                //alert(total);
                //alert(anticipo);

                var anticipo = parseFloat(total) * ( parseFloat(anticipo) / 100 );
                //alert(anticipo);
                //alert( "SubTotal: "+anticipo+" IVA: "+(anticipo * .16) +" Total: "+(anticipo * 1.16 ) );



                $(".subtotal_anticipo").html( anticipo.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
                $(".iva_anticipo").html( (anticipo * .16).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
                $(".total_anticipo").html( (anticipo * 1.16).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );



                $(".total_anticipo").css("color","green");
                $(".total_anticipo").css("font-size","14pt");

                swal("Calculado","Se calculo el pago, ya puede solicitar la factura, ¡No se podra solicitar otra factura a este proyecto hasta que se page la factura anterior o no exista ninguna factura anteriormente! ¡Una vez que el total de facturas sea igual a el total del proyecto se conciderara PAGADO y no se podra solicitar facturas!","success")
                $("#guardar").removeAttr("disabled");

             })
             .error(function(){
                alert("Error al Calcular");
                $("#guardar").attr("disabled","disabled");
             });

         
            
        });

        $("#add_producto").click(function(){
            llenar_seleccionar_producto();
            $("#addProductoModal").modal({backdrop: 'static', keyboard: false});
        });

        function ed_campos(opcion)
        {
            if( opcion == 1 )
            {   
                $("#card_add_pagos").show();
                $("#guardar").show();
                $("#card_comun").show();
                $("#card_facturacion").show();
                $("#card_cobranza").show();
                
                $("#card_productos").show();
                $("#card_pagos").show();
                $("#card_facturas").show();
                $("#card_total").show();
            }else{
                $("#card_add_pagos").hide();
                $("#guardar").hide();
                $("#card_comun").hide();
                $("#card_facturacion").hide();
                $("#card_cobranza").hide();
                $
                $("#card_productos").hide();
                $("#card_pagos").hide();
                $("#card_facturas").hide();
                $("#card_total").hide();

            }

            responsivo();
        }

        function cargar_proyectos()
        {
            $.get('cargar')
            .done(function(data){

                var html = "<option value='0' disabled selected>Seleccione un Proyecto</option>";
                var orden = "N/A";
                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {   
                    if(data[x].orden_compra  == null){ orden = 'N/A'; }else{ orden = data[x].orden_compra; }

                    html += "<option value='"+data[x].id+"' data-orden='"+data[x].orden_compra+"' >"+data[x].nombre+" | <strong>Orden de Compra: </strong> "+orden+"</option>";
                }

                $("#seleccionarProyecto optgroup").html(html);
                $( "#seleccionarProyecto" ).select2();
            })
            .error(function(){
                alert("Error al Cargar los Proyectos");
            });
        }

        function calcular_total(orden)
        {
            $.get("nueva/calcular/orden/"+orden)
            .done(function(data){
                console.log(data);
                var subtotal = (data == null)?0:data;
                var iva      = subtotal * .16;
                var total    = subtotal * 1.16;

                var subtotal = subtotal.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
             
                var iva      = iva.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      
                var total    = total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                $(".subtotal").html(subtotal);
                $(".iva").html(iva);
                $(".total").html(total);
            })
            .error(function(){
                alert("Error al Calcular el Total");
            });
        }

        function cargar_solicitudes(id_venta)
        {
            $.get("solicitudes/"+id_venta)
            .done(function(data){
                console.log("Solicitudes:");
                console.log(data);
                var table = $("#table-solicitudes tbody");
                var tbody = "";
                var moneda = "";
                var facturado  = "";
                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {   
                    moneda = (data[x].moneda == 2)?"USD":"MN";
                    facturado = ( data[x].facturado == 1 )?"Facturado":"Pendiente";
                    facturado = ( data[x].cancelado == 1 )?"Cancelado":facturado;
                    tbody +=    "<tr>"+
                                    "<td>"+(x+1)+"</td>"+
                                    "<td>"+data[x].fecha_solicitud+"</td>"+
                                    "<td>"+data[x].razon+"</td>"+
                                    "<td>"+data[x].rfc+"</td>"+
                                    "<td>"+data[x].telefono+"</td>"+
                                    "<td>"+moneda+"</td>"+
                                    "<td>"+data[x].solicito+"</td>"+
                                    "<td>"+data[x].metodo_pago+"</td>"+
                                    "<td>"+data[x].vencimiento+ "Dias</td>"+
                                    "<td>"+data[x].total+"</td>"+
                                    "<td>"+facturado+"</td>"+
                                "</tr>";
                }

                table.html(tbody);

            })
            .error(function(){
                alert("Error al Cargar las Solicitudes");
            });
        }
    </script>
</body>
</html>