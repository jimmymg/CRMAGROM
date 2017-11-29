<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mailgun\Mailgun;
use Pusher\Pusher;


class Fase1Controller extends Controller
{
	public function __construct(){
        $this->middleware('guest');
        
    }
    /*Algun comentario X*/
    public function index()
    {
/*
        $cargo = Auth::user()->id;

        if( Auth::user()->id_area > 1 )
        {   //Solo sus proyectos y los que este involucrado

            $consulta = "SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,
                clientes.`nombre` AS cliente , empresas.`nombre` AS empresa , proyecto_estados.`nombre` AS estado , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                proyectos.`created_at` , proyectos.valor 
                FROM proyectos  
                INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`
                INNER JOIN proyectos_administradores ON proyectos.id = proyectos_administradores.id_proyecto
                WHERE fase = 1 and proyectos_administradores.id_a_cargo = $cargo and proyectos.id_proyecto_Estado = 1
                ORDER BY proyectos.created_at DESC";

                
            //$condicion = "  proyectos.id_usuario == ".$Auth::user()->id;
        }else{
            //Todos Admin
            $consulta = "SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,
                clientes.`nombre` AS cliente , empresas.`nombre` AS empresa , proyecto_estados.`nombre` AS estado , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                proyectos.`created_at` , proyectos.valor
                FROM proyectos  
                INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`
                WHERE fase = 1 and proyectos.id_proyecto_Estado = 1
                ORDER BY proyectos.created_at DESC" ;
        }


    	$proyectos =
    	DB::SELECT($consulta);
        */
    	//return view('Fase1.fase1')->with(["proyectos" => $proyectos , "contador" => 1]);
        return view('Fase1.fase1');
    }

    public function ProyectosIndex()
    {
        $cargo = Auth::user()->id;

        if( Auth::user()->id_area > 1 )
        {   //Solo sus proyectos y los que este involucrado

            $consulta = "SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,
                clientes.`nombre` AS cliente , empresas.`nombre` AS empresa , proyecto_estados.`nombre` AS estado , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                proyectos.`created_at` , proyectos.valor  , 
                DATEDIFF(  DATE(NOW()) , DATE( proyectos.`created_at`) ) AS origen , 
                DATEDIFF(  DATE(NOW()) , DATE(A1.created_at) )  AS ultimo_seguimiento
                FROM proyectos  
                INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`
                INNER JOIN proyectos_administradores ON proyectos.id = proyectos_administradores.id_proyecto

                LEFT JOIN ( SELECT * FROM ( SELECT * FROM seguimientos ORDER BY created_at DESC ) AS A1  GROUP BY A1.id_proyecto ) AS A1 ON A1.id_proyecto = proyectos.`id`

                WHERE fase = 1 and ventas = 0 and proyectos_administradores.id_a_cargo = $cargo and proyectos.id_proyecto_Estado = 1
                ORDER BY proyectos.created_at DESC";

                
            //$condicion = "  proyectos.id_usuario == ".$Auth::user()->id;
        }else{
            //Todos Admin
            $consulta = "SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,
                clientes.`nombre` AS cliente , empresas.`nombre` AS empresa , proyecto_estados.`nombre` AS estado , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                proyectos.`created_at` , proyectos.valor , 
                DATEDIFF(  DATE(NOW()) , DATE( proyectos.`created_at`) ) AS origen , 
                DATEDIFF(  DATE(NOW()) , DATE(A1.created_at) )  AS ultimo_seguimiento
                FROM proyectos  
                INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`

                LEFT JOIN ( SELECT * FROM ( SELECT * FROM seguimientos ORDER BY created_at DESC ) AS A1  GROUP BY A1.id_proyecto ) AS A1 ON A1.id_proyecto = proyectos.`id`

                WHERE fase = 1 and ventas = 0 and proyectos.id_proyecto_Estado = 1
                ORDER BY proyectos.created_at DESC" ;
        }


       
       return DB::SELECT($consulta);
    }

    public function getAdministradores()
    {
    	return DB::SELECT("SELECT * FROM usuarios ");
    }

