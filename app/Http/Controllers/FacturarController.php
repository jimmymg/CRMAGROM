<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FacturarController extends Controller
{
    //

    public function index()
    {
    	return view("Facturar.facturar");
    }

    public function solicitudes()
    {	

    	return
    	DB::SELECT("
    		SELECT solicitud.`id` ,
    			id_venta ,
    			fecha_solicitud ,
    			razon ,
    			direccion ,
    			rfc ,
    			telefono ,
    			id_moneda ,
    			solicito ,
    			metodo_pago ,
    			vencimiento ,
    			subtotal , 
    			iva , 
    			solicitud.total ,
    			porcentaje ,
    			facturado ,
    			cancelado ,
    			usuarios.nombre AS usuario ,
    			facturas.factura ,
    			ventas.orden_compra
    	 	FROM solicitud
    	 	INNER JOIN ventas ON solicitud.id_venta = ventas.id
    	 	INNER JOIN usuarios ON solicitud.created_by = usuarios.id
    	 	LEFT JOIN solicitud_factura ON solicitud_factura.id_solicitud = solicitud.id 
    		LEFT JOIN facturas ON solicitud_factura.id_factura = facturas.id");
    }

    public function get_soliciud($solicitud)
    {
    	$info_solicitud =
    	DB::SELECT("
    		SELECT solicitud.`id` ,
    			id_venta ,
    			fecha_solicitud ,
    			razon ,
    			direccion ,
    			rfc ,
    			telefono ,
    			id_moneda ,
    			solicito ,
    			metodo_pago ,
    			vencimiento ,
    			subtotal , 
    			iva , 
    			solicitud.total ,
    			porcentaje ,
    			facturado ,
    			cancelado ,
    			usuarios.nombre AS usuario ,
    			ventas.orden_compra ,
    			ventas.id as id_venta
    	 	FROM solicitud
    	 	INNER JOIN ventas ON solicitud.id_venta = ventas.id
    	 	INNER JOIN usuarios ON solicitud.created_by = usuarios.id
    		WHERE solicitud.id=".$solicitud);

    	$productos = BD::SELECT("SELECT 
			movimiento_productos.id_venta ,
			movimiento_productos.id_producto ,
			movimiento_productos.cantidad ,
			movimiento_productos.total ,
			producto.producto , 
			producto.lleva_series 
		 	FROM movimiento_productos 
    		INNER JOIN producto ON producto.id = movimiento_productos.id_producto
    		WHERE movimiento_productos.id_venta = ".$solicitud);
		$series = [];
		$result = [];
    	foreach($productos as $producto)
    	{
    		$series = DB::SELECT("SELECT * 
    			FROM movimiento_series
    			INNER JOIN series ON movimiento_series.`id_serie` = series.id
				WHERE movimiento_series.id_venta = $solicitud AND series.`id_producto`= ".$producto['id_producto']);

				array_push( $result , [ 
					"id_producto" => $producto['id_producto']  ,
					"producto" => $producto['producto'],
					"lleva_series" => $producto['lleva_series'],
 					"cantidad" => $producto['cantidad'] ,
					"total" => $producto['total'],
					"series" => $series
				 ]);
		}
		
		array_push($result , $info_solicitud);

		return $result;



    }

}
