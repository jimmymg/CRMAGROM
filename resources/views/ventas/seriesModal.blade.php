<!-- Modal -->
<div class="modal fade" id="SeriesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Series</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">


            

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>

<script>

$(document).on("click",".verSeries",function(){
    $("#SeriesModal").modal("show");
    cargarSeries($(this).attr("data-producto"));
});

function cargarSeries(id_producto)
{
    $("#SeriesModal").find(".row").html("");
    $.get("getSeries/"+id_producto)
    .done(function(data){
        console.log("Series:");
        console.log(data);
        var li = "";
        var ul = "<ul class='list-group'>";
        for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {
            li += 
            "<li class='list-group-item list-group-item-success'>"
                +data[x].serie+
            "</li>";
        }
        $("#SeriesModal").find(".row").html(ul+li+"</ul>");
    })
    .error(function(){
        alert("Error al Cargar las Series");
    });
}

</script>