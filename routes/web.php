<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

/*URL'S Publicas*/
Route::get('Ejecutar/{password}','PublicoController@ejecutar');
///////////////////

Route::get('/inicio','crmController@index')->middleware('guest');

Route::get('/',function(){
	return redirect('login');
});

Route::get('login', function(){
	if(Auth::check()){
		return redirect('inicio');
	}
	else{
		return view('login.login');
	}
});

Route::post('entrar','crmController@auth');

Route::post('prueba','crmController@insertarUsuario');

Route::get('logout','crmController@logout');

Route::get('correos' , 'crmController@correos');
Route::post('correos/enviar' , 'crmController@GO');

Route::get('GoogleCalendar' , 'crmController@GC');
Route::post('addEvent' , 'crmController@event');

Route::get('Archivos/{tipoArchivo}/proyecto/{proyecto}','crmController@archivos');
//############################################################
/*Fase1:*/
	Route::get('ProyectosALL' , 'Fase1Controller@ProyectosIndex');
	Route::get('Fase1','Fase1Controller@index')->middleware('guest');
	Route::get('Fase1/getAdministradores','Fase1Controller@getAdministradores');
	Route::get('Fase1/getCamposGenerales','Fase1Controller@getCamposGenerales');
	Route::post('Fase1/Guardar_Proyecto','Fase1Controller@insertarProyecto');
	Route::get('Fase1/Ver_Proyecto/{proyecto}','Fase1Controller@verProyecto');
	Route::post('Fase1/Ver_Proyecto/GuardarSeguimiento','Fase1Controller@guardarSeguimiento');
	Route::post('Fase1/Ver_Proyecto/GuardarComentario','Fase1Controller@guardarComentario');
	Route::get('Fase1/Ver_Proyecto/cargar_com_seg/{proyecto}','Fase1Controller@get_comentarios_seguimientos');
	Route::post('Fase1/Ver_Proyecto/siguienteFase','Fase1Controller@siguienteFase');

	Route::post('Fase1/Ver_Proyecto/Archivos','Fase1Controller@subirArchivos');
	Route::get('Fase1/Ver_Proyecto/getarchivos/{proyecto}/{tipo}','Fase1Controller@archivos_mostrar');

	/*Consulta la informacion para las Fases y hacer que el boton cancelar jale luego correos*/
	Route::get( 'Fase1/Proyectos/EnProceso'   , 'Fase1Controller@proyectosEnProceso'   );
	Route::get( 'Fase1/Proyectos/EnEspera'    , 'Fase1Controller@proyectosEnEspera'    );
	Route::get( 'Fase1/Proyectos/EnProceso/{pivote}/estado/{estado}' , 'Fase1Controller@getProyectosEstados'  );

	Route::post( 'Fase1/Proyectos/CambiarEstado' ,'Fase1Controller@cambiarEstadoProyecto' );

	Route::get( 'Fase1/Proyectos/Pausados'    , 'Fase1Controller@proyectosPausados'    );
	Route::get( 'Fase1/Proyectos/Finalizados' , 'Fase1Controller@proyectosFinalizados' );
	Route::get( 'Fase1/Proyectos/Cancelados'  , 'Fase1Controller@proyectosCancelados'  );

	Route::get( 'Fase1/Proyectos/InformacionCliente/{cliente}' , 'Fase1Controller@informacionCliente' );
	Route::get( 'Fase1/Proyectos/InformacionEmpresa/{empresa}' , 'Fase1Controller@informacionEmpresa' );
	Route::get( 'Fase1/Proyectos/Archivos/{proyecto}'          , 'Fase1Controller@getProyectoArchivos' );
	Route::get( 'Fase1/Proyectos/Seguimientos/{proyecto}'      , 'Fase1Controller@get_Alls_Seguimientos_Comentarios');
	Route::get( 'Fase1/Proyectos/InformacionGeneral/{proyecto}' , 'Fase1Controller@get_all_the_information');

	Route::post( 'Fase1/Ver_Proyecto/AgendarRecordatorio'       , 'Fase1Controller@AgendarRecordatorio' ); 

	Route::get( 'Fase1/Cliente/Empresa/{proyecto}' , 'Fase1Controller@clientesEmpresa' );
	Route::get( 'Fase1/ContactosExtras/Proyecto/{proyecto}' , 'Fase1Controller@ContactosExtras' );
	Route::post( 'Fase1/AñadirContacto' , 'Fase1Controller@nuevoContacto' );

	Route::post( 'Fase1/GuardarConfiguracion' , 'Fase1Controller@guardarConfiguracion' );

	/*Seccion de Editar*/
	Route::post( 'Fase1/Editar' , 'Fase1Controller@editarProyecto' );
