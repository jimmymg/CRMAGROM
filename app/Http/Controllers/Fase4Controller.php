<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class Fase4Controller extends Controller
{
	public function __construct(){
        $this->middleware('guest');
       
    }

    public function index()
    {	
    	$proyectos =
    	DB::SELECT("
    		SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,
       			clientes.`nombre` AS cliente , empresas.`nombre` AS empresa , proyecto_estados.`nombre` AS estado , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
       			proyectos.`created_at` , ( SELECT factura FROM anticipo WHERE id_proyecto = proyectos.id LIMIT 1 ) as factura
				FROM proyectos  
				INNER JOIN  proyecto_tipos 	ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
				INNER JOIN moneda          	ON proyectos.`id_moneda` = moneda.`id`
				INNER JOIN proyecto_areas  	ON proyectos.`id_proyecto_area` = proyecto_areas.id
				INNER JOIN clientes        	ON proyectos.`id_cliente` = clientes.`id`
				LEFT JOIN empresas        	ON clientes.`id_empresa` = empresas.`id`
				INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
				INNER JOIN usuarios        	ON proyectos.`id_usuario` = usuarios.`id`
				INNER JOIN fuentes         	ON proyectos.`id_fuente` = fuentes.`id`

				WHERE fase = 4
				ORDER BY proyectos.created_at DESC
    		");
    	return view('Fase4.Fase4')->with([ "proyectos" => $proyectos , "contador" => 1 ]);
    }

    public function siguienteFase(Request $request)
    {
    	$proyecto = $request->input("proyecto");
    	$importacion   = $request->input("importacion");
        $transporte    = $request->input("transporte");
        $numero_compra = $request->input("numero_compra");
        $fecha_ingreso = $request->input("fecha_ingreso");
        $fecha_entrega = $request->input("fecha_entrega");
        $guia          = $request->input("guia");

        DB::TABLE("logistica")->insert([
        		"id_proyecto"             => $proyecto ,
        		"id_usuario"              => Auth::user()->id ,
        		"gastos_importacion_real" => $importacion ,
        		"gastos_transporte_real"  => $transporte ,
        		"numero_compra"           => $numero_compra ,
        		"fecha_ingreso"           => $fecha_ingreso ,
        		"fecha_entrega"           => $fecha_entrega ,
        		"guia"                    => $guia
        	]);
        
        $usuario = DB::SELECT("SELECT * FROM usuarios WHERE id = ".Auth::user()->id);
    	//Comentario Automatico
    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "Comentario Automatico: ".$usuario[0]->nombre." Cambia a Fase 5"
    		]);

    	DB::TABLE("proyectos")->where("id",$proyecto)->update([
    			"fase" => 5
    		]);   
    }
}