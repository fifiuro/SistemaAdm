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
        $proyecto = Proyecto::
        join('gestion','gestion.id_ges','=','proyecto.id_ges')
        ->join('distrito','distrito.id_dist','=','proyecto.id_dist')
        ->join('unidad','unidad.id_uni','=','proyecto.id_uni')
        ->join('macro','macro.id_mac','=','distrito.id_mac')
        ->where('proyecto.ema','like','%'.$request->ema.'%')
        ->where('unidad.id_uni','like','%'.$request->unidad.'%')
        ->select('unidad_ejecutora',
                'nombre_mac',
                'nombre_dis',
                'proyecto.id_pro',
                'proyecto.id_uni',
                'distrito.nombre_dis',
                'proyecto.ubicacion',
                'proyecto.ema',
                'proyecto.presupuesto',
                'proyecto.programado',
                'proyecto.estado')
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
        $proyecto = new Proyecto;

        $proyecto->id_dist = $request->id_dist;
        $proyecto->id_ges = $request->id_ges;
        $proyecto->id_uni = $request->id_uni;
        $proyecto->ubicacion = $request->ubicacion;
        $proyecto->ema = $request->ema;
        $proyecto->presupuesto = $request->presupuesto;
        $proyecto->programado = $request->programado;
        $proyecto->adjudicacion = $request->adjudicado;
        $proyecto->fecha_adjudicacion = formatoFecha($request->fecha);
        $proyecto->numero_adjudicacion = 0;
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
    public function edit($id,$uni)
    {
        $proyecto = Proyecto::join('distrito','distrito.id_dist','=','proyecto.id_dist')
                            ->join('macro','macro.id_mac','=','distrito.id_mac')
                            ->join('unidad_macro','unidad_macro.id_mac','=','macro.id_mac')
                            ->join('unidad','unidad.id_uni','=','unidad_macro.id_uni')
                            ->where('proyecto.id_pro','=',$id)
                            ->where('unidad_macro.id_uni','=',$uni)
                            ->get();
        
        $gestion = Gestion::all();

        $unidad = Unidad::all();

        $macro = UnidadMacro::join('macro','macro.id_mac','=','unidad_macro.id_mac')
                            ->where('unidad_macro.id_uni','=',$uni)
                            ->get();

        foreach($proyecto as $key => $p){
            $m = $p->id_mac;
        }
        
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
