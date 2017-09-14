<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
     <link href="{{url('js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
     <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    
</head>

<body>
    <div id="wrapper">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Marcas <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" data-target="#modalMarca" data-toggle="modal" class="btn btn-primary waves-effect">Nueva Marca
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Marcas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-hover" id="dataTable-marcas">
                                        <thead>
                                            <tr>
                                                <th width="10%">#</th>
                                                <th >Nombre</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

    <!-- Modals -->

     <div class="modal fade " id="modalMarca" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <h4>Marca</h4>
                <input class="form-control" type="text" id="marca">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="guardar_Marca" >Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        Waves.init();
        $('#main-menu').metisMenu();
            
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
        });
        
        $(document).ready(function(){
            cargar_marcas();
        });

        $("#guardar_Marca").click(function(){

            var marca = $("#marca").val();

            if( marca != "" )
            {

                $.post("Marcas/AgregarMarca",{ marca : marca })
                .done(function(data){
                
                    console.log(data);

                    $("#marca").val('');
                    cargar_marcas();
                })
                .error(function(error){
                    alert("Error al Insertar la Marca");
                });
            }else{
                alert("Error no ha escrito nada");
            }
        });

        function cargar_marcas()
        {
            $.get("Marcas/getMarcas")
            .done(function(data){
                console.log(data);

                var tabla = $("#dataTable-marcas").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tabla.row.add([
                            x+1 ,
                            data[x].nombre
                        ]).draw();
                }

            }) 
            .error(function(error){
                alert("Error al Cargar las Marcas");
            });
        }
    </script>

</body>

</html>