    public function getCamposGenerales()
    {
    	$resultado = [];

    	$tipos   = DB::SELECT("SELECT * FROM proyecto_tipos");

    	$valores = DB::SELECT("SELECT * FROM moneda");

    	$areas   = DB::SELECT("SELECT * FROM proyecto_areas");

    	$estatus = DB::SELECT("SELECT * FROM proyecto_estados");

    	$fuentes = DB::SELECT("SELECT * FROM fuentes");

    	$resultado = ["tipos" => $tipos , "valores" => $valores , "areas" => $areas , "estatus" => $estatus , "fuentes" => $fuentes ];

    	return $resultado;
    }

    public function insertarProyecto(Request $request)
    {
    	
    	$proyecto        = $request->input("proyecto");
    	$descripcion     = $request->input("descripcion");
    	$cmb_Tipo        = $request->input("cmb_Tipo");
		$cmb_Valor       = $request->input("cmb_Valor");
		$cmb_Area        = $request->input("cmb_Area");
		$arr_marcas      = $request->input("arr_marcas");
		$cliente         = $request->input("cliente");
		$estatus         = $request->input("estatus");
		$fuentes         = $request->input("fuentes");
		$administradores = $request->input("administradores");
        $money           = $request->input("money");

	
		$id_proyecto =
		DB::TABLE("proyectos")->InsertGetId([
				"nombre"             => $proyecto        ,
				"descripcion"        => $descripcion     ,
                "valor"              => str_replace(',', '', $money)          ,
				"id_proyecto_tipo"   => $cmb_Tipo        ,
				"id_moneda"          => $cmb_Valor       ,
				"id_proyecto_area"   => $cmb_Area        ,
				"id_cliente"         => $cliente         ,
				"id_proyecto_estado" => $estatus         ,
				"id_usuario"         => Auth::user()->id ,
				"id_fuente"          => $fuentes         ,
				"fase"               => 1  
			]);

		foreach( $arr_marcas  as $marca)
		{
			DB::TABLE("proyectos_marcas")->Insert([
					"id_proyecto" => $id_proyecto ,
					"id_marca"    => $marca
				]);
		}

        require 'lib/mailgun-php/vendor/autoload.php';
        include 'lib/mailgun-php/src/Mailgun/Mailgun.php';
       
		foreach( $administradores as $admin )
		{
            if( $admin != Auth::user()->id ){
			     DB::TABLE("proyectos_administradores")->Insert([
					"id_proyecto"  => $id_proyecto ,
					"id_a_cargo"   => $admin       ,
					"asignado_por" => Auth::user()->id
				]);

                $usuario = DB::SELECT("SELECT * FROM usuarios WHERE id=".$admin);
                $propietario = DB::SELECT("SELECT * FROM usuarios WHERE id=".Auth::user()->id);
                $to = $usuario[0]->correo;

                $mg = new Mailgun("key-ff8657eb0bb864245bfff77c95c21bef");

                $domain = "omg.com.mx";
                $mg->sendMessage($domain, array('from'  => '<Proyectos@omg.com.mx>',
                                      'to'      => $to,
                                      'subject' => 'Administrador de Nuevo Proyecto',
        'html' => '<h2>Proyecto Nuevo</h2> '.$propietario[0]->nombre.' te agrego a su proyecto: '.$proyecto));
                
                
            }
		}
            //Automaticamente se pone el como administrador

            DB::TABLE("proyectos_administradores")->Insert([
                    "id_proyecto"  => $id_proyecto ,
                    "id_a_cargo"   =>Auth::user()->id ,
                    "asignado_por" => Auth::user()->id
                ]);



    }

