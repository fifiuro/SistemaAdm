<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\Macro;
use App\UnidadMacro;
use DB;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidad = Unidad::where('estado','=',1)->get();

        return view('asignacion.findAsignacion',array('unidad' => $unidad));
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
    public function storeUnidadMacro(Request $request)
    {
        $um = new UnidadMacro;

        $um->id_uni = $request->id_uni;
        $um->id_mac = $request->id_mac;
        $um->estado = 1;

        $um->save();

        echo true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMacroUnidad(Request $request)
    {
        $macro = DB::select('SELECT um.id_um, u.id_uni, m.id_mac, m.nombre_mac 
        FROM (SELECT * FROM unidad WHERE id_uni = '.$request->id.') AS u
            INNER JOIN unidad_macro AS um ON (u.id_uni = um.id_uni)
            RIGHT JOIN macro AS m ON (m.id_mac = um.id_mac)');

        return $macro;
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
    public function destroyUnidadMacro(Request $request)
    {
        $um = UnidadMacro::find($request->id);

        $um->delete();

        echo true;
    }
}
