<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agrom CRM</title>
    <!-- Bootstrap Styles-->
    @include("layouts.css")
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
    @include("layouts.cargando")
    <div id="wrapper" style="display: none">
        
        @include("layouts.menuTop")
        @include("layouts.menuLeft")
        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Mis Recordatorios
                        </h1>
                    </div>
                </div>

                <div class="row">
                	<div class="col-lg-12">
                		<table class="table table-striped table-inverse table-bordered">
  							<thead >
    							<tr>
      								<th style="text-align: center;">De</th>
      								<th style="text-align: center;">Proyecto</th>
      								<th style="text-align: center;">¿Cuando?</th>
      								<th style="text-align: center;">Recordatorio</th>
      								<th style="text-align: center;">Via</th>
      								<th style="text-align: center;">Enviado</th>
    							</tr>
  							</thead>
  							<tbody>
  								@foreach( $remember as $remember )
    							<tr style=" background-color: {{( $remember->diff_fecha > 0 )?( ( $remember->enviado == 1 )?'':'orange') : ( ($remember->diff_fecha == 0)?'green':'' ) }}">
    							  	<td>{{$remember->usuario}}</td>
    							  	<td>{{$remember->proyecto}}</td>
    							  	<td>{{$remember->fecha}}</td>
    							  	<td>{{$remember->recordatorio}}</td>
    							  	<td style="text-align: center;">
    							  		<span class="glyphicon glyphicon-{{($remember->via==1)?'earphone':'envelope'}}" aria-hidden="true" style="color:{{($remember->via==1)?'blue':'brown'}}"></span>
    							  	</td>
    							  	<td style="text-align: center;">
    							  		<span class="glyphicon glyphicon-{{($remember->enviado==1)?'ok':'remove'}}" aria-hidden="true" style="color:{{($remember->enviado==1)?'green':'red'}}"></span>
    							  	</td>
    							</tr>
    							@endforeach
  							</tbody>
						</table>
                	</div>
               	</div>
                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>
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
            /*
        $("#exit").click(function(){
            $("#form-exit").submit();
        });*/
       
        $(document).ready(function(){
            //var ancho = $("html").width();
            
          
        });

    </script>



</html>