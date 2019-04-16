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
Route::get('findDistrito','DistritoCOntroller@index');
// Envia los datos a buscar un Distrito
Route::post('findDistrito','DistritoCOntroller@show');
// Muestra el Formulario para nuevo distrito
Route::get('createDistrito','DistritoCOntroller@create');
// Recibe los datos de nuevo Distrito
Route::get('storeDistrito','DistritoCOntroller@store');
// Formulario con los datos a modificar el Distrito
Route::get('editDistrito','DistritoCOntroller@edit');
// Recibe los datos a modificar el Distrito
Route::post('updateDistrito','DistritoCOntroller@update');
// Formulario de Confirmacion para eliminar Distrito
Route::get('confimrDistrito','DistritoCOntroller@confirm');
// Elimina el registro de Distrito
Route::get('destroyDistrito','DistritoCOntroller@destroy');
/** FIN */