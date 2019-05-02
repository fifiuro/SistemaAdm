<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Unidad;
use App\Distrito;
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

        return view('seguimiento.findSeguimiento', array('gestion' => $gestion));
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

        /*$seg = Unidad::join('unidad_macro','unidad.id_uni','=','unidad_macro.id_uni')
                     ->join('macro','unidad_macro.id_mac','=','macro.id_mac')
                     ->join('distrito','macro.id_mac','=','distrito.id_mac')
                     ->join('proyecto','distrito.id_dist','=','proyecto.id_dist')
                     ->join('gestion','proyecto.id_ges','=','gestion.id_ges')
                     ->where('proyecto.id_ges','=',$request->gestion)
                     ->where('macro.nombre_mac','like','%'.$request->macro.'%')
                     ->where('distrito.nombre_dis','like','%'.$request->distrito.'%')
                     ->where('proyecto.nombre_pro','like','%'.$request->proyecto.'%')
                     ->get();*/

        $seg = DB::select('select 
        d.id_dist, 
        g.gestion, 
        u.unidad_ejecutora, 
        m.nombre_mac, 
        d.nombre_dis, 
        p.nombre_pro, 
        p.programado, 
        ifnull((select count(*) from monto where id_pro = p.id_pro group by id_pro),0) as total 
    from unidad as u 
        inner join unidad_macro as um on (u.id_uni = um.id_uni)
        inner join macro as m on (um.id_mac = m.id_mac)
        inner join distrito as d on (m.id_mac = d.id_mac)
        inner join proyecto as p on (d.id_dist = p.id_dist)
        inner join gestion as g on (p.id_ges = g.id_ges)
    where 
        p.id_ges = '.$request->gestion.' and 
        m.nombre_mac like "%'.$request->macro.'%" and 
        d.nombre_dis like "%'.$request->distrito.'%" and 
        p.nombre_pro like "%'.$request->proyecto.'%"');

        if(count($seg) > 0){
            return view('seguimiento.findSeguimiento', array('gestion' => $gestion,
                                                             'seg' => $seg,
                                                             'estado' => true));
        }else{
            return view('seguimiento.findSeguimiento', array('gestion' => $gestion,
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
        //
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
