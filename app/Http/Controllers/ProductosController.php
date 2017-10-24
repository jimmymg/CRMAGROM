<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ProductosController extends Controller
{
    //

    public function index()
    {
    	return view('Productos.index');
    }

    public function consultaProductos()
    {
    	return DB::SELECT('SELECT * FROM producto ORDER BY id DESC');
    }
}
