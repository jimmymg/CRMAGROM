<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class Fase3Controller extends Controller
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
       			proyectos.`created_at`  , remision
				FROM proyectos  
				INNER JOIN  proyecto_tipos 	ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
				INNER JOIN moneda          	ON proyectos.`id_moneda` = moneda.`id`
				INNER JOIN proyecto_areas  	ON proyectos.`id_proyecto_area` = proyecto_areas.id
				INNER JOIN clientes        	ON proyectos.`id_cliente` = clientes.`id`
				LEFT JOIN empresas        	ON clientes.`id_empresa` = empresas.`id`
				INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
				INNER JOIN usuarios        	ON proyectos.`id_usuario` = usuarios.`id`
				INNER JOIN fuentes         	ON proyectos.`id_fuente` = fuentes.`id`
				WHERE fase = 3
				ORDER BY proyectos.created_at DESC
    		");
    	return view('Fase3.Fase3')->with(["proyectos" => $proyectos , "contador" => 1]);
    }

    public function verProyecto($proyecto)
    {
    	$administradores = 
    	DB::SELECT("SELECT usuarios.nombre FROM proyectos_administradores
    				INNER JOIN usuarios ON usuarios.id =  proyectos_administradores.id_a_cargo
    				WHERE id_proyecto = $proyecto");

    	$anticipo_cliente = 
    	DB::SELECT("SELECT * FROM anticipo WHERE id_proyecto = $proyecto and tipo = 1");
        $anticipo_proveedor =
        DB::SELECT("SELECT * FROM anticipo WHERE id_proyecto = $proyecto and tipo = 2");

        $elproyecto =
        DB::SELECT("
                SELECT proyectos.id , proyectos.nombre , proyectos.descripcion , proyectos.contado_cliente , proyectos.contado_proveedor , proyectos.en_stock , proyectos.pedido ,
                proyectos.valor , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,

                clientes.`nombre` AS cliente , clientes.correo1 , clientes.correo2 , clientes.telefono , clientes.celular , clientes.activo ,

                 empresas.`nombre` AS empresa , empresas.giro , empresas.direccion , empresas.ciudad , empresas.estado as estado ,

                 proyecto_estados.`nombre` AS status , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                proyectos.`created_at` , contado_cliente , contado_proveedor , en_stock , remision

                FROM proyectos  
                INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`
                WHERE proyectos.id = $proyecto ");

    	return [ "administradores" => $administradores , "anticipo_cliente" => $anticipo_cliente , "anticipo_proveedor" => $anticipo_proveedor , "proyecto" => $elproyecto , "user" => Auth::user()->id ];
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

    public function siguienteFase(Request $Request)
    {
    	 $proyecto = $Request->input('proyecto');
         $factura = $Request->input('factura');


    	 $usuario = DB::SELECT("SELECT * FROM usuarios WHERE id = ".Auth::user()->id);
    	
         $info = DB::SELECT("SELECT * FROM proyectos WHERE id = ".$proyecto);
         //print_r($info);
         $contado_cliente = $info[0]->contado_cliente;
         //$contado_proveedor = $info[0]->contado_proveedor;

         $en_stock = $info[0]->en_stock;

         if( $en_stock == 0 )
         {
           // return "etro";
            $validar = DB::SELECT("SELECT * FROM archivos WHERE id_tipo = 9 AND id_proyecto=".$proyecto);
          
           
            if( empty($validar) )
            {
                return "error";
            
            }
            
         }
    
         if($contado_cliente == 1)
         {
            //Quiere decir que la factura se guardara en el proyecto
            DB::TABLE('proyectos')->WHERE('id',$proyecto)->UPDATE([
                    "factura" => $factura
                ]);
         }else{
            //quiere decir que la factura se guardara en el anticipo cliente
            $anticipo = DB::SELECT("SELECT * FROM anticipo WHERE tipo = 1 AND id_proyecto=".$proyecto);
            DB::TABLE('proyectos')->WHERE('id',$anticipo[0]->id)->UPDATE([
                    "factura" =>$factura
                ]);
         }

        //Comentario Automatico
    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "Comentario Automatico: ".$usuario[0]->nombre." Cambia a Fase 4"
    		]);

    	DB::TABLE("proyectos")->where("id",$proyecto)->update([
    			"fase" => 4
    		]);
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

        $ext    = explode(".", $name);
        $cantidad = count($ext);
        $b      = getcwd();

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