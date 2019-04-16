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
Route::get('editGestion/{id}','GestionController@edit');
//envia los datos modificados de la gestion
Route::post('updateGestion','GestionController@update');
//formulario de confirmacion
Route::get('confirmGestion/{id}','GestionController@confirm');
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
Route::post('storeUnidad','UnidadController@store');
// Formulario de Editar Unidad Ejecutora
Route::get('editUnidad/{id}','UnidadController@edit');
// Recibe los datos a modificar de la Unidad Ejecutora
Route::post('updateUnidad','UnidadController@update');
// Formulario de Confirmacion de eliminar
Route::get('confirmUnidad/{id}','UnidadController@confirm');
// ELimina el registro de Unida Ejecutora
Route::post('destroyUnidad','UnidadController@destroy');
/** FIN */

/** ACCIONES PARA MODULO DE DISTRITO */
//Muestra el formulario para buscar Distrito
Route::get('findDistrito','DistritoController@index');
// Envia los datos a buscar un Distrito
Route::post('findDistrito','DistritoController@show');
// Muestra el Formulario para nuevo distrito
Route::get('createDistrito','DistritoController@create');
// Recibe los datos de nuevo Distrito
Route::post('storeDistrito','DistritoController@store');
// Formulario con los datos a modificar el Distrito
Route::get('editDistrito/{id}','DistritoController@edit');
// Recibe los datos a modificar el Distrito
Route::post('updateDistrito','DistritoController@update');
// Formulario de Confirmacion para eliminar Distrito
Route::get('confirmDistrito/{id}','DistritoController@confirm');
// Elimina el registro de Distrito
Route::post('destroyDistrito','DistritoController@destroy');
/** FIN */

/** ACCIONES PARA MODULO DE MONTO */
//Muestra el formulario para buscar Monto
Route::get('findMonto','MontoController@index');
// Envia los datos a buscar un Monto
Route::post('findMonto','MontoController@show');
// Muestra el Formulario para nuevo Monto
Route::get('createMonto','MontoController@create');
// Recibe los datos de nuevo Monto
Route::post('storeMonto','MontoController@store');
// Formulario con los datos a modificar el Monto
Route::get('editMonto/{id}','MontoController@edit');
// Recibe los datos a modificar el Monto
Route::post('updateMonto','MontoController@update');
// Formulario de Confirmacion para eliminar Monto
Route::get('confirmMonto/{id}','MontoController@confirm');
// Elimina el registro de Monto
Route::post('destroyMonto','MontoController@destroy');
/** FIN */