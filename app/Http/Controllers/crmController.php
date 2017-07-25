<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use PHPMailer;
use DB;
use Mailgun\Mailgun;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;


class crmController extends Controller{

	public function index()
    {	
        $client = new Google_Client();
        $client = $this->core($client);

    	$cargo = Auth::user()->id;
        $inner = "  ";
        $condicion = " ";

        if( Auth::user()->id_area > 1 )
        {   //Solo sus proyectos y los que este involucrado
            $inner = " INNER JOIN proyectos_administradores ON proyectos.id = proyectos_administradores.id_proyecto ";
            $condicion = " and proyectos_administradores.id_a_cargo = ". $cargo;

        }

        $consulta = "SELECT COUNT(proyectos.id) as cantidad
                FROM proyectos  
                INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`
                ".$inner."
                WHERE fase = 1 ".$condicion." and proyectos.id_proyecto_Estado = 1
               ";
        $Activos = DB::SELECT($consulta);
        
        return view('index')->with(["algo" => Auth::user()->usuario , "activos" => $Activos[0]->cantidad ]);
    }
	
	public function auth(Request $request)
	{
		$user     = $request->input('user');
		$password = $request->input('password');

		if(Auth::attempt(['usuario' => $user, 'password' => $password])){
            
            return redirect('inicio');
        }
        else{
        	//echo "usuario no encontrado";
            return view('login.login')->with('notfound','Usuario no encontrado');
        }
	}

	public function insertarUsuario ()
	{
		DB::table('usuarios')->insert([
			'usuario'  => "jimmy",
			'nombre'   => "jaime",
			'password' => Hash::make("jimmy"),
			'correo'   => "jimmy@example.com"
			]);
	}

	public function logout()
	{
        Auth::logout();
        return redirect('login');
	}

	public function correos()
	{
		return view('correos');
	}

    public function archivos($tipoArchivo , $proyecto)
    {   
        $archivos = 
        DB::SELECT('SELECT archivos.id , archivos.ruta , archivos.nombre as archivo , archivos.created_at , usuarios.nombre as usuario 
            FROM archivos 
            INNER JOIN usuarios ON archivos.id_usuario = usuarios.id
            WHERE id_proyecto='.$proyecto.' AND id_tipo='.$tipoArchivo.'
            ORDER BY created_at DESC');
        return $archivos;
    }

	public function GO(Request $request)
	{	

		 //Enviar correo a Karla, isayana y china
        require 'lib/mailgun-php/vendor/autoload.php';
        
        $to = 'jaime.110194@gmail.com';

        include 'lib/mailgun-php/src/Mailgun/Mailgun.php';
        $mg = new Mailgun("key-ff8657eb0bb864245bfff77c95c21bef");

        $domain = "omg.com.mx";
         $mg->sendMessage($domain, array('from'  => '<Desconocido@Desconocido>',
                                      'to'      => $to,
                                      'subject' => 'Esto es el subject',
                                      'html'    => 'Esto es el HTML'));

		/*
		$mail = new PHPMailer;
	
      	$mail->isSMTP(); // tell to use smtp
        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPSecure = "ssl"; // or ssl
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for 	testing. 
       	$mail->Username = "desarrollo2@omg.com.mx";
       	$mail->Password = "morenog221";
       	$mail->setFrom("desarrollo2@omg.com.mx", "Esto es una Prueba");
       	$mail->Subject = "Test";
       	$mail->MsgHTML("This is a test");
       	$mail->addAddress("jaime.110194@gmail.com", "Jimmy");
       	$mail->send();*/
	}

    public function GC()
    {
        $client = new Google_Client();

        $client = $this->core($client);
        $correo = explode("@",Auth::user()->correo);
       //print_r($client);
        return view('GoogleCalendar')->with(["principal" => $correo[0] , "dominio"=> $correo[1]]);
    }

    public function event(Request $request)
    {
        //Solo que ponga la fecha el rango siempre sera de 5 minutos
        $proyecto = $request->input('proyecto');
        print_r($_POST);
        
        $client = new Google_Client();
        $this->core($client);
        /**/
        $minutes_to_add = 5;

        $time = new DateTime($request->input("date").' '.$request->input("time").':00');
        $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

        $stamp = $time->format('Y-m-d H:i:s');
        echo $stamp;
        /**/

        $proyecto_info = DB::SELECT("
SELECT proyectos.id , proyectos.nombre AS proyecto , clientes.`nombre` AS cliente , clientes.`telefono` , clientes.`celular` , clientes.`correo1` , clientes.`correo2` , empresas.`nombre` as empresa FROM proyectos 
INNER JOIN clientes ON clientes.`id` = proyectos.`id_cliente`
INNER JOIN empresas ON clientes.`id_empresa` = empresas.`id`
WHERE proyectos.id = ".$proyecto);

        $descripcion = " <h3>Recordatorio: ".$request->input("re")." </h3> <h2><strong>Cliente:</strong> ".$proyecto_info[0]->cliente. "</h2> <h3> <strong>Correo 1:</strong>  ".$proyecto_info[0]->correo1." </h3><h3> <strong>Correo 2:</strong> ".$proyecto_info[0]->correo2." </h3><h3> <strong>Telefono:</strong> ".$proyecto_info[0]->telefono."</h3> <h3> <strong>Celular:</strong> ".$proyecto_info[0]->celular."</h3><h3> <strong>Empresa:</strong> ".$proyecto_info[0]->empresa."</h3>";

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event(array(
          'summary' => $proyecto_info[0]->proyecto,
          'location' => '',
          'description' => $descripcion,
          'start' => array(
            'dateTime' => $request->input("date").'T'.$request->input("time").':00',
            'timeZone' => 'America/Mexico_City',
          ),
          'end' => array(
            'dateTime' =>  str_replace(" ","T", $stamp),
            'timeZone' => 'America/Mexico_City',
          ),
          /*'recurrence' => array(
            'RRULE:FREQ=DAILY;COUNT=1'
          ),*/
          /*'attendees' => array(
            array('email' => 'lpage@example.com'),
            array('email' => 'sbrin@example.com'),
          ),*/
          'reminders' => array(
            'useDefault' => FALSE,
            'overrides' => array(
              array('method' => 'email', 'minutes'  => 1),
              //array('method' => 'popup', 'minutes'  => 1),
            ),
          ),
        ));

        $calendarId = Auth::user()->correo;

      
        $event = $service->events->insert($calendarId, $event);
    
        //return view('GoogleCalendar');
    }

    function core($client)
    {   
        //return Auth::user();
        //$client = new Google_Client();
        
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $client->setScopes('https://www.googleapis.com/auth/calendar');
        $client->setApprovalPrompt(env('GOOGLE_APPROVAL_PROMPT'));
        $client->setAccessType(env('GOOGLE_ACCESS_TYPE'));

    

        //Si esta vacio quiere decir que es la primera vez
        if( empty(Auth::user()->refresh_token_GC))
        {
          
            if( isset($_GET['code']) )
            {
                //Hubo Problemas con Authenticate
                //Class ???/Psr7/UriResolve Not Found
                //La Manera en la que se resolvio es ir a 
                // vendor/guzzlehttp/guzzle/src/Client.php
                //Linea 148 en una funcion que se llama buildUri, en la parte de UriResolve::resolve es donde ocurria el error, apartir de la version 1.4.0 se desprecio Uri::resolve(), por UriResolver::resolve(), pero la Clase UriResolver no existe, eso se puede ver en vendor/guzzlehttp/psr7/src/ alli se encuentra pero no mas esta Uri, entonces no mas se quito Resolve y ya Funciono.
                $client->authenticate($_GET['code']);

                $access_token = $client->getAccessToken();
                
                DB::table('usuarios')->where("id",Auth::user()->id)
                ->update(
                    [ 
                        "refresh_token_GC" => $access_token['refresh_token'],                            
                        "expire"       => $access_token['created'] ,
                        "access_token_GC" => json_encode($access_token)
                    ]);

            }else{
             
                $auth_url     = $client->createAuthUrl();
                $filtered_url = filter_var($auth_url , FILTER_SANITIZE_URL);
                //Se pone echo para que redireccion, con return no jala :( 
                echo redirect($filtered_url);
                //return redirect($filtered_url);

            }
        }/*
        echo time()-Auth::user()->expire;
        echo "<br>";
        echo "En Uso Token <br>";
        print_r(Auth::user()->access_token_GC);
        echo "<br>";*/
        //Si expiro Usar refresthToken solicitar uno nuevo
        if( (time()-Auth::user()->expire) > 3600 || empty(Auth::user()->access_token_GC) )
        {   
            /*echo "Se Genero uno Nuevo";
            echo "<br>";
            echo "Nuevo Token:";
            echo "<br>";*/
            $client->refreshToken(Auth::user()->refresh_token_GC);
            $access_token = $client->getAccessToken();
            //print_r($access_token);
            DB::table('usuarios')->where("id",Auth::user()->id)
                ->update(
                    [                            
                        "expire"          => $access_token['created'] ,
                        "access_token_GC" => json_encode($access_token)
                    ]);
            $client->setAccessToken($access_token);
        }else{
            //Si no ha expirado entonves que siga con $_SESSION['access_token']
            $client->setAccessToken(json_decode(Auth::user()->access_token_GC,true));
            //$client->refreshToken($t[0]->refresh_token);
        }
       
        return $client;

    }

}