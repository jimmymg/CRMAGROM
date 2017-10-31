<!-- Modal -->
<div class="modal fade" id="PagarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="data-solicitud">
                <div class="row" style="margin-left:10px;margin-right: 10px;">
                    
                    <div class="col-lg-12" id="place_html" style="text-align: center" ></div>

                    <label>Fecha de Pago</label>
                    <input id="fecha_pago" type="date" class="form-control">

                    <label>Observacion o Comentario</label>
                    <textarea id="comentario_observacion" class="form-control"></textarea>
                    
                    <button type='button' class='btn btn-success col-lg-12' id='guardar_pago'>PAGAR</button>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){

        $("#PagarModal").find(".row").hide();
    });

$(document).on("click", ".pagar", function(){
    
    $("#PagarModal").modal("show");
    $("#data-solicitud").val($(this).attr("data-solicitud"));
    cargarSolicitud( $(this).attr("data-solicitud") );

});

    $("#guardar_pago").click(function(){

        var solicitud   = $("#data-solicitud").val();
        var fecha_pago  = $("#fecha_pago").val();
        var observacion = $("#comentario_observacion").val();
        
        if( fecha_pago == "" )
        {
            swal("Error","Fecha de Pago esta vacio","error")
            return;
        }

        if( observacion == "" )
        {
            swal("Error" , "Observacion esta vacio" , "error")
            return;
        }


            swal.queue([{
                title: 'Pagar Factura',
                confirmButtonText: 'Si',
                text:
                    '¿Seguro? ',
                showCancelButton: true,
                showLoaderOnConfirm: true ,
                preConfirm: function () {
                 
                    return new Promise(function (resolve) {
                        
                        $.post("Pagos/pagar",{
                            solicitud   : solicitud ,
                            fecha_pago  : fecha_pago ,
                            observacion : observacion
                        })
                        .done(function(){
                            //resolve()
                            swal("Pagado","La Factura ha sido pagada","success")
                            pagos_pendientes();
                            pagos_historial();
                            $("#PagarModal").modal("hide");
                            
                        })
                        .error(function(){
                            alert("Error al Pagar la Factura");
                            resolve()
                        });
                        
                        //
                    })
                }             
            }]).then(function(){
                //Aqui nada prr
            }, function(dismiss){
                
            });
    });


    function cargarSolicitud($solicitud)
    {  
        $("#PagarModal").find(".row").hide();

        $.get("Pagos/getPagosPendientes/tipo/1/solicitud/"+$solicitud)
        .done(function(data){
            console.log("Solicitud");
            console.log(data);

            var estructura_html = "";
            var info = data[0];
            
            estructura_html +=
            "<h4><strong>Orden de Compra: </strong>"+info.orden_compra+"</h4>";

            estructura_html +=
            "<h4><strong>Factura: </strong>"+info.factura+"</h4>";
            estructura_html +=
            "<h4><strong>Vendedor: </strong>"+info.usuario+"</h4>";
            estructura_html +=
            "<h4><strong>Subtotal: </strong>"+info.subtotal+"</h4>";
            estructura_html +=
            "<h4><strong>Total: </strong>"+info.total+"</h4>";
            estructura_html +=
            "<h4><strong>Pendiente: </strong>"+info.pendiente_total+"</h4>";
            

            $("#place_html").html(estructura_html);
            $("#PagarModal").find(".row").show();
        })
        .error(function(){
            alert("Error al Cargar la Solicitud");
            $("#PagarModal").modal("hide");
        });
    }

    




</script>