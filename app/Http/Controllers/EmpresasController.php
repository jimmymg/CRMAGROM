<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class EmpresasController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
    }

    public function index()
    {
    	return view("Empresas.Empresas");
    }

    public function getEmpresas()
    {
    	return DB::select("SELECT * FROM empresas");
    }

    public function insertarEmpresa(Request $request)
    {
    	$nombre    = $request->input("nombre");
    	$giro      = $request->input("giro");
    	$direccion = $request->input("direccion");
    	$ciudad    = $request->input("ciudad");
        $estado    = $request->input('estado');

    	DB::table("empresas")->insert([
    			"nombre"    => $nombre    ,
    			"giro"      => $giro      ,
    			"direccion" => $direccion ,
    			"ciudad"    => $ciudad    ,
                "estado"    => $estado
    		]);
    }

    public function editarEmpresa(Request $request)
    {
        $nombre    = $request->input("nombre");
        $giro      = $request->input("giro");
        $direccion = $request->input("direccion");
        $ciudad    = $request->input("ciudad");
        $estado    = $request->input('estado');
        $empresa   = $request->input('empresa');

        echo $nombre;
        echo $estado;
        echo $empresa;
        print_r($_POST);
        return "asdasd";
        DB::table("empresas")->where('id',$empresa)->update([
                "nombre"    => $nombre    ,
                "giro"      => $giro      ,
                "direccion" => $direccion ,
                "ciudad"    => $ciudad    ,
                "estado"    => $estado
            ]);
    }


    public function getEmpresa($empresa)
    {
        return DB::SELECT("SELECT * FROM empresas WHERE id = ".$empresa);
    }

}