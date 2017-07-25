<div class="modal fade " id="modalAgendar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agendar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Via</label>
                    <select id="via_agendar" class="form-control">
                        <option value="0">Seleccionar una Via</option>
                        <option value="1">Llamada</option>
                        <option value="2">Correo</option>
                    </select>
                    <label>Fecha</label>
                    <div class="input-append date form_datetime" data-date="2017-06-30T15:25:00Z">
                        <input size="16" type="text" id="fecha_agendado" class="form-control" value="" readonly>
                        <span class="add-on">
                            <i class="icon-remove">
                                <button type="button" class="btn btn-sm">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </i>
                        </span>
                        <span class="add-on">
                            <i class="icon-th">
                                <button type="button" class="btn btn-sm">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </button>
                            </i>
                        </span>
                    </div>
                    <label>Recordatorio</label>
                    <textarea id="texto_recordatorio" class="form-control"></textarea>

                    <button id="agendar_el_recordatorio" type="button" class="btn btn-primary col-sm-12">Agendar Recordatorio</button>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>