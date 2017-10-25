<!-- Modal -->
<div class="modal fade" id="addProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Producto a la Solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
               #preloader_3{
    position:relative;
}
#preloader_3:before{
    width:20px;
    height:20px;
    border-radius:20px;
    background:blue;
    content:'';
    position:absolute;
    background:#9b59b6;
    animation: preloader_3_before 1.5s infinite ease-in-out;
}
 
#preloader_3:after{
    width:20px;
    height:20px;
    border-radius:20px;
    background:blue;
    content:'';
    position:absolute;
    background:#2ecc71;
    left:22px;
    animation: preloader_3_after 1.5s infinite ease-in-out;
}
 
@keyframes preloader_3_before {
    0% {transform: translateX(0px) rotate(0deg)}
    50% {transform: translateX(50px) scale(1.2) rotate(260deg); background:#2ecc71;border-radius:0px;}
      100% {transform: translateX(0px) rotate(0deg)}
}
@keyframes preloader_3_after {
    0% {transform: translateX(0px)}
    50% {transform: translateX(-50px) scale(1.2) rotate(-260deg);background:#9b59b6;border-radius:0px;}
    100% {transform: translateX(0px)}
}
            
            .loader {
   
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.bar {
  width: 100%;
  height: 20px;
  border: 1px solid #2980b9;
  border-radius: 3px;
  background-image: 
    repeating-linear-gradient(
      -45deg,
      #2980b9,
      #2980b9 11px,
      #eee 10px,
      #eee 20px /* determines size */
    );
  background-size: 28px 28px;
  animation: move .5s linear infinite;
}

@keyframes move {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 28px 0;
  }
}
            </style>
            <div class="modal-body">
                <div class="row">

                    

                    <div class="col-lg-12" id="APM_nuevo_producto">
                        
                        <div class="col-lg-12" style="margin-top:10px;">
                            <div class="col-lg-12">
                                <label>Productos</label>
                            </div>
                            <div class="col-lg-12">
                                <div class="bar"></div>
                            </div>
                            <div class="col-lg-12">
                                <select id="seleccionar_producto" class="form-control">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" id="update" class="btn btn-primary waves-effect">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar
                                </button>
                                <button type="button" id="dar_alta_producto" class="btn btn-secondary waves-effect">Dar de Alta el Producto</button>
                            </div>
                        </div>
                        <div class="col-lg-12" id="al-series">
                            <div class="alert alert-success">
                                <strong>Series</strong> Este Producto lleva Series.
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Cantidad</label>
                            <input type="number" id="cantidad_productos" class="form-control" value="0" min="0" >
                        </div>
                        <div class="col-lg-4">
                            <label>Total</label>
                            <input type="number" id="product_total" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-lg-6" style="margin-top:20px;">
                            <button type="button" class="col-lg-12 btn btn-warning waves-effect" id="add_series">Añadir las Series</button>
                        </div>
                        <div class="col-lg-6" style="margin-top:20px;">
                            <button type="button" class="col-lg-12 btn btn-success" id="add_product">Agregar</button>
                        </div>

                        <div class="col-lg-12">
                            <table class="table" id="table-productos-added">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>¿Series?</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th>Ver Series</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12" id="APM_alta_producto">
                        <label>Nuevo Producto</label>

                        <input style="text-transform:uppercase;" class="form-control" type="text" id="alta_producto">
                        <div class="col-lg-12">
                            <div class="col-lg-2">
                                <label>¿Maneja Series?</label>
                            </div>
                            <div class="col-lg-2">
                                <input id="control_series" type="checkbox" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                          
                                <div style="margin-left: calc(50% - 60px);margin-top: 10px;" class="loader"></div>
                          
                        </div>

                        <div class="col-lg-12">
                            <table class="table" id="table-all-productos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>¿Majea Series?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-sm-2">
                            <button id ="cancelar_APM_alta_producto" class="btn-danger btn">Cancelar</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="save_new_product" class="btn btn-success">Guardar</button>
                        </div>

                        <div class="col-sm-6" style="margin-left: 20px;margin-top: 10px;">
                            <div id="preloader_3"></div>
                        </div>
                    </div>
                    <!-- SECCION DE SERIES -->
                    <div class="col-lg-12" id="APM_add_series">

                        <div class="col-lg-12">
                            <button id ="cancelar_APM_add_series" class="btn-danger btn">Regresar</button>
                        </div>

                        <div class="col-lg-12">
                            <h3>Cantidad: <strong></strong></h3>
                        </div>

                        <div class="col-lg-12">
                            <div class="col-lg-8">
                                <label>Serie:</label>
                                <input type="text" class="form-control" id="serie">
                            </div>
                            <div class="col-lg-2" style="margin-top: 25px;">
                                <button type="button" class="btn btn-primary" id="a_s">+</button>
                            </div>
                        </div>

                        <div class="col-lg-12" id="lista_series" style="margin-top:20px;">
                            <ul class="list-group">
                                
                            </ul>
                        </div>

                       

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>

<script>

var global_productos = [];
var global_all_productos = [];
var global_index_all_productos = [];

$(document).ready(function(){
    
});

$("#APM_alta_producto").hide();
$("#preloader_3").parent().hide();
$(".loader").parent().hide();
$(".bar").parent().hide();
$("#APM_add_series").hide();
$("#al-series").hide();


$("#lleva_serie").change(function(){
    if( $(this).is(":checked") )
    {
       
    }else{
        
    }
});


$("#dar_alta_producto").click(function(){
    llenar_table_all_productos();
    $("#APM_nuevo_producto").hide();
    $("#APM_alta_producto").show();

    $("#addProductoModal .modal-title").html("Agregar Producto");
});

$("#cancelar_APM_alta_producto").click(function(){
    
    $("#APM_nuevo_producto").show();
    $("#APM_alta_producto").hide();

    $("#addProductoModal .modal-title").html("Añadir Producto a la Solicitud");
});

$("#seleccionar_producto").on("change",function(e){
    //alert( );
    //Hacer que cuando seleccionar el producto aaparesca si necesita serie
    $("#product_total").val('');
    $("#cantidad_productos").val('');
    $("#lista_series ul").html('');
    $("#APM_add_series").find("h3").find("strong").html('');

    var index = global_index_all_productos.indexOf( parseInt($("#seleccionar_producto").val()) );
    var serie = global_all_productos[index].serie;
    if( serie )
    {
        $("#al-series").show();
        $("#add_series").show();
    }else{
        $("#al-series").hide();
        $("#add_series").hide();
    }
    

});

$("#save_new_product").click(function(event){
    //GuardarProducto
    event.preventDefault();
    $(this).hide();
    $("#preloader_3").parent().show();

    var producto = $("#alta_producto").val().toUpperCase();
    producto = $.trim(producto);


    if( producto == "" )
    {
        $("#save_new_product").show();
        $("#preloader_3").parent().hide();
        swal("Error","Producto esta vacio","error")
        return ;
    }

    var ll_serie = ( $("#control_series").is(":checked") )?1:0;

    $.post('nueva/altaProducto' , {
        producto : producto ,
        control_series : ll_serie

    })
    .done(function(data){
        if(data == 500)
        {   
            $("#save_new_product").show();
            $("#preloader_3").parent().hide();
            swal("Error","Error ese Producto ya esta dado de alta","error")
        }else{
            llenar_table_all_productos();
            $("#save_new_product").show();
            $("#preloader_3").parent().hide();
            $("#alta_producto").val('');
            $("#control_series").prop("checked",false);
            swal("Guardado","El producto se guardo","success")
        }
    })
    .error(function(){
        alert("Error al agregar el Nuevo Producto");
    });
});

$("#add_product").click(function(event){

    event.preventDefault();
    $(this).hide();

    var series = [];
    var lleva_serie = ($("#al-series").is(":visible")) ?true:false;
    
    var producto = $("#seleccionar_producto").val();
    var cantidad = $("#cantidad_productos").val();
    var total    = $("#product_total").val();

    //alert(producto+" "+cantidad+" "+total+" "+serie+" "+lleva_serie);
    if( cantidad == "" || cantidad <= 0 )
    {
        swal("Error","Cantidad no tiene que estar vacio y tiene que ser mayor a 0","error");
        $("#add_product").show();
        return ;
    }

    if( total <= 0 || total == "" )
    {
        swal("Error","Total no tiene que estar vacio y tiene que se mayor a 0","error");
        $("#add_product").show();
        return ;
    }


    if( lleva_serie == true )
    {

        $("#lista_series ul").find('li').each(function(n){
     
            //recuerde que comienza a contar desde 0
            series.push($(this).find("strong").html() );  
        
        });  
    }

    $.post('nueva/orden/addproduct',{
        producto : producto ,
        cantidad : cantidad ,
        total : total ,
        lleva_series : lleva_serie ,
        series : series , 
        numero_orden : $("#solicitud_id").val()
    })
    .done(function(data){

        if( data == "validar" )
        {
            swal("Error","Ese Producto ya esta en la orden","error")
        }else{

            swal("Guardado","Producto Guardado a la Solicitud","success")
          
        }
        $("#add_product").show();
        calcular_total($("#solicitud_id").val());
        llenar_tablas_productos($("#solicitud_id").val());
    })
    .error(function(){
        alert("Error al Guardar el Producto");
        $("#add_product").show();
    })



   
});

$("#add_series").click(function(){
    var cantidad = $("#cantidad_productos").val();

    if(  cantidad < 0 || cantidad == 0 || cantidad == "")
    {
        swal("Error","Cantidad tiene que ser > 0 y no tiene que estar vacio","error");
        return ;
    }

    var actual = parseInt( $("#APM_add_series").find("h3").find("strong").html() );

    if( actual > cantidad )
    {
    
        swal({
            title: '¿Seguro?',
            text: "Actualmente hay un cantidad de: "+cantidad+" y la nueva cantidad de productos es menor a la actual, si desea continuar se eliminaran las series agregadas anteriormente",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then(function () {
            $("#APM_add_series").find("h3").find("strong").html(cantidad);
            $("#APM_add_series").show();
            $("#addProductoModal .modal-title").html("Añadir las Series");
            $("#APM_nuevo_producto").hide();

            $("#lista_series ul").html('');
        })

        return ;
    }else{

        $("#APM_add_series").find("h3").find("strong").html(cantidad);
        $("#APM_add_series").show();
        $("#addProductoModal .modal-title").html("Añadir las Series");
        $("#APM_nuevo_producto").hide();
    }

});

$("#cancelar_APM_add_series").click(function(){
    $("#APM_add_series").hide();

    $("#APM_nuevo_producto").show();
    $("#addProductoModal .modal-title").html("Añadir Producto a la Solicitud");
});

$("#a_s").click(function(){
    var hay = 0;
    var cantidad = $("#cantidad_productos").val();
    var serie    = $("#serie").val();
    var igual    = false;

    if( serie == "" )
    {
        swal("Error","Campo Serie esta vacio","error")
        return ;
    }

    $("#lista_series ul").find('li').each(function(n){
        hay = n+1;
        //recuerde que comienza a contar desde 0
        if( serie == $(this).find("strong").html()  )
        {
            igual = true;
        }
    });
    
    if( (hay+1) > cantidad )
    {
        swal("Error","El limite de series son: "+cantidad,"error")
        return ;
    }

    if( igual )
    {
        swal("Error","Esa serie ya ha sido agregado","error")
        return ;
    }

    


    var actual = $("#lista_series ul").html();
    var nuevo = '<li class="list-group-item list-group-item-info"><strong>'+$.trim(serie)+'</strong><span style="color:red;float:right" class="glyphicon glyphicon-remove remove-serie"></span></li>';
     $("#lista_series ul").html(actual + nuevo);

     $("#serie").val('');
});

$("body").on('click', '.remove-serie' ,function(){
    $(this).parent().remove();
});
/*############################################################*/
function llenar_table_all_productos()
{   
    $(".loader").parent().show();
    $("#table-all-productos").hide();
    $.get('nueva/getProductos')
    .done(function(data){
        console.log(data);

        var table = $("#table-all-productos tbody");
        var tbody = "";

        var valor = "Si";
       

        for(var x = 0 ; x < Object.keys(data).length ; x++)
        {   

            valor = ( data[x].lleva_series )?"Si":"No";

            tbody +=    "<tr>"+
                            "<td>"+(x+1)+"</td>"+
                            "<td>"+data[x].producto+"</td>"+
                            "<td>"+valor+"</td>"
                        "</tr>";
        }

        table.html(tbody);
        $(".loader").parent().hide();
        $("#table-all-productos").show();

    })
    .error(function(){
        alert("Error al Consultar los productos");
        $(".loader").parent().hide();
        $("#table-all-productos").show();
    });
}
$("#update").click(function(){
    llenar_seleccionar_producto();
});

function llenar_seleccionar_producto()
{   

    $(".bar").parent().show();
    $("#seleccionar_producto").select2();
    $("#seleccionar_producto").select2("destroy");
    $("#seleccionar_producto").hide();
    $("#al-series").hide();
    $("#add_series").hide();

    $("#cantidad_productos").val(0);
    $("#product_total").val(0);

     $.get('nueva/getProductos')
    .done(function(data){
        console.log(data);

        var select = $("#seleccionar_producto");
        var options = "<option value='0' disabled selected>Seleccione un Producto</option>";
        var valor = "Si";

        global_index_all_productos = [];
        global_all_productos      = [];

        console.log(global_index_all_productos);
        console.log(global_all_productos);

        for( var x = 0 ; x < Object.keys(data).length ; x++ )
        {   
            valor = (data[x].lleva_series)?"Si":"No";

            global_index_all_productos.push( data[x].id );
            global_all_productos.push( { "id":data[x].id , "serie":data[x].lleva_series } );

            options += "<option data-serie='"+data[x].lleva_series+"' value='"+data[x].id+"'>"+data[x].producto+" | SERIES: "+valor+"</option>";
        }

        select.html(options);

        $(".bar").parent().hide();
        $("#seleccionar_producto").show();

        $("#seleccionar_producto").select2();

    })
    .error(function(){
        alert("Error al Consutlar los productos para llenar el seleccionar");
        $(".bar").parent().hide();
        $("#seleccionar_producto").show();
    });
}

function llenar_tablas_productos(orden)
{
    //table-productos-added

    $.get('nueva/orden/'+orden+'/productos')
    .done(function(data){
        console.log(data);

        var tbody = "";
        var button = "";
        for( var x = 0 ; x < data.length ; x++ )
        {   
            if( data[x].lleva_series == 1 )
            {
                button = "<button type='button' class='btn btn-primary verSeries'>Series ("+data[x].cantidad+")</button>";
            }else{
                button = "N/A";
            }
            

            tbody +=    "<tr>"+
                            "<td>"+(x+1)+"</td>"+
                            "<td>"+data[x].producto+"</td>"+ 
                            "<td>"+data[x].lleva_series+"</td>"+
                            "<td>"+data[x].cantidad+"</td>"+
                            "<td>"+data[x].total+"</td>"+
                            "<td>"+button+"</td>"
                        "</tr>";
        }
        $("#table-productos tbody").html(tbody);
        $("#table-productos-added tbody").html(tbody);
        responsivo();
    })
    .error(function(){
        alert("Error al Llenas la tabla de productos");
    });

    
}
</script>