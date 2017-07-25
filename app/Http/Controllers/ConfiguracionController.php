<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class ConfiguracionController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
    }

    public function index()
    {
    	return view('configuracion.configuracion');
    }

    public function getTipos()
    {
    	return DB::select("SELECT * FROM proyecto_tipos");
    }

    public function insertarTipo(Request $request)
    {	
    	$tipo = $request->input("tipo");

    	$validar = DB::select("SELECT * from proyecto_tipos WHERE nombre LIKE '%$tipo%' ");

    	if( !empty($validar) )
    	{
    		return 1;
    	}

    	DB::table("proyecto_tipos")->insert([
    			"nombre" => $tipo
    		]);
    }

    public function getAreas()
    {
    	return DB::select("SELECT * FROM proyecto_areas");
    }

    public function insertarArea(Request $request)
    {
    	$area = $request->input("area");

    	$validar = DB::select("SELECT * from proyecto_areas WHERE nombre LIKE '%$area%' ");
    	if( !empty($validar) )
    	{
    		return 1;
    	}
    	DB::table("proyecto_areas")->insert([
    			"nombre" => $area
    		]);
    }

    public function getEstados()
    {
    	return DB::select("SELECT * FROM proyecto_estados");
    }

    public function insertarEstado(Request $request)
    {
    	$estado = $request->input("estado");

    	$validar = DB::select("SELECT * from proyecto_estados WHERE nombre LIKE '%$estado%' ");
    	if( !empty($validar) )
    	{
    		return 1;
    	}
    	DB::table("proyecto_estados")->insert([
    			"nombre" => $estado
    		]);
    }

    public function getFuentes()
    {
    	return DB::select("SELECT * FROM fuentes");
    }

    public function insertarFuente(Request $request)
    {
    	$fuente = $request->input("fuente");
    	$validar = DB::select("SELECT * from fuentes WHERE nombre LIKE '%$fuente%' ");
    	if( !empty($validar) )
    	{
    		return 1;
    	}
    	DB::table("fuentes")->insert([
    			"nombre" => $fuente
    		]);
    }

    public function getMonedas()
    {
    	return DB::select('SELECT *FROM moneda');
    }

    public function insertarMoneda(Request $request)
    {
    	$moneda = $request->input('moneda');

    	DB::table("moneda")->insert([
    			"nombre" => $moneda
    		]);
    }

    
}