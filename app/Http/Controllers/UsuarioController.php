<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuario.findUsuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $usuario = User::where('name','like','%'.$request->nombre.'%')
                       ->where('email','like','%'.$request->email.'%')
                       ->get();
        
        if(count($usuario) > 0){
            return view('usuario.findUsuario',array('usuario' => $usuario,
                                                    'estado' => true));
        }else{
            return view('usuario.findUsuario',array('usuario' => '',
                                                    'estado' => false,
                                                    'mensaje' => 'No se tuvieron coincidencias con: '.$request->nombre.' o '.$request->email));
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
        $usuario = User::find($id);

        return view('usuario.updateUsuario',array('usuario' => $usuario));
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
        $usuario = User::find($request->id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->cargo = $request->cargo;
        $usuario->unidad = $request->unidad;
        $usuario->password = Hash::make($request->password);
        $usuario->estado = $request->estado;

        $usuario->save();

        return redirect('findUsuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        return view('usuario.deleteUsuario', array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $usuario = User::find($request->id);

        $usuario->delete();

        return redirect('findUsuario');
    }
}
