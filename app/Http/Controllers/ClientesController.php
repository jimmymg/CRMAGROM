<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class ClientesController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
    }

    public function index()
    {
    	return view('Clientes.clientes');
    }

    public function getClientes()
    {
    	return DB::select("SELECT clientes.id , clientes.nombre , clientes.cargo ,clientes.correo1 , clientes.correo2 , clientes.telefono , clientes.celular , empresas.nombre as empresa , empresas.giro, empresas.direccion , empresas.ciudad , empresas.estado , clientes.created_at , CB.nombre as created_by , UB.nombre as updated_by
    						FROM clientes
    						LEFT JOIN empresas ON empresas.id = clientes.id_empresa
                            left join usuarios as CB on clientes.created_by = CB.id
                            left join usuarios UB on clientes.updated_by = UB.id
    						ORDER BY created_at desc");
    }

    public function getCliente($cliente)
    {
        return DB::SELECT('SELECT clientes.id , clientes.nombre , clientes.cargo ,clientes.correo1 , clientes.correo2 , clientes.telefono, clientes.celular , empresas.id as id_empresa , empresas.nombre as empresa , empresas.giro, empresas.direccion , empresas.ciudad ,                     empresas.estado , clientes.created_at
                            FROM clientes
                            LEFT JOIN empresas ON empresas.id = clientes.id_empresa
                        
                            WHERE clientes.id='.$cliente);
    }



    public function insertarCliente(Request $request)
    {
    	$nombre     = $request->input('nombre');
        $cargo      = $request->input('cargo');
    	$correo1    = $request->input('correo1');
    	$correo2    = $request->input('correo2');
    	$telefono   = $request->input('telefono');
    	$celular    = $request->input('celular');
    	$id_empresa = $request->input('id_empresa');
    	
    	if( $id_empresa == 0 )
    	{ 
    		$id_empresa = null; 
    	}
    	
        if( empty($correo2) ){
            $correo2 = 'N/A';
        }

    	DB::table("clientes")->insert([
    			"id_empresa" => $id_empresa ,
                "cargo"      => $cargo      ,
    			"nombre"     => $nombre     ,
    			"correo1"    => $correo1    ,
    			"correo2"    => $correo2    ,
    			"telefono"   => $telefono   ,
    			"celular"    => $celular    ,
                "created_by" => Auth::user()->id
    		]);
    		
    }

    public function actualizarCliente(Request $request)
    {
        $cliente    = $request->input('cliente');
        $nombre     = $request->input('nombre');
        $cargo      = $request->input('cargo');
        $correo     = $request->input('correo');
        $correoA    = $request->input('correoA');
        $telefono   = $request->input('telefono');
        $celular    = $request->input('celular');
        $empresa    = $request->input('empresa');

        DB::TABLE("clientes")->WHERE("id",$cliente)->UPDATE([
                "id_empresa" => $empresa ,
                "nombre"     => $nombre  ,
                "cargo"      => $cargo   ,
                "correo1"    => $correo  ,
                "correo2"    => $correoA ,
                "telefono"   => $telefono ,
                "celular"    => $celular ,
                "updated_by" => Auth::user()->id
            ]);


    }

}