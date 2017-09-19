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
                    </div>

                    <div class="col-lg-12" style="margin-bottom: 10px;margin-top: 10px">
                        <button id="buscar" type="button" class=" btn btn-primary">Buscar</button>
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

        $("#buscar").click(function(){
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

            $.get(url)
            .done(function(data){
                console.log(data);
                //dataTable-facturas-adminpaq
                var table = $("#dataTable-facturas-adminpaq tbody");
             
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
                            "<td>"+data[x]['facturas'].length+"</td>"+
                            "<td>"+saldo_pendiente_mxn+"</td>"+
                            "<td>"+saldo_pendiente_usd+"</td>"+
                            "<td>"+cantidad_facturas_pendientes+"</td>"+
                        "</tr>"; 

                    var saldo_pendiente_mxn = 0;
                    var saldo_pendiente_usd = 0;
                    var cantidad_facturas_pendientes = 0;
                }

                table.html(tbody);

            })
            .error(function(data){
                alert("Error al Consultar las Facuras de Agro");
            });
        });
    </script>
</body>
</html>