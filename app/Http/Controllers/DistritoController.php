<?php

namespace App\Http\Controllers;

use App\Distrito;
use App\Unidad;
use App\Gestion;
use App\Proyecto;
use App\Volumen;
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
        $unidad = Unidad::all();

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
        $distrito = Distrito::join('unidad','unidad.id_uni','=','distrito.id_uni')
                            ->where('nombre_dis','like','%'.$request->distrito.'%')
                            ->where('unidad.id_uni','=',$request->id_uni)
                            ->select('distrito.id_dist','unidad_ejecutora','nombre_dis','numero_dis','ubicacion','distrito.estado')
                            ->get();

        $unidad = Unidad::all();

        if(count($distrito) > 0){
            return view('distrito.findDistrito',array('distrito' => $distrito,
                                                      'unidad' => $unidad,
                                                      'estado' => true));
        }else{
            return view('distrito.findDistrito',array('distrito' => '',
                                                    'unidad' => $unidad,
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

        $unidad = Unidad::where('estado','=',1)->get();

        return view('distrito.updateDistrito',array('distrito' => $distrito, 'unidad' => $unidad));
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
        $distrito = Distrito::find($request->id_dist);

        $distrito->delete();

        return redirect('findDistrito');
    }

    /** Supervision de Proyectos */
    public function supervisar($id, $id_pro)
    {
        $distrito = Distrito::find($id);
        $numProyecto = Distrito::join('proyecto','proyecto.id_dist','=','distrito.id_dist')
                               ->groupBy('distrito.id_dist')
                               ->selectRaw('count(*) as total')
                               ->where('distrito.id_dist','=',$id)
                               ->get();

        $proyecto = Proyecto::where('id_dist','=',$id)
                            ->select('id_pro','nombre_pro','presupuesto')
                            ->orderBy('id_pro','asc')
                            ->get();

        if(count($proyecto) > 0){
            if($id_pro == 0){
                $id_pro = $proyecto[0]->id_pro;
                $presupuesto = $proyecto[0]->presupuesto;
            }elseif($id_pro != 0){
                foreach($proyecto as $key => $p)
                {
                    if($id_pro == $p->id_pro){
                        $presupuesto = $p->presupuesto;
                        break;
                    }
                }
            }
    
            $volumen = Volumen::where('id_pro','=',$id_pro)
                              ->orderBy('fecha','desc')
                              ->get();
            
            /** Calculo del Area */
            $area = $presupuesto / 200;
            /** Calculo del Volumen */
            $vol = $area * 0.07;
            /** Sumatoria de Volumenes */
            $sumatoria = Volumen::where('id_pro','=',$id_pro)
                                ->sum('monto');
            
            $estado = true;
        }else{
            $volumen = '';
            $presupuesto = 0;
            $area = 0;
            $vol = 0;
            $sumatoria = 0;
            $estado = false;
        }

        
        return view('distrito.supervision',array('distrito' => $distrito,
                                                 'numProyecto' => $numProyecto,
                                                 'proyecto' => $proyecto,
                                                 'id_pro' => $id_pro,
                                                 'volumen' => $volumen,
                                                 'presupuesto' => $presupuesto,
                                                 'area' => $area,
                                                 'vol' => $vol,
                                                 'sumatoria' => $sumatoria,
                                                 'estado' => $estado));
    }

}
