<?php

namespace App\Http\Controllers;

use App\Estimado;
use App\Proyecto;
use Illuminate\Http\Request;

class EstimadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proy = Proyecto::find($id);

        $estimado = Estimado::where('id_pro','=',$id)
                            ->orderBy('fecha','desc')
                            ->get();

        if(count($estimado) > 0){
            return view('estimado.findEstimado', array('proy' => $proy,
                                                        'estimado' =>$estimado,
                                                        'estado' => true));
        }else{
            return view('estimado.findEstimado', array('proy' => $proy,
                                                        'estimado' => '',
                                                        'estado' => false,
                                                        'mensaje' => 'No se tiene nigun Estimado registrado.'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
