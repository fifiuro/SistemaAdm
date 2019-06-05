<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Unidad;
use App\Distrito;
use App\Proyecto;
use App\Estimado;
use Illuminate\Http\Request;
use DB;
use App\Exports\DetalleExport;
use Maatwebsite\Excel\Facades\Excel;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestion = Gestion::all();

        $unidad = Unidad::all();

        return view('seguimiento.findSeguimiento', array('gestion' => $gestion, 'unidad' => $unidad));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $gestion = Gestion::all();

        $unidad = Unidad::all();
           
        $seg = Proyecto::join('todo','todo.id_to','=','proyecto.id_to')
                       ->join('gestion','gestion.id_ges','=','proyecto.id_ges')
                       ->leftJoinSub('SELECT id_uni, unidad_ejecutora FROM unidad','unidad',function($join){ $join->on('unidad.id_uni','=','todo.id_uni'); })
                       ->leftJoinSub('SELECT id_mac, nombre_mac FROM macro','macro',function($join){ $join->on('macro.id_mac','=','todo.id_mac'); })
                       ->leftJoinSub('SELECT id_dist, nombre_dis FROM distrito','distrito',function($join){ $join->on('distrito.id_dist','=','todo.id_dist'); })
                       ->join('estimado','estimado.id_pro','proyecto.id_pro')
                       ->distinct()
                       ->selectRaw('ifnull(distrito.id_dist,0) as id_dist')
                       ->selectRaw('ifnull(unidad.unidad_ejecutora,0) as unidad_ejecutora')
                       ->selectRaw('ifnull(macro.nombre_mac,0) as nombre_mac')
                       ->selectRaw('ifnull(distrito.nombre_dis,0) as nombre_dis')
                       ->select('gestion.gestion','proyecto.ema','proyecto.programado','proyecto.presupuesto','proyecto.adjudicacion','proyecto.fecha_adjudicacion')
                       ->selectRaw('IFNULL((SELECT SUM(monto) FROM monto WHERE id_pro = proyecto.id_pro GROUP BY id_pro),0) AS total')
                       ->where('proyecto.id_ges','=',$request->gestion)
                       ->where('todo.id_uni','like','%'.$request->unidad.'%')
                       ->where('todo.id_mac','like','%'.$request->macro.'%')
                       ->where('todo.id_dist','like','%'.$request->distrito.'%')
                       ->where('proyecto.ema','like','%'.$request->ema.'%')
                       ->where('estimado.tipo','like','%'.$request->tipo.'%')
                       ->whereRaw('ifnull(proyecto.programado - (select sum(monto) from monto where id_pro = proyecto.id_pro group by id_pro),0) '.$request->estado)
                       ->get();

        if(count($seg) > 0){
            return view('seguimiento.findSeguimiento', array('gestion' => $gestion,
                                                             'unidad' => $unidad,
                                                             'seg' => $seg,
                                                             'estado' => true));
        }else{
            return view('seguimiento.findSeguimiento', array('gestion' => $gestion,
                                                             'unidad' => $unidad,
                                                             'seg' => '',
                                                             'estado' => false,
                                                             'mensaje' => 'No se tuvieron coincidencias.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDetalle()
    {
        $gestion = Gestion::all();

        return view('seguimiento.findDetalle', array('gestion' => $gestion));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showDetalle(Request $request)
    {
        $gestion = Gestion::all();

        $fecha = explode(' - ',$request->fecha);
        
        $result = Proyecto::join('monto','monto.id_pro','=','proyecto.id_pro')
                          ->where('proyecto.id_ges','=',$request->gestion)
                          ->where('proyecto.ema','like','%'.$request->ema.'%')
                          ->whereBetween('fecha',array(formatoFecha($fecha[0]),formatoFecha($fecha[1])))
                          ->orderBy('proyecto.id_pro','DESC')
                          ->get();
        
        $id1 = array();
        foreach($result as $key => $r){
            array_push($id1, $r->id_pro);
        }

        $id = array_unique($id1);
        
        /*$proy = Proyecto::join('gestion','gestion.id_ges','=','proyecto.id_ges')
                        ->join('distrito','distrito.id_dist','=','proyecto.id_dist')
                        ->join('unidad','unidad.id_uni','=','proyecto.id_uni')
                        ->join('macro','macro.id_mac','=','distrito.id_mac')
                        ->whereIn('id_pro',$id)
                        ->orderBy('proyecto.id_pro','DESC')
                        ->get();*/
        
        $proy = Proyecto::join('gestion','gestion.id_ges','=','proyecto.id_ges')
                        ->join('todo','todo.id_to','=','proyecto.id_to')
                        ->leftJoinSub('SELECT id_uni, unidad_ejecutora FROM unidad','unidad',function($join){ $join->on('unidad.id_uni','=','todo.id_uni'); })
                        ->leftJoinSub('SELECT id_mac, nombre_mac FROM macro','macro',function($join){ $join->on('macro.id_mac','=','todo.id_mac'); })
                        ->leftJoinSub('SELECT id_dist, nombre_dis FROM distrito','distrito',function($join){ $join->on('distrito.id_dist','=','todo.id_dist'); })
                        ->whereIn('id_pro',$id)
                        ->orderby('proyecto.id_pro','DESC')
                        ->get();
        
        $estimado = Estimado::whereIn('id_pro',$id)
                            ->orderBy('id_pro','DESC')
                            ->get();

        if(count($result) > 0){
            return view('seguimiento.findDetalle', array(
                'gestion' => $gestion,
                'result' => $result,
                'proy' => $proy,
                'estimado' => $estimado,
                'estado' => true
            ));
        }else{
            return view('seguimiento.findDetalle', array(
                'gestion' => $gestion,
                'estado' => false,
                'mensaje' => 'No se tuvieron coincidencias.'
            ));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportarExcel($id)
    {
        return Excel::download(new DetalleExport, 'unidad.xlsx');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
