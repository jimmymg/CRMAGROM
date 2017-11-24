<div class="modal fade " id="modalFacturar" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Solicitar Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                strong {
                    font-size: 14pt;
                }

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
            
            .loader {
   
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.bar {
  width: 100%;
  height: 20px;
  border: 1px solid #2980b9;
  border-radius: 3px;
  background-image: 
    repeating-linear-gradient(
      -45deg,
      #2980b9,
      #2980b9 11px,
      #eee 10px,
      #eee 20px /* determines size */
    );
  background-size: 28px 28px;
  animation: move .5s linear infinite;
}

@keyframes move {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 28px 0;
  }
}
            </style>
            <div class="modal-body">
                <div class="row" id="row_loader"> 
                    <div class="col-sm-12" >
                        <h4>
                            <div class="loader" style="margin-left: calc(50% - 60px);margin-top: 10px;"></div>
                        </h4>    
                    </div>
                </div>
                <div class="row" id="row_info">


                    <div class="col-lg-12" id="numero_orden">
                        <h3 style="text-align: center;">Orden: <strong></strong></h3>
                        <input id="id_solicitud" type="hidden">
                    </div>

                    <div class="col-lg-6">
                      
                            <div class="col-lg-12" id="razon_social">
                                <label>Razon Social: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>

                            <div class="col-lg-12" id="direccion">
                                <label>Direccion: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="rfc">
                                <label>R.F.C: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="telefono">
                                <label>Telefono: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="moneda">
                                <label>Moneda: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="solicito">
                                <label>Solicito: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="metodo_de_pago">
                                <label>Metodo de Pago: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="vencimiento">
                                <label>Vencimiento: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="subtotal">
                            <label>Subtotal: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="iva">
                                <label>IVA: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="total">
                                <label>Total: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12" id="porcentaje">
                                <label>Porcentaje: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>

                        <label>Numero del Pedido AdminPAQ</label>
                        <input id="folio_pedido" type="text" class="form-control">

                        <label>Numero de la Remision AdminPAQ</label>
                        <input id="folio_remision" type="text" class="form-control">

                        <label>Factura: <strong id="factura"></strong></label>

                         <button style="margin-top: 15px;" type="button" class="btn btn-success col-lg-12" id="solicitar_factura" >Solicitar Factura</button>
                        
                    </div>

                    

                    <div class="col-lg-6">
                        <p>Vendedor: <strong id="vendedor"></strong></p>
                        <p id="pago">*Es un Anticipo del 50%</p>
                        
                        <h4 style="text-align: center;"><strong>Productos</strong></h4>
                        <table class="table" id="table-productos">
                            <thead>
                                <tr>
                                    <th>Productos</th>
                                    <th>¿Lleva Series?</th>
                                    <th>Series</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
               
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>

   

    function cargar_info_modal(id)
    {
        $("#row_info").hide();
        $("#row_loader").show();
        $("#folio_pedido").val("");
        $("#folio_remision").val("");
        $("#folio_pedido").removeAttr("disabled");
        $("#folio_remision").removeAttr("disabled");

        $.get("solicitarFactura/solicitud/"+id)
        .done(function(data){
            console.log(data);
            var tamano = Object.keys(data).length

            var info = data[tamano-1][0];
            llenar_tabla_productos(data , tamano-1);

            $("#razon_social label strong").html( info.razon );

            $("#direccion label strong").html( info.direccion );
            $("#rfc label strong").html( info.rfc );
            $("#telefono label strong").html( info.telefono );
            $("#moneda label strong").html( (info.id_moneda == 2)?"USD":"MN" );
            $("#solicito label strong").html( info.solicito );
            $("#metodo_de_pago label strong").html( info.metodo_pago );
            $("#vencimiento label strong").html( info.vencimiento + " DIAS");
            $("#subtotal label strong").html( info.subtotal );
            $("#iva label strong").html( info.iva );
            $("#total label strong").html( info.total );
            $("#porcentaje label strong").html( info.porcentaje+"%" );
            $("#numero_orden strong").html( info.orden_compra );
            $("#vendedor").html( info.vendedor );
      
            if( info.pedido != null )
            {
                $("#factura").parent().show();
                $("#solicitar_factura").hide();

                $("#folio_pedido").val(info.pedido);
                $("#folio_remision").val(info.remision);

                $("#folio_pedido").attr("disabled","disabled");
                $("#folio_remision").attr("disabled","disabled");

                if( info.factura !=null )
                {
                    $("#factura").html(info.factura);
                }else{
                    $("#factura").html("Factura Solicitada");
                }
            }else{
                $("#factura").parent().hide();
                $("#solicitar_factura").show();
            }

            var porcentaje = info.porcentaje;

            if( porcentaje == 100 )
            {
                $("#pago").html("*Pago de Contado.");
            }else{
                $("#pago").html("*Anticipo del "+porcentaje+"%.");
            }

            $("#row_info").show();
            $("#row_loader").hide();
            
        })
        .error(function(){
            alert("Error al Cargar la Solicitud");
            $("#modalFacturar").modal("hide");
        });
    }

    function  llenar_tabla_productos( $productos , $tamano )
    {
        var table = $("#table-productos tbody");
        var tbody = "";
        var series =    "<table class='table'>"+
                            "<thead>"+
                                "<tr>"+
                                    "<th>#Series</th>"+
                                "</tr>"+
                            "</thead>"+
                            "<tbody>";

        var end_tbody =     "</tbody>"+
                        "</table>";
        var series_tbody = "";
        
        for( var x = 0 ; x < $tamano ; x++ )
        {   
            if( $productos[x].series.length > 0 )
            {   
                series_tbody = ""; 
                for( var s = 0 ; s < $productos[x].series.length ; s++ )
                {
                    series_tbody += 
                    "<tr style='text-align:center;'>"+
                        "<td>"+$productos[x].series[s].serie+"</td>"+
                    "</tr>";
                }


            }

            tbody += 
            "<tr>"+
                "<td>"+$productos[x].producto+"</td>"+
                "<td>"+$productos[x].lleva_series+"</td>"+
                "<td>"+(series+series_tbody+end_tbody)+"</td>"+
            "</tr>";
        }
        table.html(tbody);
    }
</script>