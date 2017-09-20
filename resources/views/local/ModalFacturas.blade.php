<div class="modal fade " id="modalFacturas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Facturas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <label>Agente</label>
                            <select id="filter_agente" class="form-control">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="hidden" id="key">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered    table-hover" 
                                        id="dataTables-Facturas">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Agente</th>
                                        <th>Fecha</th>
                                        <th>Serie</th>
                                        <th>Folio</th>
                                        <th>Moneda</th>
                                        <th>Tipo de Cambio</th>
                                        <th>Metodo de Pago</th>
                                        <th>Total</th>
                                        <th>Neto</th>
                                        <th>Pendiente</th>
                                        <th>Movimientos</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                </tbody>
                            </table>
                       </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>