//############################################################
/*Ventas:*/
	Route::get( 'ventas' , function(){
		return view('ventas.index');
	} )->middleware('guest');
	Route::get( 'ventas/nueva' , function(){
		return view('ventas.nueva');
	} );
	Route::get( "ventas/getVentas" , "VentasController@getVentas" );
	Route::get( "ventas/solicitudes/{venta}" , "VentasController@get_facturas" );

	Route::get( 'ventas/nueva/getOrden/{orden}/proyecto/{proyecto}', 'VentasController@buscarorden' );
	Route::get( 'ventas/cargar' , 'VentasController@cargarProyectos' );
	Route::post( 'ventas/nueva/guardar' , 'VentasController@guardar' );
	Route::post( 'ventas/nueva/altaProducto' , 'VentasController@guardarNuevoProducto' );
	Route::get( 'ventas/nueva/getProductos' , 'VentasController@getProductos' );
	Route::post( 'ventas/nueva/orden/addproduct' , 'VentasController@addproduct_to_order' );
	Route::get( 'ventas/nueva/orden/{orden}/productos' , 'VentasController@productos_orden' );
	Route::get( 'ventas/nueva/calcular/orden/{orden}' , 'VentasController@calcular' );
	Route::post( 'ventas/nueva/solicitarFactura' , 'VentasController@solicitar_factura' );
	Route::get( 'ventas/getFacturas/{idventa}' , 'VentasController@cargarFacturas' );
	Route::get( 'ventas/getSeries/{idproducto}' , 'VentasController@getSeries' );
//############################################################
/*Solicitar Factura y Facturar:*/
	Route::get( 'solcitarFactura' , "FacturarController@index" );
	Route::get( 'facturar' , function(){
		return view('Facturar.facturar');
	} );
	Route::get( 'solcitarFactura/solicitudes' , 'FacturarController@solicitudes' );
	Route::get( 'solcitarFactura/solicitud/{solicitud}' , 'FacturarController@get_soliciud' );
	Route::post( 'solicitarFactura/solicitar' , 'FacturarController@solicitar_factura' );
	Route::get( 'solicitarFactura/pendientes' , 'FacturarController@pendiente_facturar' );
	Route::post( 'solicitarFactura/facturar' , 'FacturarController@facturar' );
//############################################################
/*Productos:*/
	Route::get( 'productos' , 'ProductosController@index' );
	Route::get( 'productos/todos' , 'ProductosController@consultaProductos' );
//############################################################
/*Pagos:*/
	Route::get( 'Pagos' , 'PagosController@index' );
//############################################################
/*Fase2:*/
	Route::get('Fase2','Fase2Controller@index')->middleware('guest')->middleware('Fase2');
	Route::post('Fase2/siguienteFase','Fase2Controller@siguienteFase');
	Route::get('Fase2/Ver_Proyecto/{proyecto}','Fase2Controller@verProyecto');

	Route::post('Fase2/Ver_Proyecto/Archivos','Fase2Controller@subirArchivos');
	Route::get('Fase2/Ver_Proyecto/getarchivos/{proyecto}/{tipo}','Fase2Controller@archivos_mostrar');
//############################################################
/*Fase3:*/
	Route::get('Fase3','Fase3Controller@index')->middleware('guest');
	Route::get('Fase3/Ver_Proyecto/{proyecto}','Fase3Controller@verProyecto');
	Route::post('Fase3/Ver_Proyecto/GuardarComentario','Fase1Controller@guardarComentario');
	Route::post('Fase3/siguienteFase','Fase3Controller@siguienteFase');

	Route::post('Fase3/Ver_Proyecto/Archivos','Fase3Controller@subirArchivos');
	Route::get('Fase3/Ver_Proyecto/getarchivos/{proyecto}/{tipo}','Fase3Controller@archivos_mostrar');
//############################################################
/*Fase4:Logistica*/
	Route::get('Fase4','Fase4Controller@index')->middleware('guest');
	Route::post('Fase4/siguienteFase','Fase4Controller@siguienteFase');
//############################################################
/*Fase5:*/
	Route::get('Fase5','Fase5Controller@index')->middleware('guest');
	Route::get('Fase5/Ver_Proyecto/{proyecto}','Fase5Controller@verProyecto');
	Route::post('Fase5/siguienteFase','Fase5Controller@siguienteFase');
	Route::get('Fase5/Ver_Proyecto/seguimientos/{proyecto}','Fase5Controller@getSeguimientos');
	Route::post('Fase5/Ver_Proyecto/GuardarComentario','Fase5Controller@guardarComentario');

	Route::post('Fase5/Ver_Proyecto/Archivos','Fase5Controller@subirArchivos');
	Route::get('Fase5/Ver_Proyecto/getarchivos/{proyecto}/{tipo}','Fase5Controller@archivos_mostrar');
