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

/**ACCIONES PARA LE MODULO GESTION */
//muestra comentario de tgestrion
Route::get('findGestion','GestionController@index');
//encia los datos a buscar en la base de datos
Route::post('findGestion','GestionController@show');
//mostrara el formulario de nueva gestion
Route::get('createGestion','GestionController@create');
//recibe los datos a resgistrar en la base de datos
Route::post('storeGestion','GestionController@store');
//envia lso datos para modificar
Route::get('editGestion','GestionController@edit');
//envia los datos modificados de la gestion
Route::post('editGestion','GestionController@update');
//formulario de confirmacion
Route::get('confirmGestion','GestionController@confirm');
//eliminar la gestion
Route::post('destroyGestion','GestionController@destroy');
/**FIN */

/** ACIONES PARA EL MODULO UNIDAD EJECUTORA */
// Muestra el formulario para buscar Unidad Ejecutora
Route::get('findUnidad','UnidadController@index');
// Envia los datos a buscar
Route::post('findUnidad','UnidadController@show');
// Muestra el formulario par Nueva Unidad Ejecutora
Route::get('createUnidad','UnidadController@create');
// Recibe los datos de Nueva Unidad Ejecutora
Route::get('storeUnidad','StoreController@store');
// Formulario de Editar Unidad Ejecutora
Route::get('editUnidad','StoreController@edit');
// Recibe los datos a modificar de la Unidad Ejecutora
Route::get('updateUnidad','StoreController@update');
// Formulario de Confirmacion de eliminar
Route::get('confirmUnidad','StoreController@confirm');
// ELimina el registro de Unida Ejecutora
Route::get('destroyUnidad','StoreController@destroy');