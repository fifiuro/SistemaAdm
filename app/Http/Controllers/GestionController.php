<?php

namespace App\Http\Controllers;

use App\Gestion;
use App\Modificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarGestionRequest;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestion.findGestion');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $gestion=Gestion::where('gestion','like','%'.$request->gestion.'%')->get();
        if(count($gestion) > 0){
            return view('Gestion.findGestion',array('gestion'=>$gestion,'estado'=>true));
        }else{
            return view('Gestion.findGestion',array('gestion'=>'','estado'=>false,'mensaje'=>'no se tuvieron coincidencias'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('gestion.createGestion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request)
    public function store(ValidarGestionRequest $request)
    {
        $gestion=new Gestion;
        $gestion->gestion =$request->gestion;
        $gestion->estado =$request->estado;
        $gestion->estado =true;
        $gestion->save();
        return redirect('findGestion');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gestion=Gestion::find($id);
        return view('gestion.updateGestion',array('gestion'=>$gestion));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $gestion= Gestion::find($request->id_ges);
        if($this->modificacion('gestion',$request->id_ges,$request->gestion,$request->gestionA)){
            $gestion->gestion =$request->gestion;
        }
        if($this->modificacion('gestion',$request->id_ges,$request->estado,$request->estadoA)){
            $gestion->estado =$request->estado;
        }
        $gestion->save();       

        return redirect('findGestion');
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
     * @param  \App\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $gestion=Gestion::find($request->id_ges);
        $gestion->delete();
        return redirect('findGestion');    
    }

    public function confirm($id)
    {
        return view('gestion.deleteGestion',array('id'=>$id));
    }

}
