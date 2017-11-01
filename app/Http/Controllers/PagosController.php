<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class PagosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest');
        
    }

    public function index()
    {
        return view("Pagos.pagos");
    }

    public function GetPagosHistorial()
    {
        return DB::SELECT("SELECT solicitud.id , facturas.factura , solicitud.`subtotal` , solicitud.`iva` , solicitud.`total` , moneda.nombre as moneda , 
        solicitud.id_venta , usuarios.nombre as usuario , ventas.orden_compra
        FROM facturas 
        INNER JOIN solicitud_factura ON facturas.id = solicitud_factura.id_factura
        INNER JOIN solicitud ON solicitud.id = solicitud_factura.id_solicitud
        INNER JOIN moneda ON solicitud.id_moneda = moneda.id
        INNER JOIN usuarios ON usuarios.id = solicitud.created_by
        INNER JOIN ventas ON ventas.id = solicitud.id_venta
        WHERE solicitud.pagado = 1
        ");



    }

    public function getPagosPendientes($tipo , $solicitud)
    {   

        $condition = "";

        if( $tipo == 1 )
        {
            $condition = " AND solicitud.id = ".$solicitud;
        }


        $data = DB::SELECT("SELECT solicitud.id , facturas.factura , solicitud.`subtotal` , solicitud.`iva` , solicitud.`total` , moneda.nombre as moneda , 
        solicitud.id_venta , usuarios.nombre as usuario , ventas.orden_compra
        FROM facturas 
        INNER JOIN solicitud_factura ON facturas.id = solicitud_factura.id_factura
        INNER JOIN solicitud ON solicitud.id = solicitud_factura.id_solicitud
        INNER JOIN moneda ON solicitud.id_moneda = moneda.id
        INNER JOIN usuarios ON usuarios.id = solicitud.created_by
        INNER JOIN ventas ON ventas.id = solicitud.id_venta
        WHERE solicitud.facturado = 1 AND solicitud.pagado = 0 ".$condition);

        $result = [];

        foreach( $data as $row )
        {   //Falta Restar con lo que ya se Pago
            $info = 
            DB::SELECT("SELECT SUM(total) as total FROM movimiento_productos
                WHERE id_venta=".$row->id_venta);
            $total_venta = ($info[0]->total * 1.16); //Falta Restar las SOlicitudes ya Pagadas
            
            $pagados = 
            DB::SELECT("SELECT * FROM solicitud WHERE pagado = 1 and cancelado = 0 and id = ".$row->id);

            foreach( $pagados as $pagado )
            {
                $total_venta = $total_venta -  $pagado->total;
            }

            array_push($result , [
                "solicitud_id"=> $row->id ,
                "orden_compra" => $row->orden_compra ,
                "factura"=> $row->factura ,
                "subtotal"=> $row->subtotal,
                "iva"=>  $row->iva,
                "total"=> $row->total,
                "moneda" => $row->moneda,
                "pendiente_total" => $total_venta ,
                "usuario" => $row->usuario            ]);
        }

        return $result;
    }

    public function pagarFactura(Request $request)
    {  
        $solicitud = $request->input("solicitud");
        $fecha_pago = $request->input("fecha_pago");
        $observacion = $request->input("observacion");

        
        $find_factura = DB::SELECT("SELECT * FROM solicitud_factura WHERE id_solicitud = ".$solicitud);

        $id_factura = $find_factura[0]->id_factura;

        DB::TABLE("pagos")->INSERT([
            "id_factura"  => $id_factura ,
            "id_usuario"  => Auth::user()->id ,
            "fecha_pago"  => $fecha_pago ,
            "observacion" => $observacion
        ]);

        DB::TABLE("solicitud")->WHERE("id",$solicitud)->UPDATE([
            "pagado" => 1 ,
        ]);

    }
}
