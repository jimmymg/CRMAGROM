<div class="modal fade" id="vistaArchivosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vista de Archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                th { text-align: center; }
                #dataTables-Archivos_wrapper{
                        padding-left: 15px;
                        padding-right: 15px;
                }
            </style>
            <div class="modal-body">
                <div class="table-responsive">
                    <table style="padding-left: 10px; padding-right: 10px;" class="table table-striped table-bordered table-hover" 
                                id="dataTables-Archivos">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th>Fecha</th>
                                <th>Propietario</th>
                                <th>Arhivo</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
            </div>
        </div>
    </div>
</div>