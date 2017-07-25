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
                <div class="col-sm-3">
                    <p>Para: <input id="para" type="text" class="form-control "> </p>
                </div>
            <textarea class="form-control" id="texto"></textarea>
            <button type="Text" id="enviar">Enviar Correo</button>
               

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
        
        $("#enviar").click(function(){
            var para  = $("#para").val();  
            var texto = $("#text").val();

            $.post("correos/enviar",{
                to : para ,
                texto : texto 
            })
            .done(function(){
                alert("Creo que Todo Bien?");
            })
            .error(function(error){
                console.log(error);
                alert("Error");
            });
        });
        
    </script>

</body>

</html>