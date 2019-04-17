<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\Distrito;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distrito = Distrito::all();

        return view('proyecto.findProyecto', array('distrito' => $distrito));
    }

/**
     * Display the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distrito = Distrito::where('estado','=',true)->get();

        return view('proyecto.createProyecto', array('distrito' => $distrito));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proyecto = new Proyecto;

        $proyecto->id_dist = $request->id_dist;
        $proyecto->nombre_pro = $request->nombre_pro;
        $proyecto->ema = $request->ema;
        $proyecto->presupuesto = $request->presupuesto;
        $proyecto->fecha_reg = date('Y-m-d');
        $proyecto->estado = 1;

        $proyecto->save();

        return redirect('findProyecto');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::join('distrito','distrito.id_dist','=','proyecto.id_dist')
                        ->where('id_pro','=',$id)
                        ->get();

        return view('proyecto.updateProyecto',array('proyecto' => $proyecto));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $proyecto = Proyecto::find($request->id_pro);

        $proyecto->id_dist = $request->id_dist;
        $proyecto->nombre_pro = $request->nombre_pro;
        $proyecto->ema = $request->ema;
        $proyecto->presupuesto = $request->presupuesto;
        
        $proyecto->estado = $request->estado;;

        $proyecto->save();

        return redirect('findProyecto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }
}
