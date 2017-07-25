$("body").on("click", ".editar" ,function(){
	$("#modalEmpresaEditar").modal("show");

	$("#body-empresa-editar").hide();
	$("#cargando-Empresa-a-Editar").show();

	var empresa = $(this).attr("data-empresa");
	$("#guardar_cambios_empresa").attr("data-empresa",empresa);
	cargar_empresa(empresa);
});

$("#guardar_cambios_empresa").click(function(){
			var nombre    = $("#editar_nombre").val();
            var giro      = $("#editar_giro").val();
            var direccion = $("#editar_direccion").val();
            var ciudad    = $("#editar_ciudad").val();
            var estado    = $("#editar_estado").val();
            var error = false;

            if( nombre == "" || giro == "" || direccion == '' || ciudad == "" || estado == "")
            {
                error = true;
            }

            if( error == false )
            {	
            	//alert("nombre: "+nombre+ " giro: "+giro+" direccion: "+direccion+" ciudad: "+ciudad+" estado: "+estado);
                try {
                	$.ajax({
  						type: "POST",
  						url: "Empresas/EditarEmpresa",
  						data: { 
  							'nombre'    : nombre    ,
                	    	'giro'      : giro      ,
                	    	'direccion' : direccion ,
                	    	'ciudad'    : ciudad    ,
                	    	'estado'    : estado    ,
                	    	'empresa'   : empresa 
                	    	},
                	    cache : false,
    					processData: false,
  						success: function(data){
  							console.log(data);
  							alert("Actualizado");
  						}
  						
					});
/*
                	$.post("Empresas/EditarEmpresa" , {
                	    nombre    : nombre    ,
                	    giro      : giro      ,
                	    direccion : direccion ,
                	    ciudad    : ciudad    ,
                	    estado    : estado    ,
                	    empresa   : empresa
                	})
                	.done(function(){
                	    //cargar_empresas();
                	    swal(
                	        '¡Guardado!',
                	        'Cambios Guardados!',
                	        'success'
                	        )
                	})
                	.error(function(){
                	    alert("Error al Insertar la Empresa");
                	});*/



            	}catch(e){
            		alert(e);
            	}
            }else
            {
                swal(
                        '¡Error!',
                        'Algun Campo esta Vacio!',
                        'error'
                        )
            }
});


function cargar_empresa (empresa)
{
	$.get("Empresas/empresa/"+empresa)
	.done(function(data){
		console.log("GETEMPRESA");
		console.log(data);

		$("#body-empresa-editar").show();
		$("#cargando-Empresa-a-Editar").hide();

		$("#editar_nombre").val(data[0]["nombre"]);
		$("#editar_giro").val(data[0]["giro"]);
		$("#editar_direccion").val(data[0]["direccion"]);
		$("#editar_ciudad").val(data[0]["ciudad"]);
		$("#editar_estado").val(data[0]["estado"]);

	})
	.error(function(){
		alert("Error al consultar la empresa");
		$("#cargando-Empresa-a-Editar").hide();
	});
}


