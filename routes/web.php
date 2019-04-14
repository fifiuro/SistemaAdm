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
hdhdjhfj

/**FIN */
