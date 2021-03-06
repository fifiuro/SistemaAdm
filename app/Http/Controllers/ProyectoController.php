<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\Distrito;
use App\Volumen;
use App\Gestion;
use App\Unidad;
use App\Modificacion;
use App\UnidadMacro;
use App\Macro;
use App\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarProyectoRequest;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidad = Unidad::all();

        return view('proyecto.findProyecto', array('unidad' => $unidad));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $proyecto = Proyecto::join('todo','todo.id_to','=','proyecto.id_to')
                            ->select('proyecto.id_pro', 'proyecto.id_to', 'proyecto.id_ges', 'proyecto.ubicacion', 'proyecto.ema', 'proyecto.fecha_reg', 'proyecto.presupuesto', 'proyecto.programado', 'proyecto.adjudicacion', 'proyecto.numero_adjudicacion', 'proyecto.estado', 'proyecto.observaciones')
                            ->selectRaw('ifnull((select unidad_ejecutora from unidad where id_uni = todo.id_uni),0) as unidad')
                            ->selectRaw('ifnull((select nombre_mac from macro where id_mac = todo.id_mac),0) as macro')
                            ->selectRaw('ifnull((select nombre_dis from distrito where id_dist = todo.id_dist),0) as distrito')
                            ->where('proyecto.ema','like','%'.$request->ema.'%')
                            ->where('todo.id_uni','like','%'.$request->unidad.'%')
                            ->get();

        $unidad = Unidad::all();

        if(count($proyecto) > 0){
        return view('proyecto.findProyecto',array('proyecto' => $proyecto,
                                        'unidad' => $unidad,
                                        'estado' => true));
        }else{
        return view('proyecto.findProyecto',array('proyecto' => '',
                                        'unidad' => $unidad,
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
        $gestion = Gestion::where('estado','=',1)->limit(1)->get();

        $unidad = Unidad::all();

        return view('proyecto.createProyecto', array('gestion' => $gestion,
                                                     'unidad' => $unidad));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarProyectoRequest $request)
    {
        $todo = new Todo;
        if($request->id_mac == 0){
            $todo->id_uni = $request->id_uni;
            $todo->id_mac = 0;
            $todo->id_dist = 0;
        }elseif($request->id_dist == 0){
            $todo->id_uni = $request->id_uni;
            $todo->id_mac = $request->id_mac;
            $todo->id_dist = 0;
        }else{
            $todo->id_uni = $request->id_uni;
            $todo->id_mac = $request->id_mac;
            $todo->id_dist = $request->id_dist;
        }
        $todo->save();
        $id_to = $todo->id_to;

        $proyecto = new Proyecto;

        $proyecto->id_to = $id_to;
        $proyecto->id_ges = $request->id_ges;
        $proyecto->ubicacion = $request->ubicacion;
        $proyecto->tipo_ema = $request->tipoEma;
        $proyecto->ema = $request->ema;
        $proyecto->presupuesto = $request->presupuesto;
        $proyecto->programado = $request->programado;
        $proyecto->adjudicacion = $request->adjudicado;
        $proyecto->fecha_adjudicacion = formatoFecha($request->fecha);
        $proyecto->numero_adjudicacion = 0;
        $proyecto->fecha_reg = date('Y-m-d');
        $proyecto->fecha_contrato = formatoFecha($request->fechaContrato);
        $proyecto->plazo = $request->plazo;
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
        $proyecto = Proyecto::join('todo','todo.id_to','=','proyecto.id_to')
                            ->where('proyecto.id_pro','=',$id)
                            ->get();
        
        $gestion = Gestion::all();

        $unidad = Unidad::all();

        foreach($proyecto as $key => $p){
            $uni = $p->id_uni;
            $m = $p->id_mac;
        }

        $macro = UnidadMacro::join('macro','macro.id_mac','=','unidad_macro.id_mac')
                            ->where('unidad_macro.id_uni','=',$uni)
                            ->get();
        
        $distrito = Distrito::where('id_mac','=',$m)->get();

        return view('proyecto.updateProyecto',array('proyecto' => $proyecto,
                                                    'gestion' => $gestion,
                                                    'unidad' => $unidad,
                                                    'macro' => $macro,
                                                    'distrito' => $distrito
                                                ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarProyectoRequest $request)
    {
        $todo = Todo::find($request->id_to);
        if($request->id_mac == 0){
            if($this->modificacion('todo',$request->id_pro,$request->id_uni,$request->id_uniA)){
                $todo->id_uni = $request->id_uni;
            }
            if($this->modificacion('todo',$request->id_pro,$request->id_mac,$request->id_macA)){
                $todo->id_mac = 0;
            }
            if($this->modificacion('todo',$request->id_pro,$request->id_dist,$request->id_distA)){
                $todo->id_dist = 0;
            }
        }elseif($request->id_dist == 0){
            if($this->modificacion('todo',$request->id_pro,$request->id_uni,$request->id_uniA)){
                $todo->id_uni = $request->id_uni;
            }
            if($this->modificacion('todo',$request->id_pro,$request->id_mac,$request->id_macA)){
                $todo->id_mac = $request->id_mac;
            }
            if($this->modificacion('todo',$request->id_pro,$request->id_dist,$request->id_distA)){
                $todo->id_dist = 0;
            }
        }else{
            if($this->modificacion('todo',$request->id_pro,$request->id_uni,$request->id_uniA)){
                $todo->id_uni = $request->id_uni;
            }
            if($this->modificacion('todo',$request->id_pro,$request->id_mac,$request->id_macA)){
                $todo->id_mac = $request->id_mac;
            }
            if($this->modificacion('todo',$request->id_pro,$request->id_dist,$request->id_distA)){
                $todo->id_dist = $request->id_dist;
            }
        }


        $todo->save();

        $proyecto = Proyecto::find($request->id_pro);

        if($this->modificacion('proyecto',$request->id_pro,$request->id_dist,$request->id_distA)){
            $proyecto->id_dist = $request->id_dist;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->id_uni,$request->id_uniA)){
            $proyecto->id_uni = $request->id_uni;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->ubicacion,$request->ubicacionA)){
            $proyecto->ubicacion = $request->ubicacion;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->tipoEma,$request->tipoEmaA)){
            $proyecto->tipo_ema = $request->tipoEma;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->ema,$request->emaA)){
            $proyecto->ema = $request->ema;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->presupuesto,$request->presupuestoA)){
            $proyecto->presupuesto = $request->presupuesto;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->programado,$request->programadoA)){
            $proyecto->programado = $request->programado;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->adjudicado,$request->adjudicadoA)){
            $proyecto->adjudicacion = $request->adjudicado;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->fecha,$request->fechaA)){
            $proyecto->fecha_adjudicacion = formatoFecha($request->fecha);
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->numero,$request->numeroA)){
            $proyecto->numero_adjudicacion = $request->numero;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->estado,$request->estadoA)){
            $proyecto->estado = $request->estado;
        }
        if($this->modificacion('proyecto',$request->id_pro,$request->obs,$request->obsA)){
            $proyecto->observaciones = $request->obs;
        }

        $proyecto->save();

        return redirect('findProyecto');
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

    /** Reporte por proyecto y sus volumenes */
    public function reporteProyecto($id)
    {
        $proy = Proyecto::
        join('gestion','gestion.id_ges','=','proyecto.id_ges')
        ->join('distrito','distrito.id_dist','=','proyecto.id_dist')
        ->join('unidad','unidad.id_uni','=','proyecto.id_uni')
        ->join('macro','macro.id_mac','=','distrito.id_mac')
        ->where('proyecto.id_pro','=',$id)
        ->select('gestion.gestion',
                    'unidad.unidad_ejecutora',
                    'distrito.nombre_dis',
                    'distrito.numero_dis',
                    'proyecto.ema',
                    'proyecto.presupuesto',
                    'proyecto.programado')
        ->get();
        
        $volumen = Volumen::where('id_pro','=',$id)->orderBy('fecha','desc')->get();

        foreach($proy as $key => $p){
            $presupuesto = $p->presupuesto;
        }
        /** Calculo del Area */
        $area = $presupuesto / 200;
        /** Calculo del Volumen */
        $vol = $area * 0.07;
        /** Sumatoria de Volumenes */
        $sumatoria = Volumen::where('id_pro','=',$id)
                            ->sum('monto');
        
        $pdf = \PDF::loadView('proyecto.reporte',array('proy' => $proy,
                                                       'volumen' => $volumen,
                                                       'area' => $area,
                                                       'vol' => $vol,
                                                       'sumatoria' => $sumatoria));

        //return $pdf->download('ReporteProyecto.pdf');
        return $pdf->stream('ReporteProyecto');
    }

}
