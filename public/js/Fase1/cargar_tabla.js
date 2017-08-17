$(document).ready(function(){
	ProyectosIndex();
});

function ProyectosIndex(){

	$.get('ProyectosALL')
	.done(function(data){
		var tabla = $("#dataTables-index").DataTable();
		tabla.clear();

        var n = 0;

		var ver = "";
        var dias = null;
        var color = null;
        var altura = null;
		for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {	
            ver = 
            '<button data-target="#modalProyecto" data-toggle="modal" ' + 
            'type="button" class="btn verProyecto btn-primary" data-proyecto="'+data[x].id+'">' +
                '<span class="glyphicon glyphicon-search"></span>' +
            '</button>';


            dias = data[x].ultimo_seguimiento;

            if( dias > 7 && dias < 16 )
            {
                color = "green";
            }

            if( dias > 16 && dias < 31 )
            {
                color = "orange";
            }

            if( dias > 29 && dias < 61 )
            {
                color = "red";
            }

            if( dias > 59 )
            {
                color = "gray";
            }

            tabla.row.add([
                x+1                ,
                 "<div class='color-altura' style='background-color:"+color+"; width:130px; text-align: center; height:130px'>"+dias+" Dias</div>" ,
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
            
               	'<button id="cancelar" data-proyecto="'+data[x].id+'" class="btn btn-danger">Cancelar</button>'
            ]).draw();	
            
           
        }

        responsivo_DataTable();
	})
	.error(function(){
		alert("Error al Cargar los Proyectos");
	});
	

}