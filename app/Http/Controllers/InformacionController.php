<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mailgun\Mailgun;


class InformacionController extends Controller
{
	public function __construct(){
        $this->middleware('guest');
        
    }

    public function Fase1($proyecto)
    {	
    	return DB::SELECT('SELECT * FROM proyectos WHERE id = '.$proyecto);
    }
}