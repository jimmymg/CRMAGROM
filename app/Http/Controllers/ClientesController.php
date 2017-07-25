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
    	return DB::select("SELECT clientes.id , clientes.nombre , clientes.correo1 , clientes.correo2 , clientes.telefono , clientes.celular , empresas.nombre as empresa , empresas.giro, empresas.direccion , empresas.ciudad , empresas.estado , clientes.created_at
    						FROM clientes
    						LEFT JOIN empresas ON empresas.id = clientes.id_empresa
    						ORDER BY created_at desc");
    }



    public function insertarCliente(Request $request)
    {
    	$nombre     = $request->input('nombre');
    	$correo1    = $request->input('correo1');
    	$correo2    = $request->input('correo2');
    	$telefono   = $request->input('telefono');
    	$celular    = $request->input('celular');
    	$id_empresa = $request->input('id_empresa');
    	
    	if( $id_empresa == 0 )
    	{ 
    		$id_empresa = null; 
    	}
    	
    	DB::table("clientes")->insert([
    			"id_empresa" => $id_empresa ,
    			"nombre"     => $nombre     ,
    			"correo1"    => $correo1    ,
    			"correo2"    => $correo2    ,
    			"telefono"   => $telefono   ,
    			"celular"    => $celular
    		]);
    		
    }

}