<?php

namespace App\Http\Controllers;

use App\Distrito;
use App\Unidad;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidad = Unidad::find();

        return view('distrito.findDistrito', array('unidad' => $unidad));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $distrito = Distrito::where('nombre_dis','like','%'.$request->nombre.'%')
                            ->where('id_uni','=',$request->id_uni)
                            ->get();

        if(count($ditrito) > 0){
            return view('distrito.findDistrito',array('distrito' => $distrito,
                                                      'estado' => true));
        }else{
            return view('distrito.findDistrito',array('distrito' => '',
                                                    'estado' => false,
                                                    'mensaje' => 'No se tuvieron coincidencias con: '.$request->nombre.' o '.$request->distrito));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidad = Unidad::where('estado','=',1)->get();

        return view('distrito.createDistrito', array('unidad' => $unidad));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distrito = new Distrito;

        $distrito->id_uni = $request->id_uni;
        $distrito->nombre_dis = $request->nombre;
        $distrito->numero_dis = $request->numero;
        $distrito->ubicacion = $request->ubicacion;
        $distrito->estado = 1;

        $distrito->save();

        return redirect('findDistrito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distrito = Distrito::find($id);

        return view('distrito.updateDistrito',array('distrito' => $distrito));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $distrito = Distrito::find($request->id_dist);

        $distrito->nombre_dis = $request->nombre;
        $distrito->numero_dis = $request->numero;
        $distrito->ubicacion = $request->ubicacion;
        $distrito->estado = $request->estado;

        $distrito->save();

        return redirect('findDistrito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        return view('distrito.deleteDistrito',array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $distrito = Distrito::find($request->id);

        $distrito->delete();

        return redirect('findDistrito');
    }
}
