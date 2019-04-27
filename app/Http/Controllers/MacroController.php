<?php

namespace App\Http\Controllers;

use App\Macro;
use App\Unidad;
use App\UnidadMacro;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarMacroRequest;

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
                    
        $macro = Unidad::join('unidad_macro','unidad_macro.id_uni','=','unidad.id_uni')
                       ->join('macro','macro.id_mac','=','unidad_macro.id_mac')
                       ->where('unidad.id_uni','=',$request->id_uni)
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
        $unidad = Unidad::all();

        return view('macro.createMacro',array('unidad' => $unidad));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarMacroRequest $request)
    {
        $macro = new Macro;

        $macro->nombre_mac = $request->nombre_mac;
        $macro->numero_mac = $request->numero_mac;
        $macro->estado = 1;

        $macro->save();

        $id_mac = $macro->id_mac;

        for($i=0; $i<count($request->id_uni); $i++){
            $un_ma = new UnidadMacro;

            $un_ma->id_uni = $request->id_uni[$i];
            $un_ma->id_mac = $id_mac;
            $un_ma->estado = 1;

            $un_ma->save();
        }

        $unidad = Unidad::all();

        return view('macro.findMacro', array('unidad' => $unidad));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $macro = Macro::find($id);

        $unma = UnidadMacro::where('id_mac','=',$id)->get();

        $unidad = Unidad::all();

        return view('macro.updateMacro',array('unidad' => $unidad, 'macro' => $macro, 'unma' => $unma));
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

        $this->comparaCD($request->id_mac,$request->id_uni);

        $unidad = Unidad::all();

        //return view('macro.findMacro',array('unidad' => $unidad));

    }

    public function comparaCD($id, $unidad)
    {
        /** Elimina la unidad que no esta presente el array del Formulario */
        $camp = UnidadMacro::where('id_mac','=',$id)->get();

        foreach($camp as $key => $c){
            if(in_array($c->id_uni, $unidad)){

            }else{
                $un_ma = UnidadMacro::where('id_uni','=',$c->id_uni)->where('id_mac','=',$id)->delete();
            }
        }

        /** Agrega la nueva unidad asignada  */
        $camp = UnidadMacro::where('id_mac','=',$id)->get();

        $vec = array();

        foreach($camp as $key => $c){
            array_push($vec,$c->id_uni);
        }

        for($i=0; $i<count($unidad); $i++){
            if(in_array($unidad[$i],$vec)){
                echo "SI";
            }else{
                $un_ma = new UnidadMacro;

                $un_ma->id_uni = $unidad[$i];
                $un_ma->id_mac = $id;
                $un_ma->estado = 1;

                $un_ma->save();
                echo "NO";
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        return view('macro.deleteMacro', array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $macro = Macro::find($request->id_mac);

        $macro->delete();

        $unidad = Unidad::all();

        return view('macro.findMacro', array('unidad' => $unidad));
    }
}
