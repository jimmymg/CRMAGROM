$("#contactos_extras").click(function(){

	$("#ModalContactosExtras").modal("show");
	

	var proyecto = $("#CE_nuevo").attr("data-proyecto");
	//-------Consulta a Contactos Extra------//
	cargarContactosExtras(proyecto);
});
//Desplegar modal de cliente solo los que esten en la misma empresa
$("#CE_nuevo").click(function(){
	/*Se abre la modal con los clientes cargados*/
	var proyecto = $(this).attr("data-proyecto");

	$("#dataTables-CE-Clientes").hide();
	$("#cargando-CE-Clientes").show();
	$("#ModalCEClientes").modal('show');
	//---------------------------------------------------//
	$.get('Fase1/Cliente/Empresa/'+proyecto)
	.done(function(data){
		console.log("Exito al Consultar los Clientes de una Empresa");
		console.log(data);

		$("#dataTables-CE-Clientes").show();
		$("#cargando-CE-Clientes").hide();

		var tabla = $("#dataTables-CE-Clientes").DataTable();
		tabla.clear();
		for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {	
            
            tabla.row.add([
                x+1 ,
                '<button type="button" class="btn btn-primary add-contact" data-proyecto="'+proyecto+'" data-cliente="'+data[x].id+'">Agregar</button>' ,
                data[x].nombre    ,
                data[x].correo1   ,
                data[x].correo2   ,
                data[x].telefono  ,
                data[x].celular   
               
            ]).draw();	
        }

	})
	.error(function(){
		alert("Error al Consultar, Clientes se Cerrara");
		$("#ModalCEClientes").modal('hide');
	});

});

$("#dataTables-CE-Clientes").on("click",".add-contact", function()
{	
	var td = $(this).parent();
	var boton_html = $(this).parent().html();
	var cliente = $(this).attr("data-cliente");
	var proyecto = $(this).attr("data-proyecto");

	$(td).html('<div style="margin-top:40%; margin-left: 20%;" id="preloader_1">'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                        '<span></span>'+
                    '</div>');

	$.post("Fase1/AñadirContacto",
		{
			proyecto : proyecto ,
			cliente  : cliente
		})
	.done(function(data){
		$(td).html(boton_html);
		if( data == "error" )
		{
			swal("","El Cliente ya esta agregado!","warning")
		}else{
			swal("Guardado","Nuevo Contacto Agregado!","success")
		}
	})
	.error(function(){
		$(td).html(boton_html);
		swal("Error","Ocurrio un Error, Intentelo otra vezs","error")
	});
});



$("#ModalContactosExtras").on('hidden.bs.modal' , function(e){
    $("body").addClass("modal-open");
});
$("#ModalCEClientes").on('hidden.bs.modal' , function(e){
	var proyecto = $("#CE_nuevo").attr("data-proyecto");
	cargarContactosExtras(proyecto);
    $("body").addClass("modal-open");
});

function cargarContactosExtras(proyecto)
{
	$("#cargando-Contactos-Extras").show();
	$("#dataTables-Contactos-Extras").hide();

	$.get("Fase1/ContactosExtras/Proyecto/"+proyecto)
	.done(function(data){
		console.log("CONTACTOS EXTRAS");
		console.log(data);
		console.log("-----------------------");

		$("#cargando-Contactos-Extras").hide();
		$("#dataTables-Contactos-Extras").show();

		var tabla = $("#dataTables-Contactos-Extras").DataTable();
		tabla.clear();

		for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {	
            tabla.row.add([
                x+1 ,
                data[x].nombre    ,
                data[x].correo1   ,
                data[x].correo2   ,
                data[x].telefono  ,
                data[x].celular   
               
            ]).draw();	
        }


	})
	.error(function(){
		swal("Error","Error al Consulta se cerrara la ventana","error")
		$("#ModalContactosExtras").modal("hide");
	});
}