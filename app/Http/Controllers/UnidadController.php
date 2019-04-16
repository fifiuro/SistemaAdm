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
                        ->where('gestion.id_ges','=',$request->gestion)
                        ->select('unidad.id_uni','gestion.gestion','unidad.unidad_ejecutora','unidad.estado')
                        ->get();
                
        $gestion = Gestion::all();

        if(count($unidad) > 0){
            return view('unidad.findUnidad',array('unidad' => $unidad,
                                                  'gestion' => $gestion,
                                                  'estado' => true));
        }else{
            return view('unidad.findUnidad',array('unidad' => '',
                                                  'gestion' => $gestion,
                                                  'estado' => false,
                                                  'mensaje' => 'No se tuvieron coincidencias con: '.$request->unidad.' o '.$request->gestion));

        }
    }

    /** Show the form for creating a new resource.
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
        $unidad->unidad_ejecutora = $request->unidad;
        $unidad->fecha_reg = date('Y-m-d');
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
        $unidad = Unidad::join('gestion','gestion.id_ges','=','unidad.id_ges')
                        ->where('id_uni','=',$id)
                        ->get();

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

        $unidad->unidad_ejecutora = $request->unidad;
        $unidad->estado = $request->estado;

        $unidad->save();

        return redirect('findUnidad');
    }

    public function confirm($id)
    {
        return view('unidad.deleteUnidad',array('id' => $id));
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

}
