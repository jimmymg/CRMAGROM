<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class Fase5Controller extends Controller
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
       			proyectos.`created_at` , ( SELECT numero_adminpac FROM anticipo WHERE id_proyecto = proyectos.id LIMIT 1 ) as factura
				FROM proyectos  
				INNER JOIN  proyecto_tipos 	ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
				INNER JOIN moneda          	ON proyectos.`id_moneda` = moneda.`id`
				INNER JOIN proyecto_areas  	ON proyectos.`id_proyecto_area` = proyecto_areas.id
				INNER JOIN clientes        	ON proyectos.`id_cliente` = clientes.`id`
				LEFT JOIN empresas        	ON clientes.`id_empresa` = empresas.`id`
				INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
				INNER JOIN usuarios        	ON proyectos.`id_usuario` = usuarios.`id`
				INNER JOIN fuentes         	ON proyectos.`id_fuente` = fuentes.`id`

				WHERE fase = 5
				ORDER BY proyectos.created_at DESC
    		");

    	return view('Fase5.Fase5')->with(["proyectos"=>$proyectos,"contador"=>1]);
    }

    public function verProyecto($proyecto)
    {

    	$anticipo_proveedor = 
    	DB::SELECT("SELECT * FROM anticipo WHERE id_proyecto = $proyecto and tipo = 2");

    	$anticipo_cliente =
    	DB::SELECT("SELECT * FROM anticipo WHERE id_proyecto = $proyecto and tipo = 1"); 

    	$losseguimientos =
    	DB::SELECT("SELECT usuarios.nombre , seguimientos.id , seguimientos.seguimiento , seguimientos.via 			, seguimientos.fecha , seguimientos.created_at
    				 FROM seguimientos
    				INNER JOIN usuarios ON usuarios.id = seguimientos.id_usuario
    				where id_proyecto = $proyecto
    				ORDER BY seguimientos.updated_at desc");


    	return [ "anticipo_cliente" => $anticipo_cliente , "anticipo_proveedor" => $anticipo_proveedor , "seguimientos" => $losseguimientos];
    }

    public function siguienteFase(Request $request)
    {
    	$proyecto = $request->input("proyecto");
    	
        $usuario = DB::SELECT("SELECT * FROM usuarios WHERE id = ".Auth::user()->id);
    	//Comentario Automatico
    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "Comentario Automatico: ".$usuario[0]->nombre." Cambia a Fase 6"
    		]);

    	DB::TABLE("proyectos")->where("id",$proyecto)->update([
    			"fase" => 6
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

    public function subirArchivos()
    {
        $tipo_archivo = $_POST["tipo"];
        $archivo      = $_FILES["archivos"];       

        $name     = $archivo["name"][0]; 
        $type     = $archivo["type"][0];
        $tmp_name = $archivo["tmp_name"][0];
        $error    = $archivo["error"][0];
        $size     = $archivo["size"][0];

        $dateToFiles  = date('Y_m_d_H_i_s');

        $ext      = explode(".", $name);
        $cantidad = count($ext);
        $b        = getcwd();

        $destino      = $b."/archivos/".$dateToFiles.".".$ext[$cantidad-1];    
        $destino_save =     "archivos/".$dateToFiles.".".$ext[$cantidad-1];
        
        move_uploaded_file($tmp_name , $destino);

        //Archivos Para Oportunidad
        DB::table('archivos')->insert([
            'id_proyecto'       =>   $_POST["proyecto"] ,
            'id_tipo'           =>   $tipo_archivo      ,
            'id_usuario'        =>   Auth::user()->id   ,
            'ruta'              =>   $destino_save      ,
            'nombre'            =>   $name
        ]);

       return json_encode(0);
    }

    public function archivos_mostrar( $proyecto , $tipo )
    {   

        if($tipo == 0){ $result = DB::SELECT("SELECT * FROM archivos WHERE id_proyecto = $proyecto order by created_at desc"); }
        else{
            $result = DB::SELECT("SELECT * FROM archivos WHERE id_proyecto = $proyecto AND id_tipo = $tipo order by created_at desc");
        }

        return [ "resultado" => $result , "url" => url('/') ];
    }
}