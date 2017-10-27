$("#archivos_cotizacion").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#data-proyecto").val();
	alert(proyecto);
	cargarArchivos( proyecto , 1 );
});

$("#archivos_orden_compra_cliente").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#data-proyecto").val();
	cargarArchivos( proyecto , 2 );
});

$("#archivos_orden_compra_proveedor").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#data-proyecto").val();
	cargarArchivos( proyecto , 3 );
});

$("#archivos_formato_pedido").click(function(){
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#data-proyecto").val();
	cargarArchivos( proyecto , 4 );
});
//FASE 2
$("#archivos_anticipo_cliente").click(function(){
	//alert("click");
	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#data-proyecto").val();
	cargarArchivos( proyecto , 5 );
});

$("#archivos_anticipo_proveedor").click(function(){
	//alert("click");

	$("#vistaArchivosModal").modal('show');
	var proyecto = $("#data-proyecto").val();
	cargarArchivos( proyecto , 6 );
});


$("#vistaArchivosModal").on('hidden.bs.modal' , function(e){
    $("body").addClass("modal-open");
 });

function cargarArchivos( $proyecto , $tipoArchivo )
{
	$.get('Archivos/'+$tipoArchivo+'/proyecto/'+$proyecto)
	.done(function(data){
		console.log("||||Archivos:||||");
		console.log(data);
 $("#dataTables-Archivos tbody").html("");
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