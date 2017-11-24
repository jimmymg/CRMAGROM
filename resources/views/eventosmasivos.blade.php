<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
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
                        Bienvenido <small>{{Auth::user()->nombre}}</small>
                    </h1>
                </div>
            </div>
            <!-- /. ROW  -->

            <div class="row">
                
                <input type="file" id="excel" class="form-control" >

                <select class="from-control" id="calendarios"></select>

                <button type="button" id="evento" class="btn btn-success">Agregar a Calendario</button>
               

				<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    @include('layouts.js')

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
                cargarCalendarios();
            });

            $("#evento").click(function(){
                var calendario = $("#calendarios").val();

                var formData = new FormData();
			    formData.append('section', 'general');

			    var file = $( '#excel' )[0].files[0];

			    formData.append( 'file', $( '#excel' )[0].files[0] );
                formData.append( 'calendario' , calendario );
                console.log(file);

           

                req = new XMLHttpRequest();

			    req.onreadystatechange = function() {
    			    if (this.readyState == 4 && this.status == 200) {
     			
    				    //var obj         = JSON.parse( req.responseText );
                        swal("Ya quedo todo bien");
    				    console.log(req.responseText);

    			
     				
    			    }else{
                        swal("Hubo algun error :S");
                    }
  			};

			req.open("POST", "addem" , true)
			req.send(formData);

            });

            function cargarCalendarios()
            {
                $.get('calendarios')
                .done(function(data){
                    console.log(data);

                    var select = $("#calendarios");
                    var options = "<option value='0'>Seleccione un Calendario</option>";
                    for( var x = 0 ; x<data.length ; x++ )
                    {
                        options += 
                        "<option value='"+data[x]['id']+"'>"+data[x]['summary']+"</option>"
                    }

                    select.html(options);

                })
                .error(function(){
                    alert("Error al Consultar los Calendarios");
                });
            }
        
    </script>

</body>

</html>