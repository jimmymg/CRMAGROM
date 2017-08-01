var campo_a_editar = 0;
/////////////////////////////////////////////////////////////////////////////
$("#editar_proyecto").click(function(){
	campo_a_editar = 1;
	cargando_modal('Editar Nombre del Proyecto' , $("#data-proyecto").val() );
});

$("#editar_descripcion").click(function(){
	campo_a_editar = 2;
	cargando_modal('Editar Descripcion' , $("#data-proyecto").val());
});

$("#editar_valor").click(function(){
	campo_a_editar = 3;
	cargando_modal('Editar Valor' , $("#data-proyecto").val());
});
/////////////////////////////////////////////////////////////////////////////
//Cuando el Modal se cierra que remplaze el body de la modal por el cargando
$("#ModalEditar").on('hidden.bs.modal',function(){

	$("#place_of_gardar_editado").html(
                    '<button type="button" class="btn btn-primary" id="guardar_editado">Guardar</button>'
                    );
	$("#place_of_gardar_editado").css("float","right");

	$("#ModalEditar").find(".modal-body").html('<div id="cargando-Campo-A-Editar">'+
                    '<div style="margin-left:45%" class="cargando2">'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                    '</div>'+
                '</div>');
});

$("body").on('click',"#guardar_editado",function(){

	$("#place_of_gardar_editado").css("float","none");
	$("#place_of_gardar_editado").html(
                    '<div style="margin-left: 45%;" class="cargando2">'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                    '</div>');

	var editar = campo_a_editar;
	var proyecto = $("#data-proyecto").val();
	var nuevo = $("#editar").val();

	switch(editar){

		case 1:
			$.post("Fase1/Editar",{
				proyecto : proyecto ,
				nuevo    : nuevo    ,
				campo    : "NOMBRE"
			})
			.done(function(){
				//Hacer una consulta solo buscando la descripcion AJAX
					Seccion_Mostrar(proyecto , 1);
			})
			.error(function(){
				alert("Error al Editar el Nombre");
				
				$("#place_of_gardar_editado").html(
                    '<button type="button" class="btn btn-primary" id="guardar_editado">Guardar</button>'
                    );
				$("#place_of_gardar_editado").css("float","right");
			});
		break;

		case 2:
		//Se Editara la Descripcion
			
			$.post("Fase1/Editar",{
				proyecto : proyecto ,
				nuevo    : nuevo    ,
				campo    : "DESCRIPCION"
			})
			.done(function(){
				//Hacer una consulta solo buscando la descripcion AJAX
					Seccion_Mostrar(proyecto , 2);
			})
			.error(function(){
				alert("Error al Editar la Descripcion");
				
				$("#place_of_gardar_editado").html(
                    '<button type="button" class="btn btn-primary" id="guardar_editado">Guardar</button>'
                    );
				$("#place_of_gardar_editado").css("float","right");
			});
		break;

		case 3:
			$.post("Fase1/Editar",{
				proyecto : proyecto ,
				nuevo    : nuevo    ,
				campo    : "VALOR"
			})
			.done(function(){
				//Hacer una consulta solo buscando la descripcion AJAX
					Seccion_Mostrar(proyecto , 3);
			})
			.error(function(){
				alert("Error al Editar el Nombre");
				
				$("#place_of_gardar_editado").html(
                    '<button type="button" class="btn btn-primary" id="guardar_editado">Guardar</button>'
                    );
				$("#place_of_gardar_editado").css("float","right");
			});
		break;

		case 4:
		break;
	}
});

$("#ModalEditar").on('hidden.bs.modal' , function(e){
	campo_a_editar = 0;
	
    $("body").addClass("modal-open");
});



function body_editar(opcion , proyecto)
{	
	var result = null;
	var body = "";
	$.get('Fase1/Proyectos/InformacionGeneral/'+proyecto)
			.done(function(data){
				console.log(data);
				
				result = data;
				switch(opcion)
					{
						case 1:
							body = '<input type="text" id="editar" class="form-control" value="'+result.fase1.proyecto[0].nombre+'">';
						break;

						case 2:
							body = '<textarea class="form-control" id="editar">'+result.fase1.proyecto[0].descripcion+'</textarea>';
						break;

						case 3:
							body = '<input type="number" class="form-control" id="editar" value="'+result.fase1.proyecto[0].valor
							+'">';
						break;
					}

				$("#ModalEditar").find(".modal-body").html(body);

			})
			.error(function(){
				alert("Error al Consultar la Informacion del Proyecto");
			});

	
}

function cargando_modal(titulo , $this)
{	
	var proyecto = $this;
	
	$("#ModalEditar").modal('show');
	$("#tituloEditar").html(titulo);
	//$("#guardar_editado").attr("data-proyecto",proyecto);
	 body_editar(campo_a_editar , proyecto);
	
}

function Seccion_Mostrar(proyecto,opcion)
{	

	$.get('Informacion/Fase1/'+proyecto)
	.done(function(data){
		console.log("Descripcion:");
		console.log(data);

		switch(opcion){

			case 1:
				$("#look_proyecto").html( data[0].nombre );
			break;

			case 2:
				$("#look_descripcion").html( data[0].descripcion );
			break;

			case 3:
				$("#look_valor").html( data[0].valor );
			break;
		}
		
		$("#ModalEditar").modal('hide');

		$("#ModalEditar").find(".modal-body").html('<div id="cargando-Campo-A-Editar">'+
                    '<div style="" class="cargando2">'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                    '</div>'+
                '</div>');

	})
	.error(function(){
		alert("Error al Consultar la Descripcion");
		//Si da error hacer que recargue la paguina
	});
}