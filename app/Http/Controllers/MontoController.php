<?php

namespace App\Http\Controllers;

use App\Monto;
use App\Proyecto;
use Illuminate\Http\Request;

class MontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto::find($id);

        return view('monto.findProyecto',array('proyecto' => $proyecto));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monto.createMonto',array('id' => $id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $monto = new Monto;

        $monto->id_pro = $request->id_pro;
        $monto->fecha = $request->fecha;
        $monto->monto = $request->monto;

        $monto->save();

        return redirect('findMonto');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $monto = Monto::find($id);

        return view('monto.updateMonto',array('monto' => $monto));
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
        $monto = Monto::find($request->id_mon);

        $monto->fecha = $request->fecha;
        $monto->monto = $request->monto;

        $monto->save();

        return redirect('findMonto',array('id' => $request->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        return view('monto.deleteMonto',array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $monto = Monto::find($request->id_mon);

        $monto->delete();

        return reditect('findMonto');
    }
}
