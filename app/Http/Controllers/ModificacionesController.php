<?php

namespace App\Http\Controllers;

use App\Modificacion;
use Illuminate\Http\Request;

class ModificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabla = array('Unidad','Macro Distrito','Distrito','Proyecto');

        return view('reporte.findModificaciones',array('tabla' => $tabla));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modificaciones  $modificaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $tabla = array('unidad','Macro Distrito','distrito','proyecto');
        $fecha = explode(" - ",$request->fecha);
        $result = Modificacion::join('users','users.id','=','modificacion.id')
                              ->where('tabla','=',$request->tabla)
                              ->whereBetween('fecha',array(formatoFecha($fecha[0]),formatoFecha($fecha[1])))
                              ->where('name','like','%'.$request->nombre.'%')
                              ->get();
                              
        if(count($result) > 0){
            return view('reporte.findModificaciones',array(
                'tabla' => $tabla,
                'result' => $result,
                'estado' => true
            ));
        }else{
            return view('reporte.findModificaciones',array(
                'tabla' => $tabla,
                'result' => '',
                'estado' => false,
                'mensaje' => 'No se tuvieron coincidencias.'
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modificaciones  $modificaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Modificaciones $modificaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modificaciones  $modificaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modificaciones $modificaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modificaciones  $modificaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modificaciones $modificaciones)
    {
        //
    }
}
