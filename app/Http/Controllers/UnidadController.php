<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\Gestion;
use App\Modificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarUnidadRequest;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unidad.findUnidad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $unidad = Unidad::where('unidad_ejecutora','like','%'.$request->unidad.'%')->get();

        if(count($unidad) > 0){
            return view('unidad.findUnidad',array('unidad' => $unidad,
                                                  'estado' => true));
        }else{
            return view('unidad.findUnidad',array('unidad' => '',
                                                  'estado' => false,
                                                  'mensaje' => 'No se tuvieron coincidencias.'));

        }
    }

    /** Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidad.createUnidad');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarUnidadRequest $request)
    {
        $unidad = new Unidad;

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
    public function update(ValidarUnidadRequest $request)
    {
        $unidad = Unidad::find($request->id_uni);

        if($this->modificacion('unidad',$request->id_uni,$request->unidad,$request->unidadA)){
            $unidad->unidad_ejecutora = $request->unidad;
        }
        if($this->modificacion('unidad',$request->id_uni,$request->estado,$request->estadoA)){
            $unidad->estado = $request->estado;
        }

        $unidad->save();

        return redirect('findUnidad');
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
