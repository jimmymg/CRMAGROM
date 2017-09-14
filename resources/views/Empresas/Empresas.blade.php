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
    @include("layouts.cargando")
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Empresas <small></small>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" data-target="#modalEmpresa" data-toggle="modal" class="btn btn-primary waves-effect">Nueva Empresa
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Empresas
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-hover" id="dataTable-empresas">
                                        <thead>
                                            <tr>
                                                <th width="1%">#</th>
                                                <th width="20%">Nombre</th>
                                                <th width="30%">Giro</th>
                                                <th width="30%">Direccion</th>
                                                <th width="15%">Ciudad</th>
                                                <th width="10%">Estado</th>
                                                <th width="5%">Editar</th>
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

				<footer ></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

    <!-- Modals -->

    <div class="modal fade " id="modalEmpresa" tabindex="-1" role="dialog"     aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <h4>Nombre</h4>
                    <input class="form-control" type="text" id="empresa" placeholder="Nombre">
                    <textarea class="form-control" placeholder="Giro" id="giro"></textarea> 
                    <h4>Direccion</h4>  
                    <input type="text" class="form-control" id="direccion" placeholder="Direccion">
                    <h4>Ciudad</h4>
                    <input class="form-control" placeholder="Ciudad" type="text" id="ciudad">
                    <h4>Estado</h4> 
                    <select class="form-control"  type="text" id="estado">
                        <option value="Aguascalientes">Aguascalientes</option>
                        <option value="Baja California">Baja California</option>
                        <option value="Baja California Sur">Baja California Sur</option>
                        <option value="Campeche">Campeche</option>
                        <option value="Chiapas">Chiapas</option>
                        <option value="Chihuahua">Chihuahua</option>
                        <option value="Ciudad de México">Ciudad de México</option>
                        <option value="Coahuila">Coahuila</option>
                        <option value="Colima">Colima</option>
                        <option value="Durango">Durango</option>
                        <option value="Estado de México">Estado de México</option>
                        <option value="Guanajuato">Guanajuato</option>
                        <option value="Guerrero">Guerrero</option>
                        <option value="Hidalgo">Hidalgo</option>
                        <option value="Jalisco">Jalisco</option>
                        <option value="Michoacán">Michoacán</option>
                        <option value="Morelos">Morelos</option>
                        <option value="Nayarit">Nayarit</option>
                        <option value="Nuevo León">Nuevo León</option>
                        <option value="Oaxaca">Oaxaca</option>
                        <option value="Puebla">Puebla</option>
                        <option value="Querétaro">Querétaro</option>
                        <option value="Quintana Roo">Quintana Roo</option>
                        <option value="San Luis Potosí">San Luis Potosí</option>
                        <option value="Sinaloa">Sinaloa</option>
                        <option value="Sonora">Sonora</option>
                        <option value="Tabasco">Tabasco</option>
                        <option value="Tamaulipas">Tamaulipas</option>
                        <option value="Tlaxcala">Tlaxcala</option>
                        <option value="Veracruz">Veracruz</option>
                        <option value="Yucatán">Yucatán</option>
                        <option value="Zacatecas">Zacatecas</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="guardar_Empresa" >Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    @include('Empresas.EmpresaModals.EmpresaEditarModal')
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{url('/js/empresa/editar.js')}}"></script>

    <style>
        .hover-red:hover {
            color:red;
            cursor: pointer;
            cursor: hand;
        }
    </style>

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
            cargar_empresas();  
        });

        $("#guardar_Empresa").click(function(){
            var nombre    = $("#empresa").val();
            var giro      = $("#giro").val();
            var direccion = $("#direccion").val();
            var ciudad    = $("#ciudad").val();
            var estado    = $("#estado").val();
            var error = false;

            if( nombre == "" || giro == "" || direccion == '' || ciudad == "" || estado == "")
            {
                error = true;
            }

            if( error == false )
            {
                $.post("Empresas/AgregarEmpresa",{
                    nombre    : nombre    ,
                    giro      : giro      ,
                    direccion : direccion ,
                    ciudad    : ciudad    ,
                    estado    : estado
                })
                .done(function(data){
                    cargar_empresas();
                    $("#empresa").val('');
                    $("#giro").val('');
                    $("#direccion").val('');
                    $("#ciudad").val('');
                    $("#estado").val('');
                    swal(
                        '¡Guardado!',
                        'Empresa Guardado con Exito!',
                        'success'
                        )
                })
                .error(function(error){
                    alert("Error al Insertar la Empresa");
                });
            }else
            {
                swal(
                        '¡Error!',
                        'Algun Campo esta Vacio!',
                        'error'
                        )
            }

        });

        function cargar_empresas()
        {
            $.get("Empresas/getEmpresas")
            .done(function(data){
                console.log(data);
                var tabla = $("#dataTable-empresas").DataTable();
                tabla.clear();

                for( var x = 0 ; x < Object.keys(data).length ; x++ )
                {
                    tabla.row.add([
                            x+1,
                            data[x].nombre ,
                            data[x].giro ,
                            data[x].direccion ,
                            data[x].ciudad ,
                            data[x].estado ,
                            '<span data-empresa="'+data[x].id+'" class="editar glyphicon glyphicon-edit fa-3x hover-red"></span>'
                        ]).draw();
                }
                //+35 por el margin y el padding 10 y 10 de page-inner, y + 15 por el padding de page-wrapper
                responsivo_DataTable();
                /*
                $("#page-wrapper").css("height", $("#page-inner").height() + 35 );
                $("#page-inner").css("margin-bottom",0);
                $("#page-inner").css("padding-bottom",0);
                

               $("html").css("background-color","white");
               $("body").css("background-color","white");*/
            })
            .error(function(error){
                alert("Error al Cargar Empresas");
            });
        }

        
    </script>

</body>

</html>