    public function verProyecto($proyecto)
    {
    	$elproyecto =
    	DB::SELECT("
    		SELECT proyectos.id , proyectos .nombre , proyectos .descripcion ,
             proyectos.valor , proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , proyecto_areas.`nombre` AS area ,

       			clientes.`nombre` AS cliente , clientes.correo1 , clientes.correo2 , clientes.telefono , clientes.celular , clientes.activo ,

       			 empresas.`nombre` AS empresa , empresas.giro , empresas.direccion , empresas.ciudad , empresas.estado as estado ,

       			 proyecto_estados.`nombre` AS status , usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
       			proyectos.`created_at`
				FROM proyectos  
				INNER JOIN  proyecto_tipos 	ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
				INNER JOIN moneda          	ON proyectos.`id_moneda` = moneda.`id`
				INNER JOIN proyecto_areas  	ON proyectos.`id_proyecto_area` = proyecto_areas.id
				INNER JOIN clientes        	ON proyectos.`id_cliente` = clientes.`id`
				LEFT JOIN empresas        	ON clientes.`id_empresa` = empresas.`id`
				INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
				INNER JOIN usuarios        	ON proyectos.`id_usuario` = usuarios.`id`
				INNER JOIN fuentes         	ON proyectos.`id_fuente` = fuentes.`id`
				WHERE proyectos.id = $proyecto ");

    	$lasmarcas =
    	DB::SELECT("SELECT marcas.`nombre` 
    				FROM proyectos_marcas 
    				INNER JOIN marcas 
    				ON marcas.id=proyectos_marcas.id_marca 
    				WHERE id_proyecto = $proyecto");

    	$losadministradores =
    	DB::SELECT("SELECT usuarios.nombre as asignado FROM proyectos_administradores 
    		INNER JOIN usuarios       ON proyectos_administradores.id_a_cargo = usuarios.id
    		where id_proyecto = $proyecto");

    	$losarchivos = 
    	DB::SELECT("SELECT archivos.id , archivos.ruta , archivos.id_usuario
    	 FROM archivos
    	 WHERE id_proyecto= $proyecto");

    	$losseguimientos =
    	DB::SELECT("SELECT usuarios.nombre , seguimientos.id , seguimientos.seguimiento , seguimientos.via 			, seguimientos.fecha , seguimientos.created_at
    				 FROM seguimientos
    				INNER JOIN usuarios ON usuarios.id = seguimientos.id_usuario
    				where id_proyecto = $proyecto
    				ORDER BY seguimientos.updated_at desc");

    	return [ 	"proyecto" => $elproyecto , 
					"marcas" => $lasmarcas , 
					"administradores" => $losadministradores , 
					"archivos" => $losarchivos , 
					"seguimientos" => $losseguimientos ];
    }

    public function guardarSeguimiento(Request $request)
    {
    	$texto    = $request->input("texto");
    	$fecha    = $request->input("fecha");
    	$via      = $request->input("via");
    	$proyecto = $request->input("proyecto");

    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" => $proyecto ,
    			"id_usuario"  => Auth::user()->id ,
    			"seguimiento" => $texto ,
    			"via"         => $via   ,
    			"fecha"       => $fecha
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
        
            $options = array(
                'cluster' => 'us2',
                'encrypted' => true
              );
              $pusher = new Pusher\Pusher(
                '040c4ec34fd1f7806ba2',
                '0ed5531d6000b88401d2',
                '424479',
                $options
              );
            
            //Enviar por Pusher que comento el usuario, el nombre del proyecto

            $data['message'] = 'hello world';
            $pusher->trigger('canal', 'evento', $data);    

    }

    public function get_comentarios_seguimientos($proyecto)
    {
    	

    	$seguimientos = DB::SELECT("SELECT seguimientos.fecha , seguimientos.seguimiento , seguimientos.via 							, usuarios.nombre , seguimientos.created_at
    	 							FROM seguimientos
    								INNER JOIN usuarios ON usuarios.id = seguimientos.id_usuario
    	 							WHERE id_proyecto = $proyecto
    	 							ORDER BY seguimientos.updated_at desc");

    	return  $seguimientos ;
    }

    public function siguienteFase(Request $request)
    {

    	$proyecto = $request->input("proyecto");

    	DB::TABLE("proyectos")->where("id",$proyecto)->update([
    			"fase" => 2
    		]);

    	$usuario = DB::SELECT("SELECT * FROM usuarios WHERE id = ".Auth::user()->id);
    	//Comentario Automatico
    	DB::TABLE("seguimientos")->insert([
    			"id_proyecto" =>  $proyecto ,
    			"id_usuario"  =>  Auth::user()->id ,
    			"seguimiento" => "Comentario Automatico: ".$usuario[0]->nombre." Cambia a Fase 2"
    		]);

        $data = DB::SELECT("SELECT * FROM proyectos WHERE id=".$proyecto);

            //Tipo 5 son Ventas
        require 'lib/mailgun-php/vendor/autoload.php';
        include 'lib/mailgun-php/src/Mailgun/Mailgun.php';
        if($data[0]->id_proyecto_tipo == 5)
        {
            //Enviar Mensaje a Isayana
            $to = "isayana@omg.com.mx";

                
                $mg = new Mailgun("key-ff8657eb0bb864245bfff77c95c21bef");

                $domain = "omg.com.mx";
                $mg->sendMessage($domain, array('from'  => '<Fase2@omg.com.mx>',
                                      'to'      => $to,
                                      'subject' => 'Cambio a Fase 2',
                                      'html'    => 'Proyecto: '.$data[0]->nombre));

        }else{
            //Enviar Mensaje a Lety lety@omg.com.mx 
            $to = "lety@omg.com.mx";
            $domain = "omg.com.mx";
                
                $mg = new Mailgun("key-ff8657eb0bb864245bfff77c95c21bef");

                $domain = "omg.com.mx";
                $mg->sendMessage($domain, array('from'  => '<Fase2@omg.com.mx>',
                                      'to'      => $to,
                                      'subject' => 'Cambio a Fase 2',
                                      'html'    => 'Proyecto: '.$data[0]->nombre));

        }

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

    public function proyectosEnProceso()
    {   
        $estado = 1;
        $proyectosEnProceso = $this->getProyectosEstados(0 , $estado);
       
        $limitless = count($this->getProyectosEstados(-1 , $estado));
        
           
       return view('Fase1.proyectos')->with([ 
            "proyectos" => $proyectosEnProceso , 
            "pivote"    => 0 ,
            "cantidad"  => $limitless ,
            "limitless" => ceil($limitless / 6)]);
    }

    public function proyectosEnEspera()
    {   
        $estado = 2;
        $proyectosEnEspera = $this->getProyectosEstados(0 , $estado);
       
        $limitless = count($this->getProyectosEstados(-1 , $estado));
        
           
       return view('Fase1.proyectosStandBy')->with([ 
            "proyectos" => $proyectosEnEspera , 
            "pivote" => 0 ,
            "cantidad" => $limitless ,
            "limitless" => ceil($limitless / 6)]);
    }

    public function getProyectosEstados( $pivote , $estado)
    {    
        $cargo = Auth::user()->id;
        $inner = "  ";
        $condicion = "  ";
        if( Auth::user()->id_area > 1 )
        {
           $condicion = ' and proyectos_administradores.id_a_cargo = '.$cargo;
           $inner     = ' INNER JOIN proyectos_administradores ON proyectos.id = proyectos_administradores.id_proyecto ';
        }
       
         $consulta = '
                        SELECT proyectos.id , proyectos .nombre , proyectos .descripcion , 
                        proyecto_tipos.`nombre` AS tipo , moneda.`nombre` AS moneda , 
                        proyecto_areas.`nombre` AS area , clientes.`nombre` AS cliente ,  clientes.id as IDCLIENTE ,
                        empresas.`nombre` AS empresa , empresas.id as IDEMPRESA , proyecto_estados.`nombre` AS estado , 
                        usuarios.`nombre` AS usuario , fuentes.`nombre` AS fuente ,
                        proyectos.`created_at` , proyectos.fase , anticipo_c.fecha_pago as a_c , anticipo_p.fecha_pago as a_p
                        FROM proyectos  
                        INNER JOIN  proyecto_tipos  ON proyectos.`id_proyecto_tipo` = proyecto_tipos.`id`
                        INNER JOIN moneda           ON proyectos.`id_moneda` = moneda.`id`
                        INNER JOIN proyecto_areas   ON proyectos.`id_proyecto_area` = proyecto_areas.id
                        INNER JOIN clientes         ON proyectos.`id_cliente` = clientes.`id`
                        LEFT JOIN empresas          ON clientes.`id_empresa` = empresas.`id`
                        INNER JOIN proyecto_estados ON proyectos.`id_proyecto_estado` = proyecto_estados.`id`
                        INNER JOIN usuarios         ON proyectos.`id_usuario` = usuarios.`id`
                        INNER JOIN fuentes          ON proyectos.`id_fuente` = fuentes.`id`
                        
                        '.$inner.'

                        LEFT JOIN anticipo as anticipo_c 
                        ON anticipo_c.id_proyecto = proyectos.id AND anticipo_c.tipo = 1
                        LEFT JOIN anticipo as anticipo_p 
                        ON anticipo_p.id_proyecto = proyectos.id AND anticipo_p.tipo = 2

                        WHERE fase > 1  '.$condicion.'  and id_proyecto_estado = '.$estado.' 
                        ORDER BY proyectos.created_at DESC';

        if(  $pivote >= 0 )
        {   
            $consulta .= ' LIMIT '.$pivote.',6';
        }

        
        return DB::SELECT($consulta);
        
    }

    public function informacionCliente($cliente)
    {
        return DB::SELECT('SELECT * FROM clientes WHERE id = '.$cliente);
    }

    public function  informacionEmpresa($empresa)
    {
        return DB::SELECT('SELECT * FROM empresas WHERE id = '.$empresa);
    }

    public function getProyectoArchivos($proyecto)
    {   
        $Fase1 =
        DB::SELECT('SELECT * FROM archivos WHERE id_proyecto = '.$proyecto.' AND ( id_tipo = 1 OR id_tipo = 2 OR id_tipo = 3 OR id_tipo = 4 ) ORDER BY id_tipo,created_at DESC');
        $Fase2 =
        DB::SELECT('SELECT * FROM archivos WHERE id_proyecto = '.$proyecto.' AND ( id_tipo = 5 OR id_tipo = 6 ) ORDER BY id_tipo,created_at DESC');
        $Fase3 =
        DB::SELECT('SELECT * FROM archivos WHERE id_proyecto = '.$proyecto.' AND ( id_tipo = 7  OR id_tipo = 8  OR id_tipo = 9 ) ORDER BY id_tipo,created_at DESC');
        $Fase5 =
        DB::SELECT('SELECT * FROM archivos WHERE id_proyecto = '.$proyecto.' AND ( id_tipo = 10  OR id_tipo = 11  OR id_tipo = 12 ) ORDER BY id_tipo,created_at DESC');
        $Fase6 =
        DB::SELECT('SELECT * FROM archivos WHERE id_proyecto = '.$proyecto.' AND ( id_tipo = 13 ) ORDER BY id_tipo,created_at DESC');
        //Fase 4 y 7 no llevan archivos
        return ["fase1" => $Fase1 , "fase2" => $Fase2  , 
                "fase3" => $Fase3 , "fase5" => $Fase5  , 
                "fase6" => $Fase6   ];

    }

    public function get_Alls_Seguimientos_Comentarios($proyecto)
    {
        return DB::SELECT('SELECT seguimientos.id , seguimientos.seguimiento , seguimientos.via , seguimientos.fecha , seguimientos.cancelado , seguimientos.created_at , seguimientos.updated_at , usuarios.nombre  FROM seguimientos 
                            INNER JOIN usuarios ON usuarios.id=seguimientos.id_usuario
                            WHERE id_proyecto = '.$proyecto.' ORDER BY seguimientos.created_at DESC ');
    }

    public function get_all_the_information($proyecto)
    {   /*Proyecto | Marcas | Administradores Tipo Area Fuente */
        $proyectoinfo = 
        DB::SELECT("SELECT proyectos.id , proyectos.nombre , proyectos.descripcion , 
                    proyecto_tipos.nombre as tipo , proyecto_areas.nombre as area , 
                    fuentes.nombre as fuente , proyectos.valor
                    FROM proyectos
                    INNER JOIN proyecto_tipos ON proyectos.id_proyecto_tipo = proyecto_tipos.id 
                    INNER JOIN proyecto_areas ON proyectos.id_proyecto_area = proyecto_areas.id
                    INNER JOIN fuentes ON proyectos.id_fuente = fuentes.id
                    WHERE proyectos.id=".$proyecto);
        $marcas  = DB::SELECT("SELECT marcas.nombre FROM proyectos_marcas 
                    INNER JOIN marcas ON marcas.id = proyectos_marcas.id_marca
                    WHERE proyectos_marcas.id_proyecto = ".$proyecto);

        $administradores =
        DB::SELECT("SELECT usuarios.nombre FROM proyectos_administradores
                    INNER JOIN usuarios ON usuarios.id = proyectos_administradores.id_a_cargo
                    WHERE proyectos_administradores.id_proyecto = ".$proyecto);

        $Fase1 = [ "proyecto" => $proyectoinfo , "marcas" => $marcas , "administradores" => $administradores ];

        ////////////////////////////////////////////////////////////////////////////////////////////////////
        $Fase2 = DB::SELECT("SELECT * FROM anticipo WHERE id_proyecto=".$proyecto);
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        $Fase4 = DB::SELECT(" SELECT * FROM logistica WHERE id_proyecto=".$proyecto);

        $Fase6 = DB::SELECT(" SELECT usuarios.nombre , visitas.id , visitas.fecha , visitas.ciudad , visitas.estado FROM visitas 
            INNER JOIN usuarios ON usuarios.id = visitas.id_usuario
            WHERE id_proyecto = ".$proyecto);

        $Fase7 = DB::SELECT("SELECT * FROM pregunta_respuesta WHERE id_proyecto=".$proyecto);

        return [ "fase1" => $Fase1 , "fase2" => $Fase2 , "fase4" => $Fase4 , "fase6" => $Fase6 , "fase7" => $Fase7 ];
    }

    public function cambiarEstadoProyecto(Request $request)
    {
        $proyecto    = $request->input('proyecto');
        $nuevoEstado = $request->input('nuevoEstado');

        DB::TABLE('proyectos')->where("id",$proyecto)->update([
                "id_proyecto_estado" => $nuevoEstado
            ]);
    }

    public function AgendarRecordatorio(Request $request)
    {
        $proyecto     = $request->input('proyecto');

        $via          = $request->input('via');

        $fecha        = $request->input('fecha');

        $recordatorio = $request->input('recordatorio');

        $date = explode(" ",$fecha);
        //2017-06-23 14:14:14
        //echo $date[1];
        $data = $date[2]."-".$this->mes($date[1])."-".$date[0]." ".$date[4].":00"; 
       
        DB::TABLE('agenda')->INSERT([
                "id_usuario"   => Auth::user()->id  ,
                "id_proyecto"  => $proyecto         ,
                "recordatorio" => $recordatorio     ,
                "via"          => $via              ,
                "fecha"        => $data
            ]);
/* Las Cosas del chapaneco rodrigo
        $name=$_POST['titulo'];
        $begin=$_POST['fechainicio'];
        $horainicio=$_POST['horainicio'];
        $start=strtotime($begin." ".$horainicio);
        $end=$_POST['fechafin'];
        $horafin=$_POST['horafin'];
        $end=strtotime($end." ".$horafin);
        $location=$_POST['ubicacion'];
        $details=$_POST['descripcion'];
        $t = new DateTime('@' . $start, new DateTimeZone('UTC'));
        $t2=new DateTime('@' . $end, new DateTimeZone('UTC'));

        $url = 'https://www.google.com/calendar/render?action=TEMPLATE&text='.$name;
        $url.='&dates='.$t->format('Ymd\THi00\Z')."/".$t2->format('Ymd\THi00\Z');
        $url.='&details='.$details;
        $url.='&location='.$location;
        $url.='&sf=true&output=xml';

        header("Location:".$url);
        */
    }

    function mes($cadena)
    {   
        switch ($cadena) {
            case 'Enero':
                return 01;
                break;
            case 'Febrero':
                return 02;
                break;
            case 'Marzo':
                return 03;
                break;
            case 'Abril':
                return 04;
                break;
            case 'Mayo':
                return 05;
                break;
            case 'Junio':
                return 06;
                break;
            case 'Julio':
                return 07;
                break;
            case 'Agosto':
                return '08';
                break;
            case 'Septiembre':
                return '09';
                break;
            case 'Octubre':
                return '10';
                break;
            case 'Noviembre':
                return '11';
                break;
            case 'Diciembre':
                    return '12';
                break;
            
        }
    }

    public function clientesEmpresa($proyecto)
    {
        /*Recordar que no se tiene la empresa a si que se hara una consulta para*/
        //Encontrar la empresa y consultar los clientes que pertenecen a dicha empresa

        $empresa = 
        DB::SELECT("SELECT proyectos.id_cliente , clientes.id_empresa 
            FROM proyectos 
            INNER JOIN clientes ON clientes.id = proyectos.id_cliente
            WHERE proyectos.id = $proyecto ");

        $clientes = 
        DB::SELECT("SELECT * FROM clientes WHERE id_empresa = ". $empresa[0]->id_empresa  );

        return $clientes;
    }

    public function nuevoContacto(Request $request)
    {
        $proyecto = $request->input('proyecto');
        $cliente  = $request->input('cliente');

        $validar = DB::SELECT('SELECT * FROM proyectos WHERE id = '.$proyecto);

        $contactos = DB::SELECT('SELECT * FROM contactos_extra WHERE id_proyecto ='.$proyecto.' AND id_cliente =  '.$cliente);

        if( $validar[0]->id_cliente != $cliente  AND empty($contactos) ) 
        {
            DB::TABLE('contactos_extra')->INSERT([
                'id_proyecto' => $proyecto        ,
                'id_cliente'  => $cliente         ,
                'id_usuario'  => Auth::user()->id
            ]);
        }else{
            return "error";
        }

    }

    public function ContactosExtras($proyecto)
    {
        
        $contactos = DB::SELECT("SELECT clientes.id , clientes.nombre , clientes.correo1 , clientes.correo2 , clientes.telefono , clientes.celular , clientes.activo 
            FROM contactos_extra
            INNER JOIN clientes ON clientes.id = contactos_extra.id_cliente 
            WHERE id_proyecto = ".$proyecto);
       
        return $contactos;  

    }

    public function guardarConfiguracion(Request $request)
    {
        $stock                =  $request->input('stock'); 
        $contado_proveedor    =  $request->input('contado_proveedor');  
        $anticipo_proveedor   =  $request->input('anticipo_proveedor'); 
        $importacion          =  $request->input('importacion');  
        $flete                =  $request->input('flete');  
        $paqueteria           =  $request->input('paqueteria');  
        $linea_transportista  =  $request->input('linea_transportista');  
        $proyecto             =  $request->input('proyecto');
       
        $validar = DB::SELECT("SELECT * FROM configuracion WHERE id_proyecto = ".$proyecto);
        if( !empty($validar) )
        {
            return "validar";
        }
        ///////////////////////////////////////////////////////////////////////
        $validar_cotizacion = DB::SELECT("SELECT * FROM archivos 
        WHERE id_proyecto = $proyecto 
        AND id_tipo = 1");

        $validar_odrden_c_cliente = DB::SELECT("SELECT * FROM archivos 
        WHERE id_proyecto = $proyecto 
        AND id_tipo = 2");

        if( empty($validar_cotizacion) || empty($validar_odrden_c_cliente) )
        {
            if( empty( $validar_cotizacion ) ){ return "archivo1"; }
            if( empty( $validar_odrden_c_cliente ) ){ return "archivo2"; }
        }
        
        ///////////////////////////////////////////////////////////////////////////

        DB::TABLE("proyectos")->WHERE("id", $proyecto )->UPDATE([
            "ventas" => 1
        ]);
        DB::TABLE("configuracion")->INSERT([
            "stock"                 => $stock ,
            "contado_proveedor"     => $contado_proveedor,
            "anticipo_proveedor"    => $anticipo_proveedor,
            "importacion"           => $importacion,
            "flete"                 => $flete,
            "paqueteria"            => $paqueteria,
            "linea_transportista"   => $linea_transportista,
            "id_proyecto"           => $proyecto
        ]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////
    //////Editar

    public function editarProyecto(Request $request)
    {
       $campo    = $request->input('campo'); 
       $proyecto = $request->input('proyecto');
       $nuevo    = $request->input('nuevo'); 

       switch ($campo) {
            case 'NOMBRE':
               # code...
                DB::TABLE('proyectos')->WHERE('id',$proyecto)->UPDATE([
                        'nombre' => $nuevo
                    ]);
                break;
           
            case 'DESCRIPCION':
               # code...
                DB::TABLE('proyectos')->WHERE('id',$proyecto)->UPDATE([
                        'descripcion' => $nuevo
                    ]);
               break;

            case 'VALOR':
               # code...
                DB::TABLE('proyectos')->WHERE('id',$proyecto)->UPDATE([
                        'valor' => $nuevo
                    ]);
               break;

            case 'value':
               # code...
               break;
       }
    }

}