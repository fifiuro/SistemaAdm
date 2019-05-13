<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Unidad;
use App\Distrito;
use App\Proyecto;
use App\Estimado;
use Illuminate\Http\Request;
use DB;

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
        
        $seg = Proyecto::join('gestion','gestion.id_ges','=','proyecto.id_ges')
                        ->join('distrito','distrito.id_dist','=','proyecto.id_dist')
                        ->join('unidad','unidad.id_uni','=','proyecto.id_uni')
                        ->join('macro','macro.id_mac','=','distrito.id_mac')
                        ->where('proyecto.id_ges','like','%'.$request->gestion.'%')
                        ->where('unidad.id_uni','like','%'.$request->unidad.'%')
                        ->where('macro.id_mac','like','%'.$request->macro.'%')
                        ->where('distrito.id_dist','like','%'.$request->distrito.'%')
                        ->where('proyecto.nombre_pro','like','%'.$request->proyecto.'%')
                        ->whereRaw('ifnull((select sum(monto) from monto where id_pro = proyecto.id_pro group by id_pro),0) '.$request->estado)
                        ->select('distrito.id_dist','gestion.gestion','unidad.unidad_ejecutora','macro.nombre_mac','distrito.nombre_dis','proyecto.nombre_pro','proyecto.programado','proyecto.presupuesto')
                        ->selectRaw('ifnull((select sum(monto) from monto where id_pro = proyecto.id_pro group by id_pro),0) as total')
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

        /*$result = Proyecto::join('monto','monto.id_pro','=','proyecto.id_pro')
                          ->join('gestion','gestion.id_ges','=','proyecto.id_ges')
                          ->join('distrito','distrito.id_dist','=','proyecto.id_dist')
                          ->join('unidad','unidad.id_uni','=','proyecto.id_uni')
                          ->join('macro','macro.id_mac','=','distrito.id_mac')
                          ->where('proyecto.id_ges','=',$request->gestion)
                          ->where('proyecto.nombre_pro','like','%'.$request->proyecto.'%')
                          ->whereBetween('fecha',array(formatoFecha($fecha[0]),formatoFecha($fecha[1])))
                          ->get();*/
        
        $result = Proyecto::join('monto','monto.id_pro','=','proyecto.id_pro')
                          ->where('proyecto.id_ges','=',$request->gestion)
                          ->where('proyecto.nombre_pro','like','%'.$request->proyecto.'%')
                          ->whereBetween('fecha',array(formatoFecha($fecha[0]),formatoFecha($fecha[1])))
                          ->orderBy('proyecto.id_pro','DESC')
                          ->get();
        
        $id1 = array();
        foreach($result as $key => $r){
            array_push($id1, $r->id_pro);
        }

        $id = array_unique($id1);
        
        $proy = Proyecto::join('gestion','gestion.id_ges','=','proyecto.id_ges')
                        ->join('distrito','distrito.id_dist','=','proyecto.id_dist')
                        ->join('unidad','unidad.id_uni','=','proyecto.id_uni')
                        ->join('macro','macro.id_mac','=','distrito.id_mac')
                        ->whereIn('id_pro',$id)
                        ->orderBy('proyecto.id_pro','DESC')
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
    public function edit($id)
    {
        //
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
