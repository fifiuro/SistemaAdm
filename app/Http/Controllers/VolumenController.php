<?php

namespace App\Http\Controllers;

use App\Volumen;
use App\Proyecto;
use Illuminate\Http\Request;

class VolumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proy = Proyecto::find($id);

        $volumen = Volumen::where('id_pro','=',$id)
                          ->orderBy('fecha','desc')
                          ->get();

        if(count($volumen) > 0){
            return view('volumen.findVolumen', array('proy' => $proy, 
                                                     'volumen' => $volumen, 
                                                     'estado' => true));
        }else{
            return view('volumen.findVolumen', array('proy' => $proy, 
                                                     'volumen' => '', 
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
    public function store(Request $request)
    {
        $volumen = new Volumen;

        $volumen->id_pro = $request->id_pro;
        $volumen->fecha = formatoFecha($request->fecha);
        $volumen->monto = $request->monto;

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
    public function update(Request $request)
    {
        $volumen = Volumen::find($request->id_mon);

        $volumen->fecha = formatoFecha($request->fecha);
        $volumen->monto = $request->monto;

        $volumen->save();

        return redirect('findVolumen/'.$request->id_pro);
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
