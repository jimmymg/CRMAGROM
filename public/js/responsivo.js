$(document).ready(function(){

    $("#cargando").hide();
    $("#wrapper").css("display","block");
    responsivo();
});

function responsivo()
            {
                var alto  = $("html").height();
                var alto_ventana = window.innerHeight;
                

                
                if( alto_ventana >= alto )
                {
                
                    $("#page-wrapper").css("height", alto_ventana - 60);
                
                }else{
              
                    $("#page-wrapper").css("height",alto);
                }

            
            }
            //Cuando esta cargando la tabla
//Se ponde despues de poner los elementos en el DataTable
function responsivo_DataTable()
{
    //+35 por el margin y el padding 10 y 10 de page-inner, y + 15 por el padding de page-wrapper
    $("#page-wrapper").css("height", $("#page-inner").height() + 35 );
    $("#page-inner").css("margin-bottom",0);
    $("#page-inner").css("padding-bottom",0);
    $("#page-inner").css("padding-top",0);
                

    $("html").css("background-color","white");
    $("body").css("background-color","white");
}
//Cuando Cambie la cantida de Filas
//Se pone en cualquier parte del js no dentro de las funciones, mandandole como parametro el id del div con la class row que contenga el datatable
function responsivo_ChangeDataTable(div)
{   
    $('#'+div).change( function () {
        var alto_ventana = window.innerHeight;
        var new_height =  $("#page-inner").height() + 35;
        //+35 por el margin y el padding 10 y 10 de page-inner, y + 15 por el padding de page-wrapper
        
        if( alto_ventana > new_height )
        {
            $("#page-wrapper").css( "height", alto_ventana - 60 );
        }else{
            $("#page-wrapper").css( "height", new_height );
        }
        
       //alert("Window - 60: "+(alto_ventana - 60)+" new_height: "+new_height);
        /*$("#page-inner").css("margin-bottom"  , 0);
        $("#page-inner").css("padding-bottom" , 0);
        $("#page-inner").css("padding-top"    , 0);*/
    });

    $('#'+div).keyup( function () {

        var alto_ventana = window.innerHeight;
        var new_height   = $("#page-inner").height() + 35;
        //+35 por el margin y el padding 10 y 10 de page-inner, y + 15 por el padding de page-wrapper
        
        if( alto_ventana > new_height )
        {
            $("#page-wrapper").css( "height", alto_ventana - 60 );
        }else{
            $("#page-wrapper").css( "height", new_height );
        }
        
    });

    $('#'+div).click( function () {

        var alto_ventana = window.innerHeight;
        var new_height   = $("#page-inner").height() + 35;
        //+35 por el margin y el padding 10 y 10 de page-inner, y + 15 por el padding de page-wrapper
        
        if( alto_ventana > new_height )
        {
            $("#page-wrapper").css( "height", alto_ventana - 60 );
        }else{
            $("#page-wrapper").css( "height", new_height );
        }
        
    });

}