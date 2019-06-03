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

    /** ACCIONES PARA EL MODULO DE MACRO DISTRITO */
    // Muestra el formulario para buscar Macro Distrito
    Route::get('findMacro','MacroController@index');
    // Muestra el resultado de la busqueda de Macro Distrito
    Route::post('findMacro','MacroController@show');
    // Muestra el formulario para un nuevo Macro Distrito
    Route::get('createMacro','MacroController@create');
    // Recibe los datos a guardar del Macro Distrito
    Route::post('storeMacro','MacroController@store');
    // Formulario con los datos a modificar Macro Distrito
    Route::get('editMacro/{id}','MacroController@edit');
    // Recibe los datos a modificar Macro Distrito
    Route::post('updateMacro','MacroController@update');
    // Formulario de confirmacion de ELiminar el Macro Distrito
    Route::get('confirmMacro/{id}','MacroController@confirm');
    // Elimina el Macro Distrito
    Route::post('destroyMacro','MacroController@destroy');
    // Recupera la lista de Macro Distrito
    Route::post('listaMacro','MacroController@listaMacro');
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
    // Formulario de buscar proyecto Supervision de Proyectos
    Route::get('supervisar/{id}/{cod}','DistritoController@supervisar');
    // Recupera la lista de Distrito
    Route::post('listaDistrito','DistritoController@listaDistrito');
    /** FIN */

    /** ACCIONES PARA ASIGNACION */
    // Formulario para la Asignacion
    Route::get('findAsignacion','asignacionController@index');
    // Guardar la asignacionde Macro - Unidad
    Route::post('storeUnidadMacro','AsignacionController@storeUnidadMacro');
    // realizar la busqueda de los macros distrito y los que pertenecen a Unida Ejecutora
    Route::post('showMacroUnidad','AsignacionController@showMacroUnidad');
    // Eliminar la asignacion Macro - Unidad
    Route::post('destroyUnidadMacro','AsignacionController@destroyUnidadMacro');
    /** FIN */

    /** ACCIONES PARA MODULO DE PROYECTO */
    //Muestra el formulario para buscar proyecto
    Route::get('findProyecto','ProyectoController@index');
    // Envia los datos a buscar un proyecto
    Route::post('findProyecto','ProyectoController@show');
    // Muestra el Formulario para nuevo proyecto
    Route::get('createProyecto','ProyectoController@create');
    // Recibe los datos de nuevo Proyecto
    Route::post('storeProyecto','ProyectoController@store');
    // Formulario con los datos a modificar el Proyecto
    Route::get('editProyecto/{id}','ProyectoController@edit');
    // Recibe los datos a modificar el Proyecto
    Route::post('updateProyecto','ProyectoController@update');
    // Formulario de Confirmacion para eliminar Proyecto
    Route::get('confirmProyecto/{id}','ProyectoController@confirm');
    // Elimina el registro de Proyecto
    Route::post('destroyProyecto','ProyectoController@destroy');
    // Reporte de Proyecto con Volumenes
    Route::get('reporteProyecto/{id}','ProyectoController@reporteProyecto');
    //
    /** FIN */

    /** ACCIONES PARA MODULO DE VOLUMEN */
    // Muestra el formulario con los datos de Proyecto y el 
    // formulario de ingresar el volumen por fecha
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

    /** ACCIONES PARA MODULO DE ESTMIACION */
    // Muestra el formulario con los datos del Proyecto y el
    // formulario para ingresar el Estimado con fecha
    Route::get('findEstimado/{id}','EstimadoController@index');
    // Envia los datos para ser guardados del Estimado
    Route::post('storeEstimado','EstimadoController@store');
    // Formulario con los datos a modificar Estimado
    Route::get('editEstimado/{id}','EstimadoController@edit');
    // Envia los datos a mosdificar Estimado
    Route::post('updateEstimado','EstimadoController@update');
    // Formulario de Confirmacion de eliminar Estimado
    Route::get('confirmEstimado/{id}/{id_pro}','EstimadoController@confirm');
    // Elimna el registro de Estimado
    Route::post('destroyEstimado','EstimadoController@destroy');
    /** FIN */

    /** ACCIONES PARA EL MODULO DE USUARIOS */
    // Formulario para buscar Usuarios
    Route::get('findUsuario','UsuarioController@index');
    // Envia datos a buscar a Usuarios
    Route::post('findUsuario','UsuarioController@show');
    // Formulario par el registro de Nuevo Usuario
    Route::get('createUsuario','Auth\RegisterController@showRegistrationForm');
    // Muestra el formulario con los datos a Modificar
    Route::get('editUsuario/{id}','UsuarioController@edit');
    // Envia los datos a modificar de Usuario
    Route::post('updateUsuario','UsuarioController@update');
    // Formulario de COnfirmacion de eliminar Usuario
    Route::get('confirmUsuario/{id}','UsuarioController@confirm');
    // Elimina el registro de Usuario
    Route::post('destroyUsuario','UsuarioCOntroller@destroy');
    /** FIN */

    /** ACCIONES EN EL SEGUIMIENTO DE PROYECTOS */
    // Formulario de busqueda de Seguimiento de Proyectos
    Route::get('findSeguimiento', 'SeguimientoController@index');
    // Datos para hacer la gusqueda de del Proyecto hacer el seguimiento
    Route::post('findSeguimiento', 'SeguimientoController@show');
    // Formulario de busqieda de Detalle de Proyecto
    Route::get('findDetalle','SeguimientoController@indexDetalle');
    // Datos para hacer la busqueda del Detalle del Proyecto
    Route::post('findDetalle','SeguimientoController@showDetalle');
    // Exportar a excel el Proyecto
    Route::get('exportarExcel/{id}','SeguimientoController@exportarExcel');
    /** FIN */

    /** ACCIONES PARA TODAS LAS MODIFICACIONES DEL PROYECTO */
    // Formulario de busqueda de Modificaciones
    Route::get('findModificaciones','ModificacionesController@index');
    // Datos para hacer la busqueda de modificaciones
    Route::post('findModificaciones','ModificacionesController@show');
    /** FIN */

});

Auth::routes();