//############################################################
/*Fase6:Instalacion y Arranque*/
	Route::get('Fase6','Fase6Controller@index')->middleware('guest');
	Route::get('Fase6/Ver_Proyecto/{proyecto}','Fase6Controller@verProyecto');
	Route::get('Fase6/Ver_Proyecto/seguimientos/{proyecto}','Fase6Controller@getSeguimientos');
	Route::post('Fase6/Ver_Proyecto/GuardarSeguimiento','Fase6Controller@guardarSeguimiento');
	Route::post('Fase6/Ver_Proyecto/GuardarComentario','Fase6Controller@guardarComentario');
	Route::post('Fase6/Ver_Proyecto/GuardarVisita','Fase6Controller@guardarVisita');
	Route::post('Fase6/siguienteFase','Fase6Controller@siguienteFase');

	Route::post('Fase6/Ver_Proyecto/Archivos','Fase6Controller@subirArchivos');
	Route::get('Fase6/Ver_Proyecto/getarchivos/{proyecto}/{tipo}','Fase6Controller@archivos_mostrar');
//############################################################
/*Fase7:PostVenta*/

	Route::get('Fase7','Fase7Controller@index')->middleware('guest');
	Route::get('Fase7/Ver_Proyecto/{proyecto}','Fase7Controller@verProyecto');
	Route::get('Fase7/Ver_Proyecto/seguimientos/{proyecto}','Fase7Controller@getSeguimientos');
	Route::post('Fase7/Ver_Proyecto/GuardarComentario','Fase7Controller@guardarComentario');
	Route::post('Fase7/Ver_Proyecto/FinalizarProyecto','Fase7Controller@FinalizarProyecto');
//############################################################
/*Usuarios:*/
	Route::get('Usuarios','UsuariosController@index')->middleware('dios');
	Route::get('Usuarios/getUsuarios','UsuariosController@getUsuarios');
	Route::post('Usuarios/insertar','UsuariosController@insertarUsuario');
//############################################################
/*Clientes:*/
	Route::get('Clientes','ClientesController@index')->middleware('guest');
	Route::get('Clientes/getClientes','ClientesController@getClientes');
	Route::get('Clientes/getCliente/{cliente}' , 'ClientesController@getCliente');
	Route::post('Clientes/AgregarCliente','ClientesController@insertarCliente');
	Route::post('Clientes/ActualizarCliente' , 'ClientesController@actualizarCliente');
//############################################################
/*Empresas:*/
	Route::get('Empresas','EmpresasController@index')->middleware('guest');
	Route::get('Empresas/getEmpresas','EmpresasController@getEmpresas');
	Route::get('Empresas/empresa/{empresa}','EmpresasController@getEmpresa');
	Route::post('Empresas/AgregarEmpresa','EmpresasController@insertarEmpresa');
	Route::post('Empresas/EditarEmpresa','EmpresasController@editarEmpresa');
//############################################################
/*Marcas:*/
	Route::get('Marcas','MarcasController@index')->middleware('guest');
	Route::post('Marcas/AgregarMarca','MarcasController@insertarMarca');
	Route::get('Marcas/getMarcas','MarcasController@getMarcas');
//############################################################
/*Configuracion:*/
	
	Route::get('Configuracion','ConfiguracionController@index')->middleware('guest');
	Route::get('Configuracion/getTipos','ConfiguracionController@getTipos');
	Route::post('Configuracion/postTipo','ConfiguracionController@insertarTipo');
	Route::get('Configuracion/getAreas','ConfiguracionController@getAreas');
	Route::post('Configuracion/postArea','ConfiguracionController@insertarArea');
	Route::get('Configuracion/getEstados' , 'ConfiguracionController@getEstados');
	Route::post('Configuracion/postEstado' , 'ConfiguracionController@insertarEstado');
	Route::get('Configuracion/getFuentes' , 'ConfiguracionController@getFuentes');
	Route::post('Configuracion/postFuente' , 'ConfiguracionController@insertarFuente');
	Route::get('Configuracion/getMonedas','ConfiguracionController@getMonedas');
	Route::post('Configuracion/postMoneda','ConfiguracionController@insertarMoneda');
#################Local
	Route::get('Local/Facturas' , 'LocalController@index');
	Route::get( 'Local/getFacturas/opcion/{opcion}/valor/{valor}/mes/{mes}/anio/{anio}' , 'LocalController@get_Facturas' );
	Route::get( 'Local/Facturar' , 'FacturaRapidaController@index' );

	

//############################################################
/*Consultar Informacion*/
	Route::get('Informacion/Fase1/{proyecto}' , 'InformacionController@Fase1')->middleware('guest');
//############################################################
/*Mis Recordatorios*/
	Route::get('MisRecordatorios' , 'MisRecordatoriosController@index')->middleware('guest');
