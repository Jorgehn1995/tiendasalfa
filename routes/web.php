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
    Route::get('productos/busqueda/{barras}','ProductosController@busquedaajax');
    Route::get('productos/json/categorias','ProductosController@categorias');
    Route::post('productos/json/store','ProductosController@store');
    Route::get('productos/json/sucursales/{id}','ProductosController@revisarexistencia');
    Route::post('productos/json/existencia','ProductosController@agregarexistencia');
    Route::get('venta/{sucursal}','VentasController@login');
    Route::get('venta/temp/load','VentasController@temp');
});