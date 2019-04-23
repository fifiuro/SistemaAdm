<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Unidad;
use App\Distrito;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestion = Gestion::all();

        return view('seguimiento.findSeguimiento', array('gestion' => $gestion));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $gestion = Gestion::all();

        $seg = Gestion::join('unidad','unidad.id_ges','=','gestion.id_ges')
                      ->join('distrito','distrito.id_uni','=','unidad.id_uni')
                      ->where('gestion.id_ges','=',$request->gestion)
                      ->where('unidad.unidad_ejecutora','like','%'.$request->unidad.'%')
                      ->where('distrito.nombre_dis','like','%'.$request->distrito.'%')
                      ->get();

        if(count($seg) > 0){
            return view('seguimiento.findSeguimiento', array('gestion' => $gestion,
                                                             'seg' => $seg,
                                                             'estado' => true));
        }else{
            return view('seguimiento.findSeguimiento', array('gestion' => $gestion,
                                                             'seg' => '',
                                                             'estado' => false,
                                                             'mensaje' => 'No se tuvieron coincidencias.'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
