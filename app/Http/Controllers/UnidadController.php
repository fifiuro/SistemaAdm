<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\Gestion;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestion = Gestion::all();

        return view('unidad.findUnidad', array('gestion' => $gestion));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $unidad = Unidad::join('gestion','gestion.id_ges','=','unidad.id_ges')
                        ->where('unidad_ejecutora','like','%'.$request->unidad.'%')
                        ->where('gestion')
                        ->get();

        if(count($unidad) > 0){
            return view('unidad.findUnidad',array('unidad' => $unidad,
                                                'estado' => true));
        }else{
            return view('unidad.findUnidad',array('unidad' => '',
                                                'estado' => false,
                                                'mensaje' => 'No se tuvieron coincidencias con: '.$request->unidad));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gestion = Gestion::where('estado','=',true)->get();

        return view('unidad.createUnidad', array('gestion' => $gestion));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unidad = new Unidad;

        $unidad->id_ges = $request->id_ges;
        $unidad->nombre_ejecutora = $request->unidad;
        $unidad->fecha_reg = date();
        $unidad->estado = true;

        $unidad->save();

        return redirect('findUnidad');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidad = Unidad::find($id);

        return view('unidad.updateUnidad',array('unidad' => $unidad));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $unidad = Unidad::find($request->id_uni);

        $unidad->id_ges = $request->id_ges;
        $unidad->nombre_ejecutora = $request->unidad;
        $unidad->estado = $request->estado;

        $unidad->save();

        return redirect('findUnidad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $unidad = Unidad::find($request->id_uni);

        $unidad->delete();

        return redirect('findUnidad');
    }

    public function confirm($id)
    {
        return view('unidad.confirmUnidad',$id);
    }
}
