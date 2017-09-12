$(document).ready(function(){
	ProyectosIndex(0);
});

$("#filtro_0").click(function(){
    
    ProyectosIndex(0);
});

$("#filtro_1").click(function(){
    
    ProyectosIndex(1);
});

$("#filtro_2").click(function(){
    ProyectosIndex(2);
});

$("#filtro_3").click(function(){
    ProyectosIndex(3);
});

$("#filtro_4").click(function(){
    ProyectosIndex(4);
});

$("#filtro_5").click(function(){
    ProyectosIndex(5);
});

function ProyectosIndex(filtro){

	$.get('ProyectosALL')
	.done(function(data){
		
        switch(filtro)
        {
            case 0: 
                filtroPrincipal(data,0);
            break;

            case 1: 
               
                filtroPrincipal(data,1);
            break;

            case 2:
               
                filtroPrincipal(data,2);
            break;

            case 3:
                
                filtroPrincipal(data,3);
            break;

            case 4:
               
                filtroPrincipal(data,4);
            break;

            case 5:
               
                filtroPrincipal(data,5);
            break;
        }
	})
	.error(function(){
		alert("Error al Cargar los Proyectos");
	});
	

}

function filtroPrincipal(data , filtro)
{
    var tabla = $("#dataTables-index").DataTable();
        tabla.clear();

        var n = 0;

        var ver = "";
        var dias = null;
        var color = null;
        var altura = null;
        var tipo = null;
        for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {   
            ver = 
            '<button data-target="#modalProyecto" data-toggle="modal" ' + 
            'type="button" class="btn verProyecto btn-primary" data-proyecto="'+data[x].id+'">' +
                '<span class="glyphicon glyphicon-search"></span>' +
            '</button>';


            dias = ( data[x].ultimo_seguimiento == null )? data[x].origen  : data[x].ultimo_seguimiento;
            //alert("Origin: "+data[x].origen+" Ultimo Seguimiento: "+data[x].ultimo_seguimiento );
            if( dias <= 7  )
            {
                color = "white";
                tipo = 1;
            }
            if( dias > 7 && dias <= 16 )
            {
                color = "green";
                tipo = 2;
            }

            if( dias > 16 && dias <= 31 )
            {
                color = "orange";
                tipo = 3;
            }

            if( dias > 31 && dias < 60 )
            {
                color = "red";
                tipo = 4;
            }

            if( dias >= 60 )
            {
                color = "gray";
                tipo = 5;
            }

            if( tipo == filtro || filtro == 0 )
            {

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
             
        }

        responsivo_DataTable();
}

