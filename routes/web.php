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

Route::get('/', function () {
    return view('inicio');
});

/** ACCIONES PARA EL MODULO UNIDAD EJECUTORA */
// Muestra el formulario de Buscar Unidad
Route::get('findUnidad','UnidadController@index');
// Envia los datos a buscar en el base de datos
Route::post('findUnidad','UnidadController@show');
// Mostrara el formulario de nueva Unidad
Route::get('createUnidad','UnidadController@create');
// Recibe los datos a registrar en la base de datos
Route::post('storeUnidad','UnidadController@store');
// Enviar los datos a buscar a modificar Unidad
Route::get('editUnidad','UnidadController@edit');
// Enviar los datos modificador de la Unidad
Route::post('editUnidad','UnidadController@update');
// Formulario de confirmacion
Route::get('confirmUnidad','UnidadController@confirm');
// Eliminar la Unidad
Route::post('destroyUnidad','UnidadController@destroy');
/** FIN */
