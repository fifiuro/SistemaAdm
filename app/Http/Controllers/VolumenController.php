<?php

namespace App\Http\Controllers;

use App\Volumen;
use App\Proyecto;
use App\Modificacion;
use App\Estimado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarVolumenRequest;

class VolumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proy = Proyecto::join('todo','todo.id_to','=','proyecto.id_to')
                            ->select('proyecto.id_pro', 'proyecto.id_to', 'proyecto.id_ges', 'proyecto.ubicacion', 'proyecto.ema', 'proyecto.fecha_reg', 'proyecto.presupuesto', 'proyecto.programado', 'proyecto.adjudicacion', 'proyecto.numero_adjudicacion', 'proyecto.fecha_contrato', 'proyecto.plazo', 'proyecto.fecha_adjudicacion', 'proyecto.estado', 'proyecto.observaciones')
                            ->selectRaw('ifnull((select unidad_ejecutora from unidad where id_uni = todo.id_uni),0) as unidad')
                            ->selectRaw('ifnull((select nombre_mac from macro where id_mac = todo.id_mac),0) as macro')
                            ->selectRaw('ifnull((select nombre_dis from distrito where id_dist = todo.id_dist),0) as distrito')
                            ->where('proyecto.id_pro','=',$id)
                            ->get();

        $volumen = Volumen::where('id_pro','=',$id)
                          ->orderBy('fecha','desc')
                          ->get();
        
        $estimado = Estimado::where('id_pro','=',$id)
                             ->orderBy('fecha','desc')
                             ->get();
        
        $sum = Volumen::selectRaw('sum(monto) total')
                      ->where('id_pro','=',$id)
                      ->groupBy('id_pro')
                      ->get();
        
        $sume = Estimado::selectRaw('sum(volumen) total')
                        ->where('id_pro','=',$id)
                        ->groupBy('id_pro')
                        ->get();

        if(count($estimado) > 0){
            return view('volumen.findVolumen', array('proy' => $proy, 
                                                     'volumen' => $volumen,
                                                     'estimado' => $estimado,
                                                     'sum' => $sum,
                                                     'sume' => $sume, 
                                                     'estado' => true));
        }else{
            return view('volumen.findVolumen', array('proy' => $proy, 
                                                     'volumen' => '',
                                                     'estimado' => '', 
                                                     'estado' => false,
                                                     'mensaje' => 'No se tiene niguna Volumen registrado para el Proyecto'));
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
    public function store(ValidarVolumenRequest $request)
    {
        $volumen = new Volumen;

        $volumen->id_pro = $request->id_pro;
        $volumen->fecha = formatoFecha($request->fecha);
        $volumen->monto = $request->monto;
        $volumen->numero_boleta = $request->boleta;
        $volumen->tipo = $request->tipo;

        $volumen->save();

        return redirect('findVolumen/'.$request->id_pro);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function show(Volumen $volumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $volumen = Volumen::find($id);

        return view('volumen.updateVolumen', array('volumen' => $volumen));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarVolumenRequest $request)
    {
        $volumen = Volumen::find($request->id_mon);

        if($this->modificacion('monto',$request->id_mon,formatoFecha($request->fecha),$request->fechaA)){
            $volumen->fecha = formatoFecha($request->fecha);
        }
        if($this->modificacion('monto',$request->id_mon,$request->monto,$request->montoA)){
            $volumen->monto = $request->monto;
        }
        if($this->modificacion('monto',$request->id_mon,$request->boleta,$request->boletaA)){
            $volumen->numero_boleta = $request->boleta;
        }
        if($this->modificacion('monto',$request->id_mon,$request->tipo,$request->tipoA)){
            $volumen->tipo = $request->tipo;
        }

        $volumen->save();

        return redirect('findVolumen/'.$request->id_pro);
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
        return view('volumen.deleteVolumen', array('id' => $id, 'id_pro' => $id_pro));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $volumen = Volumen::find($request->id_mon);

        $volumen->delete();

        return redirect('findVolumen/'.$request->id_pro);
    }
}
