$("#archivos_cotizacion").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#siguiente_fase").attr("data-proyecto");
	cargarArchivos( proyecto , 1 );
});

$("#archivos_orden_compra_cliente").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#siguiente_fase").attr("data-proyecto");
	cargarArchivos( proyecto , 2 );
});

$("#archivos_orden_compra_proveedor").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#siguiente_fase").attr("data-proyecto");
	cargarArchivos( proyecto , 3 );
});

$("#archivos_formato_pedido").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#siguiente_fase").attr("data-proyecto");
	cargarArchivos( proyecto , 4 );
});

$("#vistaArchivosModal").on('hidden.bs.modal' , function(e){
            $("body").addClass("modal-open");
 });

function cargarArchivos( $proyecto , $tipoArchivo )
{
	$.get('Archivos/'+$tipoArchivo+'/proyecto/'+$proyecto)
	.done(function(data){
		console.log("||||Archivos:");
		console.log(data);

		var tabla = $("#dataTables-Archivos").DataTable();
		tabla.clear();
		for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {	

                	var url = window.location.host+'/'+data[x].ruta;
                    tabla.row.add([
                    	x+1,
                        data[x].created_at ,
                        data[x].usuario ,
                        '<a href="'+url+'" download=""><span class="glyphicon glyphicon-file"></span>'+data[x].archivo+'</a>'
                        ]).draw();	
                }


	})
	.error(function(){
		alert("Error al Consultar los Archivos");
	});
}