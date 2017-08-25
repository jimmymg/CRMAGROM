<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class MisRecordatoriosController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
    }

    public function index()
    {      

        $recordatorios = $this->recordatorios( ( Auth::user()->id_area == 1 )?0:Auth::user()->id );

    	return view("recordatorios.recordatorios")->with("remember",$recordatorios);
    }

    function recordatorios($usuario)
    {
        if( $usuario == 0 )
        {
            return DB::SELECT("SELECT agenda.recordatorio , agenda.via , agenda.fecha , agenda.enviado , proyectos.nombre as proyecto , usuarios.nombre as usuario , DATEDIFF( NOW() , agenda.fecha ) AS diff_fecha , HOUR( TIMEDIFF( DATE_ADD(TIME(NOW()) , INTERVAL 2 HOUR) , TIME(agenda.fecha) ) ) AS diff_time  FROM agenda 
            INNER JOIN proyectos ON agenda.id_proyecto = proyectos.id
            INNER JOIN usuarios ON agenda.id_usuario = usuarios.id
            ORDER BY agenda.fecha desc");
        }else
        {
            return DB::SELECT("SELECT agenda.recordatorio , agenda.via , agenda.fecha , agenda.enviado , proyectos.nombre as proyecto , usuarios.nombre as usuario , DATEDIFF( NOW() , agenda.fecha ) AS diff_fecha , HOUR( TIMEDIFF( DATE_ADD(TIME(NOW()) , INTERVAL 2 HOUR) , TIME(agenda.fecha) ) ) AS diff_time  FROM agenda 
            INNER JOIN proyectos ON agenda.id_proyecto = proyectos.id
            INNER JOIN usuarios ON agenda.id_usuario = usuarios.id
            WHERE agenda.id_usuario = ".Auth::user()->id ." ORDER BY agenda.fecha desc");
        }
    }

   

}