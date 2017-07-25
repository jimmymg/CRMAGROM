$(document).ready(function(){
                
    $("#cargando").hide();
    $("#wrapper").css("display","block");
    responsivo();
});

function responsivo()
            {
                var alto  = $("html").height();
                var alto_ventana = window.innerHeight;
                
                if( alto_ventana > alto )
                {
                
                $("#page-wrapper").css("height", alto_ventana - 60);
                
                }else{
              
                $("#page-wrapper").css("height",alto);
                }

            
            }