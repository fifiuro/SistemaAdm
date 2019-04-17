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

/** ACCIONES PARA MODULO DE PROYECTO */
//Muestra el formulario para buscar proyecto
Route::get('findProyecto','ProyectoController@index');
// Envia los datos a buscar un proyecto
Route::post('findProyecto','ProyectoController@show');
// Muestra el Formulario para nuevo proyecto
Route::get('createProyecto','ProyectoController@create');
// Recibe los datos de nuevo Proyecto
Route::get('storeProyecto','ProyectoController@store');
// Formulario con los datos a modificar el Proyecto
Route::get('editProyecto','ProyectoController@edit');
// Recibe los datos a modificar el Proyecto
Route::post('updateProyecto','ProyectoController@update');
// Formulario de Confirmacion para eliminar Proyecto
Route::get('confimrProyecto','ProyectoController@confirm');
// Elimina el registro de Proyecto
Route::get('destroyProyecto','ProyectoController@destroy');
/** FIN */

/** ACCIONES PARA MODULO DE VOLUMEN */
// Muestra el formulario con los datos de Proyecto y el 
// formulario de ingresae el volumen por fecha
Route::get('findVolumen/{id}','VolumenController@index');
// Envia los datos para se guardados del Volumen
Route::post('storeVolumen','VolumenController@store');
// Muestra el formulario con los datos a modificar
Route::get('editVolumen/{id}','VolumenController@edit');
// Envia los datos modificados de Volumen
Route::post('updateVolumen','VolumenController@update');
// Formulario de Confirmacion de eliminar Volumen
Route::get('confirmVolumen/{id}/{id_pro}','VolumenController@confirm');
// Elimina el registro de Volumen
Route::post('destroyVolumen','VolumenController@destroy');
/** FIN */