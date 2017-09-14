<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class Fase2Controller extends Controller
{
	public function __construct(){
        $this->middleware('guest');
       
    }

    public function index()
    {   
        $condicion = "";
        //Si no es ni 3 ni 4 es un SUPER USUARIO
        // 3 Ventas y 4 Servicios EN LAS AREAS
        // 5 VENTAS Y 6 sERVICIOS EN LA TABLA DE PROYECTOS TIPOS
        
        if( Auth::user()->id_area == 3 )
        {
            $condicion = " AND id_proyecto_tipo = 5 ";
           // $condicion   = " AND proyectos_administradores.id_acargo = ".Auth::user()->id;
        }

        if( Auth::user()->id_area == 4 )
        {
            $condicion = " AND id_proyecto_tipo = 6 ";
           // $condicion = " AND proyectos_administradores.id_acargo = ".Auth::user()->id;
        }
/*INNER JOIN proyectos_administradores ON proyectos_administradores.id_proyecto = proyectos.id GROUP BY proyectos.id*/
    	$proyectos =
    	DB::SELECT("
    		SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,
       			clientes.`nombre` AS cliente , empresas.`nombre` AS empresa , proyecto_estados.`nombre` AS estado , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
       			proyectos.`created_at` , proyectos.valor 
				FROM proyectos  
				INNER JOIN  proyecto_tipos 	ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
				INNER JOIN moneda          	ON proyectos.`id_moneda` = moneda.`id`
				INNER JOIN proyecto_areas  	ON proyectos.`id_proyecto_area` = proyecto_areas.id
				INNER JOIN clientes        	ON proyectos.`id_cliente` = clientes.`id`
				LEFT JOIN empresas        	ON clientes.`id_empresa` = empresas.`id`
				INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
				INNER JOIN usuarios        	ON proyectos.`id_usuario` = usuarios.`id`
				INNER JOIN fuentes         	ON proyectos.`id_fuente` = fuentes.`id`

				WHERE fase = 2 and proyectos.id_proyecto_Estado = 1 ".$condicion."
				ORDER BY proyectos.created_at DESC 
    		");

    	return view('Fase2.Fase2')->with(["proyectos" => $proyectos , "contador" => 1 ]);
    }

    public function siguienteFase(Request $Request)
    {
    	$cliente                 = $Request->input('cliente');
        $cliente_total           = $Request->input('cliente_total');
        $cliente_abono           = $Request->input('cliente_abono'); 
        $cliente_pendiente       = $Request->input('cliente_pendiente'); 
        $cliente_fecha_de_pago   = $Request->input('cliente_fecha_de_pago'); 
        $cliente_comentario      = $Request->input('cliente_comentario'); 
        $proveedor               = $Request->input('proveedor'); 
        $proveedor_total         = $Request->input('proveedor_total'); 
        $proveedor_abono         = $Request->input('proveedor_abono'); 
        $proveedor_pendiente     = $Request->input('proveedor_pendiente'); 
        $proveedor_fecha_de_pago = $Request->input('proveedor_fecha_de_pago'); 
        $proveedor_comentario    = $Request->input('proveedor_comentario'); 

        $proyecto                = $Request->input('proyecto');
        $numero_admin            = $Request->input('numero_admin');

        $contado_cliente         = $Request->input('contado_cliente');
        $contado_provedor       = $Request->input('contado_proveedor');
        $en_stock                = $Request->input('en_stock');

        echo $contado_cliente;
        echo $contado_provedor;
        echo $en_stock;
        //return 0;
        //if( $cliente == false and $proveedor == false ){ return "Error Campos Vacios"; }


    	$usuario = DB::SELECT("SELECT * FROM usuarios WHERE id = ".Auth::user()->id);
    	//Comentario Automatico
    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "Comentario Automatico: ".$usuario[0]->nombre." Cambia a Fase 3"
    		]);

        if( $cliente == 1 )
        {
        	DB::TABLE("anticipo")->insert([
        			"id_proyecto"  => $proyecto ,
        			"tipo"         => 1 ,
        			"monto_total"  => $cliente_total ,
        			"abono"        => $cliente_abono ,
        			"pendiente"    => $cliente_pendiente ,
        			"fecha_pago"   => $cliente_fecha_de_pago ,
        			"acuerdo_pago" => $cliente_comentario
        		]);

        	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "FASE 2: Anticipo Cliente ".$cliente_comentario
    		]);

        }
        if( $proveedor == 1 )
        {
        	DB::TABLE("anticipo")->insert([
        			"id_proyecto"  => $proyecto ,
        			"tipo"         => 2 ,
        			"monto_total"  => $proveedor_total ,
        			"abono"        => $proveedor_abono ,
        			"pendiente"    => $proveedor_pendiente ,
        			"fecha_pago"   => $proveedor_fecha_de_pago ,
        			"acuerdo_pago" => $proveedor_comentario 
        		]);

        	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "FASE 2: Anticipo Proveedor ".$proveedor_comentario
    		]);
        }
 
            DB::TABLE("proyectos")->WHERE("id",$proyecto)->UPDATE([
                    "contado_cliente"   => $contado_cliente ,
                    "contado_proveedor" =>  $contado_provedor ,
                    "en_stock"          => $en_stock ,
                    "pedido"            => $numero_admin ,
                    "fase"              => 3
                ]);
        
    }

    public function verProyecto($proyecto)
    {
    	$administradores = 
    	DB::SELECT("SELECT usuarios.nombre FROM proyectos_administradores
    				INNER JOIN usuarios ON usuarios.id =  proyectos_administradores.id_a_cargo
    				WHERE id_proyecto = $proyecto");

        $elproyecto =
        DB::SELECT("
            SELECT proyectos.id , proyectos .nombre , proyectos .descripcion ,
             proyectos.valor , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,

                clientes.`nombre` AS cliente , clientes.correo1 , clientes.correo2 , clientes.telefono , clientes.celular , clientes.activo ,

                 empresas.`nombre` AS empresa , empresas.giro , empresas.direccion , empresas.ciudad , empresas.estado as estado ,

                 proyecto_estados.`nombre` AS status , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                proyectos.`created_at`
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

    	return [ "administradores" => $administradores , "proyecto" => $elproyecto ];
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


