@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    ELIMINAR USUARIO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('destroyUsuario') }}">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="text-center">
                <h2>Estas seguro de eliminar al Usuario?</h2>
                <input type="hidden" class="form-control" id="id" name="id" value="{{$id}}">
            </div>
        </div>   
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="si" id="si">SI</button>
               <a href="{{ url('findUsuario') }}" class="btn btn-danger">NO</a>
        </div>
      </form>
    </div>
  </div>

@endsection

@section('extra')

@endsection