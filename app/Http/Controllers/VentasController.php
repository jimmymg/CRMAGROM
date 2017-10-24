<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class VentasController extends Controller
{
    //

    public function buscarorden($orden,$proyecto)
    {
    	$validar = DB::SELECT("SELECT ventas.id , ventas.orden_compra , proyectos.nombre , ventas.id_proyecto
    	FROM ventas  
    	INNER JOIN proyectos ON ventas.id_proyecto = proyectos.id 
		WHERE orden_compra='$orden' 
    	 ");



    	if( empty($validar) )
    	{  
            //Insertar esa Orden
            $id = DB::TABLE('ventas')->INSERTGETID([
                    "id_proyecto"   => $proyecto ,
                     "id_usuario"   => Auth::user()->id ,
                     "orden_compra" => $orden
                ]);

    		return [ "respuesta" => "nuevo" , "orden_id" => $id ];
    	}else{

            if( $proyecto == $validar[0]->id_proyecto )
            {
                return [ "respuesta" => "existe" , "orden_id" => $validar[0]->id ];
            }else{
                return [ "respuesta" => "error" , "orden_id" => $validar[0]->id ];
            }

    		
    	}
    }

    public function cargarProyectos()
    {
    	$proyectos = DB::SELECT('SELECT proyectos.id , proyectos.nombre , orden_compra FROM proyectos 
    		LEFT JOIN ventas 
    		ON ventas.id_proyecto = proyectos.id');

    	return $proyectos;
    }

    public function guardarNuevoProducto(Request $request)
    {
        $nuevo = $request->input('producto');
        $control_series = $request->input('control_series');

        $validar = DB::SELECT("SELECT * FROM producto WHERE producto='$nuevo'");

        if( !empty($validar) )
        {
            return 500;
        }

        DB::TABLE('producto')->INSERT([

                'producto'   => $nuevo ,
                'created_by' => Auth::user()->id ,
                'fecha_alta' => date('Y-m-d') ,
                'lleva_series' => $control_series

            ]);

    }//

    public function getProductos()
    {
        return DB::SELECT('SELECT * FROM producto');
    }

    public function addproduct_to_order(Request $request)
    {
        $producto           = $request->input('producto');
        $cantidad           = $request->input('cantidad');
        $total              = $request->input('total');
        $lleva_series       = $request->input('lleva_series');
        $series             = $request->input('series');
        $id_numero_orden    = $request->input('numero_orden');

        $validar = DB::SELECT('SELECT * FROM movimiento_productos WHERE id_producto = '.$producto);

        if( !empty($validar) )
        {
            return "validar";
        }


        DB::TABLE('movimiento_productos')->INSERT([
                'id_venta' => $id_numero_orden ,
                'id_producto' => $producto ,
                'cantidad' => $cantidad ,
                'total' => $total
            ]);
        echo $lleva_series;
        if( $lleva_series == true && $series != null)
        {   
      
            $movimientos_series_insert = [];

            foreach(  $series as $serie)
            {
                $serie_id = DB::TABLE('series')->INSERTGETID([ 
                    "id_producto"   => $producto        ,
                    "serie"         => $serie           ,
                    "created_at"    => date('Y-m-d')    ,
                    "created_by"    => Auth::user()->id
                 ]);

                array_push($movimientos_series_insert, [
                        "id_serie" => $serie_id ,
                        "id_venta" => $id_numero_orden
                    ]);
            }

            DB::TABLE('movimiento_series')->INSERT($movimientos_series_insert);
        }//END IF
    }

    public function productos_orden($orden)
    {
        $productos = DB::SELECT('SELECT movimiento_productos.id , cantidad , total , producto.producto , producto.fecha_alta , producto.lleva_series , usuarios.nombre as usuario , producto.id as producto_id
          FROM movimiento_productos 
            
            INNER JOIN producto ON producto.id = movimiento_productos.id_producto
            INNER JOIN usuarios ON usuarios.id = producto.created_by
            WHERE id_venta='.$orden);
        $series = [];
        $series_result = [];
        $result = [];
        foreach( $productos  as $producto )
        {   
            
            $series = DB::SELECT("SELECT series.id as id_serie , movimiento_series.id as id_movimiento_serie , series.id_producto  ,
                series.serie , series.created_at , series.created_by
                FROM movimiento_series
                INNER JOIN series ON series.id = movimiento_series.id_serie
                WHERE movimiento_series.id_venta = $orden AND series.id_producto ="
                .$producto->producto_id);
            $series_result = [];
            foreach( $series as $serie )
            {
                    array_push( $series_result , [
                            "id"         => $serie->id_serie ,
                            "id_movimiento" => $serie->id_movimiento_serie ,
                            "serie"      => $serie->serie ,
                            "creado_por" => $serie->created_by ,
                            "creado_el"  => $serie->created_at
                        ]);
                
            }//END FOREACH


            array_push($result , [
                    "id_movimiento" => $producto->id ,
                    "cantidad"      => $producto->cantidad ,
                    "total"         => $producto->total ,
                    "producto"      => $producto->producto , 
                    "fecha_alta"    => $producto->fecha_alta ,
                    "lleva_series"  => $producto->lleva_series ,
                    "usuario"       => $producto->usuario ,
                    "series"        => $series_result
                ]);

        }//END FOREACH

        return $result;
    }

    public function calcular($orden)
    {
        $datos = DB::SELECT('SELECT SUM(total) as total 
            FROM movimiento_productos 
            WHERE id_venta = '.$orden);

        return $datos['0']->total;
    }

    public function solicitar_factura(Request $request)
    {
        $orden_compra = $request->input('orden_compra');
        $solicitud    = $request->input('solicitud');
        $razon        = $request->input('razon');
        $direccion    = $request->input('direccion');
        $rfc          = $request->input('rfc');
        $telefono     = $request->input('telefono');

        $moneda       =  $request->input('moneda');
        $solicito     =  $request->input('solicito');
        $metodo_pago  =  $request->input('metodo_pago');
        $vencimiento  =  $request->input('vencimiento');
        $porcentaje   =  $request->input('porcentaje');

        $subtotal     =  $request->input('subtotal');
        $iva          =  $request->input('iva');
        $total        =  $request->input('total');

        


        $venta = DB::SELECT("SELECT * FROM ventas WHERE orden_compra=$orden_compra");
        $id_venta = $venta[0]->id;

        $validar = DB::SELECT("SELECT * FROM solicitud WHERE facturado = 0 AND cancelado = 0 AND id_venta = ".$id_venta);

        if( !empty($validar) )
        {
            return "Solicitud En Espera";
        }

        DB::TABLE('solicitud')->INSERT([
                "id_venta"          => $id_venta ,
                "fecha_solicitud"   => $solicitud ,
                "razon"             => $razon,
                "direccion"         => $direccion ,
                "telefono"          => $telefono ,
                "rfc"               => $rfc ,
                "id_moneda"         => $moneda ,
                "solicito"          => $solicito ,
                "metodo_pago"       => $metodo_pago ,
                "vencimiento"       => $vencimiento ,
                "porcentaje"        => $porcentaje ,
                "subtotal"          => $subtotal ,
                "iva"               => $iva ,
                "total"             => $total ,
                "created_by"        => Auth::user()->id
            ]);



    }

    public function get_facturas($venta)
    {   
        return DB::SELECT("SELECT 
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
            total ,
            porcentaje ,
            facturado ,
            cancelado ,
            usuarios.nombre as solicito
         FROM solicitud 
         INNER JOIN usuarios ON usuarios.id = solicitud.created_by
         WHERE id_venta = ".$venta);    
    }

    public function ordenes_compras()
    {   //Vendedor //Cantidad de Facturas // Total //Pendiente
        $ventas = DB::SELECT("SELECT * FROM ventas WHERE id_usuario = ".Auth::user()->id );
        
        foreach( $ventas as $venta )
        {
            $vendedor  =  DB::SELECT("SELECT * FROM usuarios WHERE id = ".$venta->id_usuario);

            $facturas  =  DB::SELECT("SELECT facturas.factura FROM solicitud_factura
                                INNER JOIN solicitud ON solicitud.id = solicitud_factura.id_solicitud
                                INNER JOIN facturas ON facturas.id = solicitud_factura.id_factura
                                WHERE solicitud.cancelado = 0 and facturado = 1");

            $total     = DB::SELECT("SELECT SUM(total) as total FROM movimiento_productos WHERE id_venta = ".$venta->id);

            $total = $total[0]->total * 1.16;
            

            //Se lo debo falta crear la tabla de pagos para sacar este
           // $pendiente = ;
        }   

    }

}
