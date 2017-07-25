<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PHPMailer;
use Mailgun\Mailgun;


class PublicoController extends Controller
{
	Public function ejecutar($password)
    { /*Recordar que el servidor esta atrasado dos horas al horario de guadalajara*/
        if( $password != "Xq13wuI2Wiz0SM5vEzIylNJHd3paCBsXj8ocufyW0CNC" )
        {
            return "NULL POINT EXCEPTION :)";
        }

        $pendientes_hoy = DB::SELECT("SELECT agenda.id , agenda.id_usuario , agenda.`id_proyecto` , agenda.`recordatorio` , agenda.`via`, agenda.`fecha` , usuarios.`nombre` as usuario ,usuarios.`correo` , proyectos.`nombre` as proyecto FROM agenda 
INNER JOIN usuarios ON usuarios.`id` = agenda.`id_usuario`
INNER JOIN proyectos ON agenda.`id_proyecto` = proyectos.`id`
WHERE enviado = 0 AND agenda.fecha >= DATE_FORMAT(DATE(NOW()) , '%Y-%m-%d 00:00:00') AND fecha <= DATE_FORMAT(DATE(NOW()) , '%Y-%m-%d 23:59:59')");

        $fecha = DB::SELECT("SELECT  DATE_FORMAT(NOW() + INTERVAL 2 HOUR, '%Y-%m-%d %k:%i:00') AS hoy");
        $hoy = $fecha[0]->hoy;
        print_r($hoy);
        echo "<br>";
        require 'lib/mailgun-php/vendor/autoload.php';
        include 'lib/mailgun-php/src/Mailgun/Mailgun.php';
        foreach( $pendientes_hoy as $pendiente )
        {
             print_r($pendiente->fecha); 
             echo "<br>";  
            if( $pendiente->fecha == $hoy)
            {      $via = "Llamada";
                if( $pendiente->via == 2 )
                {
                    $via = "Email";
                }
                echo "<br>";
                echo "Entro";
                echo "<br>";
                
        
                $to = $pendiente->correo;

                
                $mg = new Mailgun("key-ff8657eb0bb864245bfff77c95c21bef");

                $domain = "omg.com.mx";
                $mg->sendMessage($domain, array('from'  => '<Recordatorios@omg.com.mx>',
                                      'to'      => $to,
                                      'subject' => 'Recordatorio',
                                      'html'    => 'Proyecto: '.$pendiente->proyecto.' Via: '.$via.' Fecha: '.$pendiente->fecha.
                                      ' Recordatorio: '.$pendiente->recordatorio));

                DB::TABLE("agenda")->WHERE("id",$pendiente->id)->UPDATE([
                    "enviado" => 1
                ]);
            }
            
        }
        /*
        echo "Entro";
            require 'lib/mailgun-php/vendor/autoload.php';
        
        $to = 'jaime.110194@gmail.com';

        include 'lib/mailgun-php/src/Mailgun/Mailgun.php';
        $mg = new Mailgun("key-ff8657eb0bb864245bfff77c95c21bef");

        $domain = "omg.com.mx";
         $mg->sendMessage($domain, array('from'  => '<Desconocido@omg.com.mx>',
                                      'to'      => $to,
                                      'subject' => 'Esto es el subject',
                                      'html'    => 'Esto es el HTML'));*/
        

    }

}