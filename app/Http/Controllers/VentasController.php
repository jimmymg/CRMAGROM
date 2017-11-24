<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class VentasController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest');
        
    }
    
    public function buscarorden($orden,$proyecto)
    {
    	$validar = DB::SELECT("SELECT ventas.id , ventas.orden_compra , proyectos.nombre , ventas.id_proyecto
    	FROM ventas  
    	INNER JOIN proyectos ON ventas.id_proyecto = proyectos.id 
		WHERE orden_compra='$orden' 
    	 ");

        //Validar que ese proyecto ya tenga una orden
        $validar_proyecto = DB::SELECT("select * from ventas WHERE id_proyecto = ".$proyecto);

        if( !empty($validar_proyecto) && $orden != $validar_proyecto[0]->orden_compra )
        {
            return [ "respuesta" => "proyecto" , "orden_id" => $validar_proyecto[0]->id , "numero" =>  $validar_proyecto[0]->orden_compra ];
        }

        if( empty($validar) )
    	{  
            //Insertar esa Orden y Actualizar al proyecto
            

            $id = DB::TABLE('ventas')->INSERTGETID([
                    "id_proyecto"   => $proyecto ,
                     "id_usuario"   => Auth::user()->id ,
                     "orden_compra" => $orden
                ]);

           
    		return [ "respuesta" => "nuevo" , "orden_id" => $id ];
    	}else{

            if( $proyecto == $validar[0]->id_proyecto )
            {
                return [ "respuesta" => "existe" , "orden_id" => $validar[0]->id , "numero" => $validar[0]->orden_compra ];
            }else{
                return [ "respuesta" => "error" , "orden_id" => $validar[0]->id ];
            }

    		
    	}
    }

    public function cargarProyectos()
    {
    	$proyectos = DB::SELECT('SELECT proyectos.id , proyectos.nombre , orden_compra FROM proyectos 
    		LEFT JOIN ventas 
            ON ventas.id_proyecto = proyectos.id
            WHERE proyectos.ventas = 1');

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

//Falta Validar si ya se hizo una factura anteriormente para evitar que se agreguen mas productos
        $validar_solicitud = DB::SELECT("select * from solicitud where id_venta=$id_numero_orden");

        if( !empty($validar_solicitud) )
        {
            return "validar_solicitud";
        }

        $validar = DB::SELECT('SELECT * FROM movimiento_productos 
        WHERE id_producto = '.$producto.' AND id_venta ='.$id_numero_orden);
        
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

        $vendedor    =  $request->input('vendedor');


        $venta = DB::SELECT("SELECT * FROM ventas WHERE orden_compra=$orden_compra");
        $id_venta = $venta[0]->id;

        $validar = DB::SELECT("SELECT * FROM solicitud 
        WHERE facturado = 0 AND cancelado = 0 AND id_venta = ".$id_venta);

        if( !empty($validar) )
        {
            return "Solicitud En Espera";
        }

        $solicitudes = DB::SELECT("SELECT SUM(porcentaje) as porc FROM solicitud 
        WHERE id_venta = ".$id_venta);
        
        if( ( $solicitudes[0]->porc + $porcentaje ) > 100 )
        {
            return "mayor";
        }

        DB::TABLE('solicitud')->INSERT([
                "id_venta"          => $id_venta ,
                "vendedor"          => $vendedor ,
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

    public function cargarFacturas($idventa)
    {   
        return 
        DB::SELECT("SELECT facturas.factura , solicitud.total FROM solicitud 
        INNER JOIN solicitud_factura ON solicitud.id = solicitud_factura.id_solicitud
        INNER JOIN facturas          ON facturas.id = solicitud_factura.id_factura
        WHERE id_venta = $idventa ");
    }   

    public function getVentas()
    {   ///Get Cantidad de Facturas getTotal y pendiente
        $condition = "";
        $result = [];
        if( Auth::user()->id_area > 1  )
        {
            $condition = " WHERE ventas.id_usuario =  ".Auth::user()->id;
        }

        $data =
        DB::SELECT("SELECT ventas.id , ventas.orden_compra , proyectos.nombre , usuarios.nombre as usuario
        FROM ventas 
        INNER JOIN proyectos ON proyectos.id = ventas.id_proyecto
        INNER JOIN usuarios ON usuarios.id = ventas.id_usuario
        $condition");
        $result = [];
        foreach($data as $row)
        {
            $solicitudes_facturadas = 
            DB::SELECT("SELECT * FROM solicitud
            WHERE facturado = 1 AND id_venta = ".$row->id);

            $cantidad_facturas = count( $solicitudes_facturadas );

            $productos =
            DB::SELECT("SELECT SUM(total) as total
            FROM movimiento_productos WHERE id_venta=".$row->id);

            $total = $productos[0]->total;

            array_push($result , [
                "id" => $row->id ,
                "orden_compra" => $row->orden_compra ,
                "proyecto" => $row->nombre ,
                "usuario"  => $row->usuario ,
                "facturas" => $cantidad_facturas ,
                "total" => $total ,
                "pendiente" => ($total*1.16)
            ]);

        }//END FOREACH
        return $result;
    }

    public function getSeries($idmov)
    {   
        $validarProducto = DB::SELECT("SELECT 
        producto.id , producto.lleva_series
        FROM movimiento_productos
        INNER JOIN producto ON producto.id = movimiento_productos.id_producto
        WHERE movimiento_productos.id=".$idmov);
        $producto = $validarProducto[0]->id;
        if( $validarProducto[0]->lleva_series == 0 )
        {
            return "Sin Series";
        }
        return 
        DB::SELECT("SELECT * FROM series
        WHERE id_producto = $producto");

    }

    public function getPagosVenta($idventa)
    {
        return 
        DB::SELECT("SELECT facturas.factura , fecha_pago , solicitud.total FROM ventas 
        INNER JOIN solicitud         ON solicitud.id_venta = ventas.id
        INNER JOIN solicitud_factura ON solicitud_factura.id_solicitud = solicitud.id
        INNER JOIN facturas          ON facturas.id = solicitud_factura.id_factura
        INNER JOIN pagos             ON pagos.id_Factura = facturas.id
        
        WHERE ventas.id = ".$idventa);

    }
    
    public function editarSerie(Request $request)
    {
        $serie    = $request->input("nueva_serie");
        $id_serie = $request->input("id_serie");

        //Solo Editar la serie Actual y ya y levantar una bandera de no mas una vez se puede editar
        //Validar si anteriormente estaba como PENDIENTE
        //Hacer un Pendiente en Agregar Serie solo un boton que escriba Pendiente y Ya en la Seccion de serie
        
    }

}
