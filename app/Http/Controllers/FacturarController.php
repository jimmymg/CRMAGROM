<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FacturarController extends Controller
{
    //

    public function index()
    {
    	return view("Facturar.solicitar_factura");
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
    			facturas.pedido ,
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
    		SELECT solicitud.`id` as id_solicitud,
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
    			ventas.id as id_venta ,
    			facturas.pedido ,
    			facturas.remision ,
    			facturas.factura 
    	 	FROM solicitud
    	 	INNER JOIN ventas ON solicitud.id_venta = ventas.id
    	 	INNER JOIN usuarios ON solicitud.created_by = usuarios.id
    	 	LEFT JOIN solicitud_factura ON solicitud_factura.id_solicitud = solicitud.id 
			LEFT JOIN facturas ON solicitud_factura.id_factura = facturas.id
    		WHERE solicitud.id=".$solicitud);

    	$productos = DB::SELECT("SELECT 
			movimiento_productos.id_venta ,
			movimiento_productos.id_producto ,
			movimiento_productos.cantidad ,
			movimiento_productos.total ,
			producto.producto , 
			producto.lleva_series 
		 	FROM movimiento_productos 
    		INNER JOIN producto ON producto.id = movimiento_productos.id_producto
    		WHERE movimiento_productos.id_venta = ".$info_solicitud[0]->id_venta);
    
		$series = [];
		$result = [];
    	foreach($productos as $producto)
    	{	
    		$series = [];
    		$series = DB::SELECT("SELECT * 
    			FROM movimiento_series
    			INNER JOIN series ON movimiento_series.`id_serie` = series.id
				WHERE movimiento_series.id_venta = ".$info_solicitud[0]->id_venta." AND series.`id_producto`= ".
				$producto->id_producto);

				array_push( $result , [ 
					"id_producto" => $producto->id_producto  ,
					"producto" => $producto->producto,
					"lleva_series" => $producto->lleva_series,
 					"cantidad" => $producto->cantidad ,
					"total" => $producto->total,
					"series" => $series
				 ]);
		}
	
		array_push($result , $info_solicitud);

		return $result;
	}
	
	public function solicitar_factura(Request $request)
	{
		$pedido = $request->input("pedido");
		$remision = $request->input("remision");
		$id_solicitud = $request->input("solicitud");
		
		$validar = DB::SELECT("SELECT * FROM solicitud WHERE id=".$id_solicitud);
		if( $validar[0]->facturado == 2 )
		{
			return "Existe";
		}

		$idFactura =
		DB::TABLE("facturas")->INSERTGETID([
			"pedido"   => $pedido ,
			"remision" => $remision
		]);

		DB::TABLE("solicitud_factura")->INSERT([
			"id_solicitud" => $id_solicitud ,
			"id_factura"   => $idFactura
		]);
			//Cambiar Estado a Pendiente de Facturar
		DB::TABLE("solicitud")->WHERE("id",$id_solicitud)->UPDATE([
			"facturado" => 2
		]);

		
	}

	public function pendiente_facturar()
	{
		return 
		DB::SELECT("	SELECT facturas.id, facturas.pedido , facturas.remision , facturas.factura , solicitud.total , solicitud.razon FROM solicitud 
			INNER JOIN solicitud_factura ON solicitud.id = solicitud_factura.`id_solicitud`
			INNER JOIN facturas ON solicitud_factura.id_factura = facturas.id
			WHERE facturado = 2");
	}

	public function facturar(Request $request)
	{
		$idfactura = $request->input("id");
		$factura   = $request->input("factura");

		DB::TABLE("facturas")->WHERE("id",$idfactura)->UPDATE([
				"factura" => $factura
			]);

		//CAMBIAR EL ESTADO DE LA SOLICITUD A 1 , FACTURADO
		$id_solicitud =
		DB::SELECT("SELECT * FROM solicitud_factura
			WHERE id_factura = ".$idfactura);

		$id_solicitud = $id_solicitud[0]->id_solicitud;

		DB::TABLE("solicitud")->WHERE("id",$id_solicitud)->UPDATE([
				"facturado" => 1
			]);


	}

}
