<?php

namespace App\Http\Controllers;

use App\Distrito;
use App\Unidad;
use App\Gestion;
use App\Proyecto;
use App\Volumen;
use App\Modificacion;
use App\Macro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarDistritoRequest;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $macro = Macro::all();

        return view('distrito.findDistrito', array('macro' => $macro));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id|
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {        
        $distrito = Distrito::join('macro','macro.id_mac','=','distrito.id_mac')
                            ->where('macro.id_mac','=',$request->id_mac)
                            ->where('distrito.nombre_dis','like','%'.$request->distrito.'%')
                            ->get();

        $macro = Macro::all();

        if(count($distrito) > 0){
            return view('distrito.findDistrito',array('distrito' => $distrito,
                                                      'macro' => $macro,
                                                      'estado' => true));
        }else{
            return view('distrito.findDistrito',array('distrito' => '',
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
        $macro = Macro::all();

        return view('distrito.createDistrito', array('macro' => $macro));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarDistritoRequest $request)
    {
        $distrito = new Distrito;

        $distrito->id_mac = $request->id_mac;
        $distrito->nombre_dis = $request->nombre;
        $distrito->numero_dis = $request->numero;
        $distrito->ubicacion = $request->ubicacion;
        $distrito->estado = 1;

        $distrito->save();

        $macro = Macro::all();

        return view('distrito.findDistrito', array('macro' => $macro));
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

        $macro = Macro::all();

        return view('distrito.updateDistrito',array('distrito' => $distrito, 'macro' => $macro));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarDistritoRequest $request)
    {
        $distrito = Distrito::find($request->id_dist);

        if($this->modificacion('distrito',$request->id_dist,$request->nombre,$request->nombreA)){
            $distrito->nombre_dis = $request->nombre;
        }
        if($this->modificacion('distrito',$request->id_dist,$request->numero,$request->numeroA)){
            $distrito->numero_dis = $request->numero;
        }
        if($this->modificacion('distrito',$request->id_dist,$request->ubicacion,$request->ubicacionA)){
            $distrito->ubicacion = $request->ubicacion;
        }
        if($this->modificacion('distrito',$request->id_dist,$request->estado,$request->estadoA)){
            $distrito->estado = $request->estado;
        }

        $distrito->save();

        return redirect('findDistrito');
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
