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
    if (Auth::check()){
        return view('inicio');
    }else{
        return view('auth.login');
    }
});

Route::group(['middleware' => 'auth'], function(){
    // Pagina de Inicio
    Route::get('inicio', function () { return view('inicio'); });
    
    /**ACCIONES PARA LE MODULO GESTION */
    //muestra comentario de tgestrion
    Route::get('findGestion','GestionController@index')->middleware('ruta:findGestion');
    //encia los datos a buscar en la base de datos
    Route::post('findGestion','GestionController@show')->middleware('tipo:findGestion');
    //mostrara el formulario de nueva gestion
    Route::get('createGestion','GestionController@create')->middleware('tipo:createGestion');
    //recibe los datos a resgistrar en la base de datos
    Route::post('storeGestion','GestionController@store')->middleware('tipo:storeGestion');
    //envia lso datos para modificar
    Route::get('editGestion/{id}','GestionController@edit')->middleware('tipo:editGestion');
    //envia los datos modificados de la gestion
    Route::post('updateGestion','GestionController@update')->middleware('tipo:updateGestion');
    //formulario de confirmacion
    Route::get('confirmGestion/{id}','GestionController@confirm')->middleware('tipo:confirmGestion');
    //eliminar la gestion
    Route::post('destroyGestion','GestionController@destroy')->middleware('tipo:destroyGestion');
    /**FIN */

    /** ACIONES PARA EL MODULO UNIDAD EJECUTORA */
    // Muestra el formulario para buscar Unidad Ejecutora
    Route::get('findUnidad','UnidadController@index')->middleware('tipo:findUnidad');
    // Envia los datos a buscar
    Route::post('findUnidad','UnidadController@show')->middleware('tipo:findUnidad');
    // Muestra el formulario par Nueva Unidad Ejecutora
    Route::get('createUnidad','UnidadController@create')->middleware('tipo:createUnidad');
    // Recibe los datos de Nueva Unidad Ejecutora
    Route::post('storeUnidad','UnidadController@store')->middleware('tipo:storeUnidad');
    // Formulario de Editar Unidad Ejecutora
    Route::get('editUnidad/{id}','UnidadController@edit')->middleware('tipo:editUnidad');
    // Recibe los datos a modificar de la Unidad Ejecutora
    Route::post('updateUnidad','UnidadController@update')->middleware('tipo:updateUnidad');
    // Formulario de Confirmacion de eliminar
    Route::get('confirmUnidad/{id}','UnidadController@confirm')->middleware('tipo:confirmUnidad');
    // ELimina el registro de Unida Ejecutora
    Route::post('destroyUnidad','UnidadController@destroy')->middleware('tipo:destroyUnidad');
    /** FIN */

    /** ACCIONES PARA EL MODULO DE MACRO DISTRITO */
    // Muestra el formulario para buscar Macro Distrito
    Route::get('findMacro','MacroController@index')->middleware('tipo:findMacro');
    // Muestra el resultado de la busqueda de Macro Distrito
    Route::post('findMacro','MacroController@show')->middleware('tipo:findMacro');
    // Muestra el formulario para un nuevo Macro Distrito
    Route::get('createMacro','MacroController@create')->middleware('tipo:createMacro');
    // Recibe los datos a guardar del Macro Distrito
    Route::post('storeMacro','MacroController@store')->middleware('tipo:storeMacro');
    // Formulario con los datos a modificar Macro Distrito
    Route::get('editMacro/{id}','MacroController@edit')->middleware('tipo:editMacro');
    // Recibe los datos a modificar Macro Distrito
    Route::post('updateMacro','MacroController@update')->middleware('tipo:updateMacro');
    // Formulario de confirmacion de ELiminar el Macro Distrito
    Route::get('confirmMacro/{id}','MacroController@confirm')->middleware('tipo:confirmMacro');
    // Elimina el Macro Distrito
    Route::post('destroyMacro','MacroController@destroy')->middleware('tipo:destroyMacro');
    // Recupera la lista de Macro Distrito
    Route::post('listaMacro','MacroController@listaMacro')->middleware('tipo:listaMacro');
    /** FIN */

    /** ACCIONES PARA MODULO DE DISTRITO */
    //Muestra el formulario para buscar Distrito
    Route::get('findDistrito','DistritoController@index')->middleware('tipo:findDistrito');
    // Envia los datos a buscar un Distrito
    Route::post('findDistrito','DistritoController@show')->middleware('tipo:findDistrito');
    // Muestra el Formulario para nuevo distrito
    Route::get('createDistrito','DistritoController@create')->middleware('tipo:createDistrito');
    // Recibe los datos de nuevo Distrito
    Route::post('storeDistrito','DistritoController@store')->middleware('tipo:storeDistrito');
    // Formulario con los datos a modificar el Distrito
    Route::get('editDistrito/{id}','DistritoController@edit')->middleware('tipo:editDistrito');
    // Recibe los datos a modificar el Distrito
    Route::post('updateDistrito','DistritoController@update')->middleware('tipo:updateDistrito');
    // Formulario de Confirmacion para eliminar Distrito
    Route::get('confirmDistrito/{id}','DistritoController@confirm')->middleware('tipo:confirmDistrito');
    // Elimina el registro de Distrito
    Route::post('destroyDistrito','DistritoController@destroy')->middleware('tipo:destroyDistrito');
    // Formulario de buscar proyecto Supervision de Proyectos
    Route::get('supervisar/{id}/{cod}','DistritoController@supervisar')->middleware('tipo:supervisar');
    // Recupera la lista de Distrito
    Route::post('listaDistrito','DistritoController@listaDistrito')->middleware('tipo:listaDistrito');
    /** FIN */

    /** ACCIONES PARA ASIGNACION */
    // Formulario para la Asignacion
    Route::get('findAsignacion','asignacionController@index')->middleware('tipo:findAsignacion');
    // Guardar la asignacionde Macro - Unidad
    Route::post('storeUnidadMacro','AsignacionController@storeUnidadMacro')->middleware('tipo:storeUnidadMacro');
    // realizar la busqueda de los macros distrito y los que pertenecen a Unida Ejecutora
    Route::post('showMacroUnidad','AsignacionController@showMacroUnidad')->middleware('tipo:showMacroUnidad');
    // Eliminar la asignacion Macro - Unidad
    Route::post('destroyUnidadMacro','AsignacionController@destroyUnidadMacro')->middleware('tipo:destroyUnidadMacro');
    /** FIN */

    /** ACCIONES PARA MODULO DE PROYECTO */
    //Muestra el formulario para buscar proyecto
    Route::get('findProyecto','ProyectoController@index')->middleware('tipo:findProyecto');
    // Envia los datos a buscar un proyecto
    Route::post('findProyecto','ProyectoController@show')->middleware('tipo:findProyecto');
    // Muestra el Formulario para nuevo proyecto
    Route::get('createProyecto','ProyectoController@create')->middleware('tipo:createProyecto');
    // Recibe los datos de nuevo Proyecto
    Route::post('storeProyecto','ProyectoController@store')->middleware('tipo:storeProyecto');
    // Formulario con los datos a modificar el Proyecto
    Route::get('editProyecto/{id}','ProyectoController@edit')->middleware('tipo:editProyecto');
    // Recibe los datos a modificar el Proyecto
    Route::post('updateProyecto','ProyectoController@update')->middleware('tipo:updateProyecto');
    // Formulario de Confirmacion para eliminar Proyecto
    Route::get('confirmProyecto/{id}','ProyectoController@confirm')->middleware('tipo:confirmProyecto');
    // Elimina el registro de Proyecto
    Route::post('destroyProyecto','ProyectoController@destroy')->middleware('tipo:destroyProyecto');
    // Reporte de Proyecto con Volumenes
    Route::get('reporteProyecto/{id}','ProyectoController@reporteProyecto')->middleware('tipo:reporteProyecto');
    //
    /** FIN */

    /** ACCIONES PARA MODULO DE VOLUMEN */
    // Muestra el formulario con los datos de Proyecto y el 
    // formulario de ingresar el volumen por fecha
    Route::get('findVolumen/{id}','VolumenController@index')->middleware('tipo:findVolumen');
    // Envia los datos para se guardados del Volumen
    Route::post('storeVolumen','VolumenController@store')->middleware('tipo:storeVolumen');
    // Muestra el formulario con los datos a modificar
    Route::get('editVolumen/{id}','VolumenController@edit')->middleware('tipo:editVolumen');
    // Envia los datos modificados de Volumen
    Route::post('updateVolumen','VolumenController@update')->middleware('tipo:updateVolumen');
    // Formulario de Confirmacion de eliminar Volumen
    Route::get('confirmVolumen/{id}/{id_pro}','VolumenController@confirm')->middleware('tipo:confirmVolumen');
    // Elimina el registro de Volumen
    Route::post('destroyVolumen','VolumenController@destroy')->middleware('tipo:destroyVolumen');
    /** FIN */

    /** ACCIONES PARA MODULO DE ESTMIACION */
    // Muestra el formulario con los datos del Proyecto y el
    // formulario para ingresar el Estimado con fecha
    Route::get('findEstimado/{id}','EstimadoController@index')->middleware('tipo:findEstimado');
    // Envia los datos para ser guardados del Estimado
    Route::post('storeEstimado','EstimadoController@store')->middleware('tipo:storeEstimado');
    // Formulario con los datos a modificar Estimado
    Route::get('editEstimado/{id}','EstimadoController@edit')->middleware('tipo:editEstimado');
    // Envia los datos a mosdificar Estimado
    Route::post('updateEstimado','EstimadoController@update')->middleware('tipo:updateEstimado');
    // Formulario de Confirmacion de eliminar Estimado
    Route::get('confirmEstimado/{id}/{id_pro}','EstimadoController@confirm')->middleware('tipo:confirmEstimado');
    // Elimna el registro de Estimado
    Route::post('destroyEstimado','EstimadoController@destroy')->middleware('tipo:destroyEstimado');
    /** FIN */

    /** ACCIONES PARA EL MODULO DE USUARIOS */
    // Formulario para buscar Usuarios
    Route::get('findUsuario','UsuarioController@index')->middleware('tipo:findUsuario');
    // Envia datos a buscar a Usuarios
    Route::post('findUsuario','UsuarioController@show')->middleware('tipo:findUsuario');
    // Formulario par el registro de Nuevo Usuario
    Route::get('createUsuario','Auth\RegisterController@showRegistrationForm')->middleware('tipo:createUsuario');
    // Muestra el formulario con los datos a Modificar
    Route::get('editUsuario/{id}','UsuarioController@edit')->middleware('tipo:editUsuario');
    // Envia los datos a modificar de Usuario
    Route::post('updateUsuario','UsuarioController@update')->middleware('tipo:updateUsuario');
    // Formulario de COnfirmacion de eliminar Usuario
    Route::get('confirmUsuario/{id}','UsuarioController@confirm')->middleware('tipo:confirmUsuario');
    // Elimina el registro de Usuario
    Route::post('destroyUsuario','UsuarioCOntroller@destroy')->middleware('tipo:destroyUsuario');
    /** FIN */

    /** ACCIONES EN EL SEGUIMIENTO DE PROYECTOS */
    // Formulario de busqueda de Seguimiento de Proyectos
    Route::get('findSeguimiento', 'SeguimientoController@index')->middleware('tipo:findSeguimiento');
    // Datos para hacer la gusqueda de del Proyecto hacer el seguimiento
    Route::post('findSeguimiento', 'SeguimientoController@show')->middleware('tipo:findSeguimiento');
    // Formulario de busqieda de Detalle de Proyecto
    Route::get('findDetalle','SeguimientoController@indexDetalle')->middleware('tipo:findDetalle');
    // Datos para hacer la busqueda del Detalle del Proyecto
    Route::post('findDetalle','SeguimientoController@showDetalle')->middleware('tipo:findDetalle');
    // Exportar a excel el Proyecto
    Route::get('exportarExcel/{id}','SeguimientoController@exportarExcel')->middleware('tipo:exportarExcel');
    /** FIN */

    /** ACCIONES PARA TODAS LAS MODIFICACIONES DEL PROYECTO */
    // Formulario de busqueda de Modificaciones
    Route::get('findModificaciones','ModificacionesController@index')->middleware('tipo:findModificaciones');
    // Datos para hacer la busqueda de modificaciones
    Route::post('findModificaciones','ModificacionesController@show')->middleware('tipo:findModificaciones');
    /** FIN */
});

Auth::routes();