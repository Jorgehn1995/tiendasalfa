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

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@authlogin')->name('authlogin');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/', 'LoginController@check')->name('logincheck');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/',function(){
        return view('admin.index');
    })->name('admin.index');
    
    Route::resource('usuarios', 'UsuariosController');
    Route::resource('sucursales', 'SucursalesController');
    Route::resource('productos', 'ProductosController');

    /** Rutas para modulo productos */
    Route::get('productos/busqueda/{barras}','ProductosController@busquedaajax');
    Route::get('productos/json/categorias','ProductosController@categorias');
    Route::post('productos/json/store','ProductosController@store');
    Route::get('productos/json/sucursales/{id}','ProductosController@revisarexistencia');
    Route::post('productos/json/existencia','ProductosController@agregarexistencia');
    Route::post('productos/json/addpresentacion/','ProductosController@agregarpresentacion');
    Route::post('productos/json/eliminarpresentacion/','ProductosController@eliminarpresentacion');
    Route::get('productos/json/presentaciones/{id}','ProductosController@presentaciones');

    /** Rutas para modulo venta */
    Route::get('venta/{sucursal}','VentasController@login')->name("ventas.sucursal");
    Route::get('venta/temp/load','VentasController@temp');
    Route::post('venta/json/agregar','VentasController@seektotemp');
    Route::get('venta/json/limpiartemp','VentasController@limpiartemp');
    Route::post('venta/json/procesar','VentasController@procesar');
    Route::get('venta/selecionar/sucursal','VentasController@index')->name("ventas.index");


    /** rutas para reportes */
    //reporte ventasdia
    Route::get('reportes/dia/','ReportesController@index')->name("reportes.index");
    Route::get('reportes/dia/{id}','ReportesController@dia')->name("reportes.dia");
    //reportes fechados
    Route::get('reportes/fechados/{sucursal}/{inicio}/{fin}','ReportesController@fechados')->name("reportes.fechados");
    Route::get('reportes/json/fechados/{sucursal}/{inicio}/{fin}','ReportesController@jsonfechados')->name("reportes.jsonfechados");
    //reportes inversiones
    Route::get('reportes/json/inversiones','ReportesController@jsoninversiones')->name("reportes.jsoninversiones");
    Route::get('reportes/inversiones','ReportesController@inversiones')->name("reportes.inversiones");

    //json dashboard
    Route::get('dashboard/json/inicio','ReporteMesController@index')->name("json.index");

    //json dashboard
    Route::get('reportes/inicio','ReporteMesController@sucursal')->name("reportes.inicio.sucursal");
    //Route::get('reportes/inicio/json','JsonController@index')->name("json.index");
    Route::get('reportes/inicio/json/{id}/{intevalo}','JsonController@index')->name("json.index");
    Route::get('reportes/inicio/detalles/{idventa}','JsonController@detalles')->name("json.index");
    //reportes caducidad
    Route::get('reportes/caducidad','ReportesController@caducidad')->name("reportes.caducados");
    //Route::get('reportes/caducidad/json','ReportesController@inversiones')->name("reportes.inversiones");
});
