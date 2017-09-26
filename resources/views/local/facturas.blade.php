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
<style type="text/css">
   #preloader_3{
    position:relative;
}
#preloader_3:before{
    width:20px;
    height:20px;
    border-radius:20px;
    background:blue;
    content:'';
    position:absolute;
    background:#9b59b6;
    animation: preloader_3_before 1.5s infinite ease-in-out;
}
 
#preloader_3:after{
    width:20px;
    height:20px;
    border-radius:20px;
    background:blue;
    content:'';
    position:absolute;
    background:#2ecc71;
    left:22px;
    animation: preloader_3_after 1.5s infinite ease-in-out;
}
 
@keyframes preloader_3_before {
    0% {transform: translateX(0px) rotate(0deg)}
    50% {transform: translateX(50px) scale(1.2) rotate(260deg); background:#2ecc71;border-radius:0px;}
      100% {transform: translateX(0px) rotate(0deg)}
}
@keyframes preloader_3_after {
    0% {transform: translateX(0px)}
    50% {transform: translateX(-50px) scale(1.2) rotate(-260deg);background:#9b59b6;border-radius:0px;}
    100% {transform: translateX(0px)}
}
</style>
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
                            Facturas de Adminpaq <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-1">
                            <input type="checkbox" id="opcion" data-toggle="toggle" data-on="Cliente" data-off="Codigo">
                        </div>

                        <div  class="col-md-4" style="margin-left:10px;">
                            <input id="texto" class="form-control" type="text" >
                        </div>

                        <div class="col-sm-1">
                            <input id="anio" type="text" class="form-control" placeholder="Año">
                        </div>

                        <div class="col-sm-2">
                            <select id="mes" class="form-control">
                                <option value="1" >Enero</option>
                                <option value="2" >Febrero</option>
                                <option value="3" >Marzo</option>
                                <option value="4" >Abril</option>
                                <option value="5" >Mayo</option>
                                <option value="6" >Junio</option>
                                <option value="7" >Julio</option>
                                <option value="8" >Agosto</option>
                                <option value="9" >Septiembre</option>
                                <option value="10" >Octubre</option>
                                <option value="11" >Noviembre</option>
                                <option value="12" >Diciembre</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-lg-12" style="margin-bottom: 10px;margin-top: 10px">
                        <div class="col-lg-1">
                            <button id="buscar" type="button" class=" btn btn-primary">Buscar</button>
                        </div>
                        <div class="col-lg-8" >
                            <div id="preloader_3" style="margin-top: 7px;"></div>
                        </div>
                    </div>


                    

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-hover" id="dataTable-facturas-adminpaq">
                                        <thead>
                                            <tr>
                                                <th width="1%">#</th>
                                                <th >Codigo</th>
                                                <th >Razon Social</th>
                                                <th >RFC</th>
                                                <th >Cantidad de Facturas</th>
                                                <th>Saldo Pendiente Total MXN</th>
                                                <th>Saldo Pendiente Total USD</th>
                                                <th>Cantida de Facturas Pendientes</th>
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

				<footer ></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

    <!-- Modals -->
    @include("local.ModalFacturas")
    @include("local.ModalMovimientos")

 
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

        $(document).ready(function(){
            $("#preloader_3").hide();
            var d = new Date();
            
            $("#anio").val(d.getFullYear());

            $("#mes").find("option").each(function(n){
                
                if($(this).val() == (d.getMonth()+1) )
                {
                    $(this).prop('selected', true)
                }
            });
            
        });

        var facturas = [];

        $("#buscar").click(function(event){
            event.preventDefault();
            $("#preloader_3").show();
            var texto = $("#texto").val();
            var opcion = ($("#opcion").is(":checked") )?'cliente':'codigo';
            var url = "http://172.16.200.249/crm.agro/Local/getFacturas/opcion/cliente/valor/"+texto;
            if( texto == "" )
            {
                swal("Error","El texto esta vacio","error")
            }

            if( opcion == "codigo" )
            {
                url = "http://172.16.200.249/crm.agro/Local/getFacturas/opcion/codigo/valor/"+texto;
            }

            $.get(url+"/mes/"+$("#mes").val()+"/anio/"+$("#anio").val())
            .done(function(data){
                $("#preloader_3").hide();
                console.log(data);
                if( data == 0 )
                {   
                    swal("Se hizo la Peticion","No se encontro a ningun cliente","warning");
                    return 0;
                }
                //dataTable-facturas-adminpaq
                var table = $("#dataTable-facturas-adminpaq tbody");
                facturas = data;
                var saldo_pendiente_mxn = 0;
                var saldo_pendiente_usd = 0;
                var cantidad_facturas_pendientes = 0;
                var tbody = "";



                for(var x = 0 ; x < Object.keys(data).length ; x++)
                {   

                    for( var y = 0 ; y < data[x]['facturas'].length ; y++ )
                    {   
                        
                        if( data[x]['facturas'][y].pendiente > 0 )
                        {
                            cantidad_facturas_pendientes += 1;
                        }

                        if( data[x]['facturas'][y].idmoneda == 2 )
                        {
                            saldo_pendiente_usd += data[x]['facturas'][y].pendiente;
                        }else{
                            saldo_pendiente_mxn += data[x]['facturas'][y].pendiente;
                        }
                    }

                    tbody += 
                        "<tr>"+
                            "<td>"+(x+1)+"</td>"+
                            "<td>"+data[x]['codigo']+"</td>"+
                            "<td>"+data[x]['razon_social']+"</td>"+
                            "<td>"+data[x]['rfc'].trim()+"</td>"+
                            "<td><button key='"+x+"' data-target='#modalFacturas' data-toggle='modal' type='button' class='btn btn-primary verFacturas'>"+data[x]['facturas'].length+"</button></td>"+
                            "<td>"+saldo_pendiente_mxn+"</td>"+
                            "<td>"+saldo_pendiente_usd+"</td>"+
                            "<td><button type='button' class='btn btn-primary'>"+cantidad_facturas_pendientes+"</button></td>"+
                        "</tr>"; 

                    var saldo_pendiente_mxn = 0;
                    var saldo_pendiente_usd = 0;
                    var cantidad_facturas_pendientes = 0;
                }

                table.html(tbody);
                var alto_ventana = window.innerHeight;
                var new_height =  $("#page-inner").height() + 35;
                //+35 por el margin y el padding 10 y 10 de page-inner, y + 15 por el padding de page-wrapper
        
                if( alto_ventana > new_height )
                {
                    $("#page-wrapper").css( "height", alto_ventana - 60 );
                }else{
                    responsivo_DataTable();
                }
                //responsivo_DataTable();

            })
            .error(function(data){
                $("#preloader_3").hide();
                alert("Error al Consultar las Facuras de Agro");
                console.log(data);
            });
        });


        $("body").on("click", ".verFacturas" , function(){
            var key = $(this).attr("key");
            $("#key").val(key);
            var data = facturas[key]['facturas'];
            //console.log(data);
            
            var table = $("#dataTables-Facturas tbody");
            var tbody = "";
            var agentes = [];

            for( var x = 0 ; x < data.length ; x++ )
            {
                tbody += 
                "<tr>"+
                    "<td>"+(x+1)+"</td>"+
                    "<td>"+data[x].agente+"</td>"+
                    "<td>"+data[x].fecha+"</td>"+
                    "<td>"+data[x].serie+"</td>"+
                    "<td>"+data[x].folio+"</td>"+
                    "<td>"+data[x].idmoneda+"</td>"+
                    "<td>"+data[x].tipocambio+"</td>"+
                    "<td>"+data[x].metodopago+"</td>"+
                    "<td>"+data[x].total+"</td>"+
                    "<td>"+data[x].neto+"</td>"+
                    "<td>"+data[x].pendiente+"</td>"+
                    "<td><button data-toggle='modal' data-target='#modalMovimientos' key-factura='"+x+"' class='btn btn-primary verMovimientos'>"+data[x]['movimientos'].length+"</button></td>"+
                "</tr>";

                if( agentes.indexOf(data[x].agente) == -1 )
                {
                    agentes.push(data[x].agente);
                }
            }

            var body_select = "<option value='-1'>Todos</option>";

            for( var x = 0 ; x < agentes.length ; x++ )
            {

                body_select += "<option value='"+agentes[x]+"' >"+agentes[x]+"</option>";
            }

            $("#filter_agente").html(body_select);

            table.html(tbody);
        });

        $("#filter_agente").change(function(){

            var key = $("#key").val();
            var data = facturas[key]['facturas'];
            //console.log(data);
            var agente_seleccionado = $(this).val();
  
            var table = $("#dataTables-Facturas tbody");
            var tbody = "";

            for( var x = 0 ; x < data.length ; x++ )
            {   
                if( data[x].agente == agente_seleccionado || agente_seleccionado == -1 )
                    tbody += 
                    "<tr>"+
                        "<td>"+(x+1)+"</td>"+
                        "<td>"+data[x].agente+"</td>"+
                        "<td>"+data[x].fecha+"</td>"+
                        "<td>"+data[x].serie+"</td>"+
                        "<td>"+data[x].folio+"</td>"+
                        "<td>"+data[x].idmoneda+"</td>"+
                        "<td>"+data[x].tipocambio+"</td>"+
                        "<td>"+data[x].metodopago+"</td>"+
                        "<td>"+data[x].total+"</td>"+
                        "<td>"+data[x].neto+"</td>"+
                        "<td>"+data[x].pendiente+"</td>"+
                        "<td><button data-toggle='modal' data-target='#modalMovimientos' key-factura='"+x+"' class='btn btn-primary verMovimientos'>"+data[x]['movimientos'].length+"</button></td>"+
                    "</tr>";
            }

            table.html(tbody);
        });

        $("body").on("click",".verMovimientos" , function(){
            var key = $("#key").val();
            var key_factura = $(this).attr("key-factura");
            var data = facturas[key]['facturas'][key_factura]['movimientos'];
            console.log(data);
            var tbody = " ";
            var table = $("#dataTables-Movimientos tbody");
            for( var x = 0 ; x < data.length ; x++ )
            {
                tbody +=
                    "<tr>"+
                        "<td>"+(x+1)+"</td>"+
                        "<td>"+data[x]['codigo']+"</td>"+
                        "<td>"+data[x]['producto']+"</td>"+
                        "<td>"+data[x]['neto']+"</td>"+
                        "<td>"+data[x]['precio']+"</td>"+
                        "<td>"+data[x]['texto_extra']+"</td>"+
                    "</tr>"
            }

            table.html(tbody);
        });

        $("#modalMovimientos").on("hidden.bs.modal" , function(){
            
            $("body").addClass("modal-open");
        });
    </script>
</body>
</html>