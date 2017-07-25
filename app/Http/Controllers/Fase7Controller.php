<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class Fase7Controller extends Controller
{
	public function __construct(){
        $this->middleware('guest');
       
    }

    public function index()
    {
    	$proyectos =
    	DB::SELECT("
    		SELECT proyectos.id , proyectos .nombre , 
                    proyectos .descripcion , 
                    proyecto_tipos.`nombre` AS tipo , 
                    moneda.`nombre` AS moneda , 
                    proyecto_areas.`nombre` AS area ,
       			    clientes.`nombre` AS cliente ,
                    empresas.`nombre` AS empresa ,
                    empresas.ciudad   AS ciudad ,
                    empresas.estado   AS estado ,
                    proyecto_estados.`nombre` AS status , 
                    usuarios.`nombre` AS usuario , 
                    fuentes.`nombre` AS fuente ,
       			    proyectos.`created_at` , 
                ( SELECT numero_adminpac FROM anticipo WHERE id_proyecto = proyectos.id LIMIT 1 ) as factura
				FROM proyectos  
				INNER JOIN  proyecto_tipos 	ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
				INNER JOIN moneda          	ON proyectos.`id_moneda` = moneda.`id`
				INNER JOIN proyecto_areas  	ON proyectos.`id_proyecto_area` = proyecto_areas.id
				INNER JOIN clientes        	ON proyectos.`id_cliente` = clientes.`id`
				LEFT JOIN empresas        	ON clientes.`id_empresa` = empresas.`id`
				INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
				INNER JOIN usuarios        	ON proyectos.`id_usuario` = usuarios.`id`
				INNER JOIN fuentes         	ON proyectos.`id_fuente` = fuentes.`id`

				WHERE fase = 7 and id_proyecto_estado != 4
				ORDER BY proyectos.created_at DESC
    		");

    	return view('Fase7.Fase7')->with(["proyectos"=>$proyectos,"contador"=>1]);
    }

    public function FinalizarProyecto(Request $request)
    {
    	$proyecto    = $request->input("proyecto");
    	$respuesta_1 = $request->input("respuesta_1");
        $respuesta_2 = $request->input("respuesta_2");
        $opinion     = $request->input("opinion");
        $usuario = DB::SELECT("SELECT * FROM usuarios WHERE id = ".Auth::user()->id);
    	//Comentario Automatico

    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "Comentario Automatico: ".$usuario[0]->nombre." Finalizo el Proyecto :)"
    		]);

        DB::TABLE("pregunta_respuesta")->INSERT([
                "id_proyecto" => $proyecto ,
                "pregunta"    => 1         ,
                "respuesta"   => $respuesta_1 ,
                "id_usuario"  => Auth::user()->id
            ]);

        DB::TABLE("pregunta_respuesta")->INSERT([
                "id_proyecto" => $proyecto ,
                "pregunta"    => 2         ,
                "respuesta"   => $respuesta_2 ,
                "id_usuario"  => Auth::user()->id
            ]);

        DB::TABLE("pregunta_respuesta")->INSERT([
                "id_proyecto" => $proyecto ,
                "pregunta"    => 3         ,
                "respuesta"   => $opinion  ,
                "id_usuario"  => Auth::user()->id
            ]);

    	DB::TABLE("proyectos")->where("id",$proyecto)->update([
    			"id_proyecto_estado" => 4
    		]);   
    }

    public function guardarComentario(Request $request)
    {
    	$proyecto   = $request->input("proyecto");
    	$comentario = $request->input("comentario");

    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" => $proyecto        ,
    			"id_usuario"  => Auth::user()->id ,
    			"seguimiento"  => $comentario
    		]);
    }

    public function getSeguimientos($proyecto)
    {
    	$losseguimientos =
    	DB::SELECT("SELECT usuarios.nombre , seguimientos.id , seguimientos.seguimiento , seguimientos.via 			, seguimientos.fecha , seguimientos.created_at
    				 FROM seguimientos
    				INNER JOIN usuarios ON usuarios.id = seguimientos.id_usuario
    				where id_proyecto = $proyecto
    				ORDER BY seguimientos.updated_at desc");
    	return $losseguimientos;
    }

    public function verProyecto($proyecto)
    {
        $losseguimientos =
        DB::SELECT("SELECT usuarios.nombre , seguimientos.id , seguimientos.seguimiento , seguimientos.via          , seguimientos.fecha , seguimientos.created_at
                     FROM seguimientos
                    INNER JOIN usuarios ON usuarios.id = seguimientos.id_usuario
                    where id_proyecto = $proyecto
                    ORDER BY seguimientos.updated_at desc");
        return [ "seguimientos"=>$losseguimientos];
    }

  

}