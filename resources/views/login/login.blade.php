<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>AGRO CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="{{url('/css/login/reset.css')}}">
        <link rel="stylesheet" href="{{url('/css/login/supersized.css')}}">
        <link rel="stylesheet" href="{{url('/css/login/style.css')}}">
        <link rel="stylesheet" href="{{url('/css/login/cargando.css')}}">


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style>
        	ul img {
        		/*opacity: 0.5;*/
                filter: blur(10px);
        	}
          /*  body {
                width: 100%;
                height: 100%;
                background-color: #d35400;
            }

            html , #cargando {
                background-color: #d35400;
            }
*/
            #cargando {
                
                background-color: #d35400;
                width: 100%;
                height: 100vh;
            }
            #shadow-root body{
                background-color: #d35400;
            }
            .page-container {
                display: none;
            }
            #supersized{
                display: none;
            }
        </style>
    </head>	

    <body>

        <div id="cargando" >
            <div class="spinner"></div>
        </div>

        <div class="page-container">
            <img src="{{url('/img/login/logo.jpg')}}" width="200px" height="225px">
            <h1>Login</h1>
            @if(isset($notfound))
            	{{$notfound}}
            @endif
            <form action="entrar" method="post">
                <input type="text" name="user" class="username" placeholder="Usuario">
                <input type="password" name="password" class="password" placeholder="Contraseña">
                <button type="submit">Login</button>
                <div class="error"><span>+</span></div>
            </form>
        </div>

        <!-- Javascript -->
        <script src="{{url('/js/login/jquery-1.8.2.min.js')}}"></script>
        <script src="{{url('/js/login/supersized.3.2.7.min.js')}}"></script>
        <script src="{{url('/js/login/supersized-init.js')}}"></script>
        <script src="{{url('/js/login/scripts.js')}}"></script>

    </body>

</html>

<script>
    $(document).ready(function(){
        $("#supersized").css("display","block");
        $(".page-container").show();
        $("#cargando").hide();

    });
</script>