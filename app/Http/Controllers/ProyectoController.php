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
    public function show(Request $request)
    {
       /*print_r($request);*/
        $proyecto = Proyecto::join('distrito','distrito.id_dist','=','proyecto.id_dist')
        ->where('proyecto.nombre_pro','like','%'.$request->nombre_pro.'%')
        ->where('distrito.id_dist','=',$request->distrito)
        ->select('proyecto.id_pro','distrito.nombre_dis','proyecto.nombre_pro','proyecto.ema','proyecto.presupuesto','proyecto.estado')
        ->get();

        $distrito = Distrito::all();

        if(count($proyecto) > 0){
        return view('proyecto.findProyecto',array('proyecto' => $proyecto,
                                        'distrito' => $distrito,
                                        'estado' => true));
        }else{
        return view('proyecto.findProyecto',array('proyecto' => '',
                                        'distrito' => $distrito,
                                        'estado' => false,
                                        'mensaje' => 'No se tuvieron coincidencias con: '.$request->nombre_pro.' o '.$request->distrito));

        }
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

        /*$proyecto->id_dist = $request->id_dist;*/
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
    public function destroy(Request $request)
    {
        $proyecto = Proyecto::find($request->id_pro);

        $proyecto->delete();

        return redirect('findProyecto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        
        return view('proyecto.deleteProyecto',array('id'=>$id));
    }
}
