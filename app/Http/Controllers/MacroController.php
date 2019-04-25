<?php

namespace App\Http\Controllers;

use App\Macro;
use App\Unidad;
use Illuminate\Http\Request;

class MacroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidad = Unidad::all();

        return view('macro.findMacro', array('unidad' => $unidad));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $macro = Macro::join('unidad','unidad.id_uni','=','macro.id_uni')
                      ->where('id_uni','=',$request->id-uni)
                      ->where('nombre_mac','like','%'.$request->nombre.'%')
                      ->get();

        $unidad = Unidad::all();

        if(count($macro) > 0){
            return view('macro.findMacro',array('unidad' => $unidad,
                                                'macro' => $macro,
                                                'estado' => true));
        }else{
            return view('macro.findMacro',array('unidad' => $unidad,
                                                'macro' => $macro,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $macro = new Macro;

        $macro->nombre_mac = $request->nombre_mac;
        $macro->numero_mac = $request->numero_mac;
        $macro->estado = 1;

        $macro->save();

        $unidad = Unidad::all();

        return redirect('findMacro', array('unidad' => $unidad));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $macro = Macro::find($request->id_mac);

        return view('macro.updateMacro');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $macro = Macro::find($request->id_mac);

        $macro->nombre_mac = $request->nombre_mac;
        $macro->numero_mac = $request->numero_mac;
        $macro->estado = $request->estado;

        $macro->save();

        $unidad = Unidad::all();

        return redirect('findMacro',array('unidad' => $unidad));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function condfirm($id)
    {
        return view('macro.deleteMacro', array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reuqest $request)
    {
        $macro = Macro::find('$request->id_mac');

        $macro->delete();

        $unidad = Unidad::all();

        return redirect('findMacro', array('unidad' => $unidad));
    }
}
