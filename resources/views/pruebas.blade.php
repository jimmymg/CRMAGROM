<html>
    <header>
        @include("layouts.css")
    </header>
    <body>
        <button type="button" id="pusher">Click</button>
        <div id="place_pusher">

        </div>
    </body>
    @include('layouts.js')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>

    <script>

    // Enable pusher logging - don't include this in production
   // Pusher.logToConsole = true;
    //Super Pelado el Pusher OMG valeria
    var pusher = new Pusher('040c4ec34fd1f7806ba2', {
      cluster: 'us2',
      encrypted: true
    });

    var channel = pusher.subscribe('canal');

    channel.bind('evento', function(data) {

        var html = $("#place_pusher").html();
        $("#place_pusher").html(html+"<p>El Pusher Estuvo Aqui</p>");

    });

    $("#pusher").click(function(){

        $.get("pruebas/pusher");

    });

  </script>

</html>