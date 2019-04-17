<?php

namespace App\Http\Controllers;

use App\Volumen;
use App\Proyecto;
use Illuminate\Http\Request;

class VolumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proy = Proyecto::find($id);

        return view('volumen.findVolumen', array('proy' => $proy));
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
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function show(Volumen $volumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Volumen $volumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volumen $volumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Volumen  $volumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volumen $volumen)
    {
        //
    }
}
