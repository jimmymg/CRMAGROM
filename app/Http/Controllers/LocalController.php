<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mailgun\Mailgun;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
    	return view('local.facturas');
    }

    public function get_Facturas($opcion , $valor , $mes , $anio)
    {	//http://172.16.200.249/OhMyREST/vfp/agro/cliente/codigo/11492

    	$url = "http://172.16.200.249/OhMyREST/vfp/agro/cliente/".$valor."/mes/".$mes."/anio/".$anio;

    	if( $opcion == "codigo" )
    	{
    		ini_set('max_execution_time', 180); //3 minutes
    		$url = "http://172.16.200.249/OhMyREST/vfp/agro/cliente/codigo/".$valor;
    	}

    	$data = file_get_contents($url);
    	$info = json_decode($data,true);


    	$result = [];
        $index_clientes = [];
        for($x = 0 ; $x < count($info) ; $x++)
        {
            if( !in_array($info[$x]['codigo_cliente'] , $index_clientes ) )
            {
                array_push($result , [
                        "codigo" => $info[$x]['codigo_cliente'] ,
                        "razon_social" => $info[$x]['razon_social'] ,
                        "rfc" => $info[$x]['rfc'] ,
                        "facturas" => array()
                    ]);

                array_push($index_clientes, $info[$x]['codigo_cliente']);
            }
        }

        $movimientos = [];

        for( $x = 0 ; $x < count($info) ; $x++ )
        {
            $key = array_search($info[$x]['codigo_cliente'],$index_clientes );

            for( $i = 0 ; $i < count($info[$x]['movimientos']) ; $i++ )
            {
                array_push($movimientos, [ 
                    "codigo"     => $info[$x]['movimientos'][$i]['codigo'],
                    "producto"   => $info[$x]['movimientos'][$i]['producto'],
                    "neto"       => $info[$x]['movimientos'][$i]['neto'],
                    "precio"     => $info[$x]['movimientos'][$i]['precio'],
                    "texto_extra" => $info[$x]['movimientos'][$i]['texto_extra']
                    ]);
            }

            array_push($result[$key]["facturas"] , [
                    "agente"      => $info[$x]['agente'] ,
                    "serie"       =>  $info[$x]['serie'] ,
                    "folio"         =>  $info[$x]['folio'] ,
                    "iddocumento"   =>  $info[$x]['iddocumento'] ,
                    "id_tipo"       =>  $info[$x]['id_tipo'] ,
                    "id_concepto"   =>  $info[$x]['id_concepto'] ,
                    "fecha"         =>  $info[$x]['fecha'] ,
                    "idmoneda"      =>  $info[$x]['idmoneda'] ,
                    "tipocambio"    =>  $info[$x]['tipocambio'] ,
                    "metodopago"    =>  $info[$x]['metodopago'] ,
                    "total"         =>  $info[$x]['total'] ,
                    "neto"          =>  $info[$x]['neto'] ,
                    "pendiente"     =>  $info[$x]['pendiente'] ,
                    "movimientos"    =>  $movimientos 
                ] );
            $movimientos = [];
        }

        //print_r($index_clientes);

        return $result;
    	//print_r($info);
    	//return json_decode($data,true);
    }
}
