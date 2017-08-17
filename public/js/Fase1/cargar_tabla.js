$(document).ready(function(){
	ProyectosIndex();
});

function ProyectosIndex(){

	$.get('ProyectosALL')
	.done(function(data){
		var tabla = $("#dataTables-index").DataTable();
		tabla.clear();

		var ver = "";

		for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {	
            ver = 
            '<button data-target="#modalProyecto" data-toggle="modal" ' + 
            'type="button" class="btn verProyecto" data-proyecto="'+data[x].id+'">' +
                '<span class="glyphicon glyphicon-search"></span>' +
            '</button>';

            tabla.row.add([
                x+1                ,
                data[x].ultimo_seguimiento                 ,
                ver+data[x].nombre ,
               	data[x].tipo       ,
               	data[x].moneda     ,
               	data[x].valor      ,
               	data[x].area       ,
               	data[x].cliente    ,
               	data[x].empresa    ,
               	data[x].estado     ,
               	data[x].usuario    ,
               	data[x].fuente     ,  
               	data[x].created_at , 
                ""
               	/*'<button id="cancelar" data-proyecto="'+data[x].id+'" class="btn btn-danger">Cancelar</button>'*/
            ]).draw();	

        }

        responsivo_DataTable();
	})
	.error(function(){
		alert("Error al Cargar los Proyectos");
	});
	

}