<!-- Modal -->
<div class="modal fade" id="EditarSerieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Series</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin-left: 10px; margin-right: 10px">
                    <label>Nueva Serie:</label>
                    <input type="text" class="form-control" id="nueva_serie" >
                    <button type="button" class="btn btn-success" id="guardar_nueva_serie">Guardar</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click",".edit-serie" , function(){

        $("#EditarSerieModal").modal("show");

        var idserie = $(this).parent().find("input").val();
        var serie   = $(this).attr("data-serie");

        $("#nueva_serie").val(serie);
        $("#nueva_serie").attr("data-serie",idserie);

    });

    $("#guardar_nueva_serie").click(function(){
        var idserie = $("#nueva_serie").attr("data-serie");
        var serie   = $("#nueva_serie").val();

        $.post("editarSerie",{
            nueva_serie : serie ,
            id_serie    : idserie
        });
    });

    $('#EditarSerieModal').on('hidden.bs.modal', function (e) {
        $("body").addClass("modal-open");
    })

</script>