<div class="modal fade" id="GoogleCalendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agendar Recordatorio en Google Calendar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>*Recordar que se enviara un correo y se insertara en la descripcion la informacion del cliente para contactarlo, no se necesita poner el telefono o el email en recordatorio</p>
                <input id="gc_date" type="date" class="form-control" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}">
             
                <input id="gc_time" type="time" class="form-control" >
                <textarea id="gc_recordatorio" class="form-control" placeholder="Recordatorio"></textarea>
                <button id="add_event_calendar" type="button" class="btn btn-primary">Agregar a mi Calendario</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
            </div>
        </div>
    </div>
</div>