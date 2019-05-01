<?php

namespace App\Http\Controllers;

use App\Estimado;
use App\Proyecto;
use App\modificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proy = Proyecto::find($id);

        $estimado = Estimado::where('id_pro','=',$id)
                            ->orderBy('fecha','desc')
                            ->get();

        if(count($estimado) > 0){
            return view('estimado.findEstimado', array('proy' => $proy,
                                                        'estimado' =>$estimado,
                                                        'estado' => true));
        }else{
            return view('estimado.findEstimado', array('proy' => $proy,
                                                        'estimado' => '',
                                                        'estado' => false,
                                                        'mensaje' => 'No se tiene nigun Estimado registrado.'));
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
        $estimado = new Estimado;

        $estimado->id_pro = $request->id_pro;
        $estimado->fecha = formatoFecha($request->fecha);
        $estimado->volumen = $request->monto;
        $estimado->estado = 1;

        $estimado->save();

        return redirect('findEstimado/'.$request->id_pro);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $estimado = Estimado::find($id);

        return view('estimado.updateEstimado', array('estimado' => $estimado));
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
        $estimado = Estimado::find($request->id_est);

        if($this->modificacion('estimado',$request->id_est,formatoFecha($request->fecha),$request->fechaA)){
            $estimado->fecha = formatoFecha($request->fecha);
        }
        if($this->modificacion('estimado',$request->id_est,$request->monto,$request->montoA)){
            $estimado->volumen = $request->monto;
        }

        $estimado->save();

        return redirect('findEstimado/'.$request->id_pro);
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
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function confirm($id,$id_pro)
    {
        return view('estimado.deleteEstimado', array('id' => $id, 'id_pro' => $id_pro));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $estimado = Estimado::find($request->id_est);

        $estimado->delete();

        return redirect('findEstimado/'.$request->id_pro);
    }
}
