<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class MarcasController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
       
    }

    public function index()
    {
    	return view('Marcas.Marcas');
    }

    public function getMarcas()
    {
    	return DB::select("SELECT * FROM marcas");
    }

    public function insertarMarca(Request $request)
    {
    	$marca  = $request->input("marca");

    	DB::table("marcas")->insert([
    			"nombre" => $marca
    		]);
    }
}