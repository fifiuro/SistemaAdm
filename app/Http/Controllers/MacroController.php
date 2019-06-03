<?php

namespace App\Http\Controllers;

use App\Macro;
use App\Unidad;
use App\UnidadMacro;
use App\Modificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('macro.findMacro');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Macro  $macro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $macro = Macro::where('nombre_mac','like','%'.$request->nombre.'%')->get();

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
        return view('macro.createMacro');
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

        return view('macro.updateMacro',array('macro' => $macro));
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

        if($this->modificacion('macro',$request->id_mac,$request->nombre_mac,$request->nombre_macA)){
            $macro->nombre_mac = $request->nombre_mac;
        }
        if($this->modificacion('macro',$request->id_mac,$request->numero_mac,$request->numero_macA)){
            $macro->numero_mac = $request->numero_mac;
        }
        if($this->modificacion('macro',$request->id_mac,$request->estado,$request->estadoA)){
            $macro->estado = $request->estado;
        }

        $macro->save();

        return view('macro.findMacro');
    }

    public function modificacion($tabla,$id,$a,$b)
    {
        if($a != $b){
            $mod = new Modificacion;
            $mod->tabla = $tabla;
            $mod->id = $id;
            $mod->actual = $a;
            $mod->anterior = $b;
            $mod->fecha = date('Y-m-d');
            $mod->use_id = Auth::user()->id;
            $mod->save();

            return true;
        }else{
            return false;
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

    public function listaMacro(Request $request)
    {
        $result = UnidadMacro::join('macro','macro.id_mac','=','unidad_macro.id_mac')
                             ->where('unidad_macro.id_uni','=',$request->id)
                             ->select('macro.id_mac','macro.nombre_mac')
                             ->get();

        if(count($result) > 0){
            echo '<option value=""></option>';
            echo '<option value="0">Todo</option>';
            foreach($result as $key => $r){
                echo '<option value="'.$r->id_mac.'">'.$r->nombre_mac.'</option>';
            }
        }else{
            echo '';
        }
    }
}
