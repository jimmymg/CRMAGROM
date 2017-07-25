var campo_a_editar = 0;

$("#editar_descripcion").click(function(){
	campo_a_editar = 2;
	cargando_modal('Editar Descripcion' , this);
});


$("#guardar_editado").click(function(){
	var editar =	campo_a_editar;
	
});

$("#ModalEditar").on('hidden.bs.modal' , function(e){
	campo_a_editar = 0;
	
    $("body").addClass("modal-open");
});



function body_editar(opcion)
{		
	switch(opcion)
	{
		case 2:
			alert("Entro al case");
			return '<textarea class="form-control" id="editar"></textarea>';
		break;
	}
}

function cargando_modal(titulo , $this)
{	
	var proyecto = $($this).attr("data-proyecto");
	
	$("#ModalEditar").modal('show');
	$("#tituloEditar").html(titulo);

	var body = body_editar(campo_a_editar);
	
	
	$("#ModalEditar").find(".modal-body").html(body);
}