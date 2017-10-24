<div class="modal fade " id="modalFacturar" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Facturar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                strong {
                    font-size: 14pt;
                }
            </style>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 style="text-align: center;">Orden: <strong></strong></h3>
                    </div>

                    <div class="col-lg-6">
                      
                            <div class="col-lg-12">
                                <label>Razon Social: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>

                            <div class="col-lg-12">
                                <label>Direccion: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>R.F.C: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Telefono: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Moneda: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Solicito: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Metodo de Pago: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Vencimiento: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                            <label>Subtotal: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>IVA: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Total: <strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                            <div class="col-lg-12">
                                <label>Porcentaje:<strong style=" text-transform: uppercase;"></strong></label>
                            </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <p>Vendedor: <strong>Alguien</strong></p>
                        <p>*Es un Anticipo del 50%</p>
                        <p>*Pago de Contado.</p>
                        
                        <h4 style="text-align: center;"><strong>Productos</strong></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Productos</th>
                                    <th>¿Lleva Series?</th>
                                    <th>Ver Series</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <label>Numero del Pedido AdminPAQ</label>
                        <input type="text" class="form-control">

                        <label>Numero de la Remision AdminPAQ</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="facturar_action" >Facturar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function cargar_info_modal(id)
    {
        alert(id);
        $.get("facturar/solicitud/"+id)
        .done(function(data){
            console.log(data);
            
        })
        .error(function(){
            alert("Error al Cargar la Solicitud");
        });
    }
</script>