<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class UsuariosController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
       
    }

    public function index()
    {   
        $resultado = DB::SELECT("SELECT usuarios.id , usuarios.usuario , usuarios.nombre , usuarios.correo ,                usuarios_areas.area  FROM usuarios
                                INNER JOIN usuarios_areas ON usuarios.id_area = usuarios_areas.id 
                               ");

    	return view('Usuarios.usuarios')->with(["usuarios" => $resultado , "contador" => 1]);
    }
  
    public function insertarUsuario (Request $request)
    {   

        $usuario = $request->input("usuario");
        $nombre = $request->input("nombre");
        $password = $request->input("password");
        $correo = $request->input("correo");
        $area = $request->input("area");

        DB::table('usuarios')->insert([
            'usuario'  => $usuario,
            'nombre'   => $nombre,
            'password' => Hash::make($password),
            'correo'   => $correo ,
            'id_area'  => $area
            ]);

    }


}