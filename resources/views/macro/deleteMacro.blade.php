@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    ELIMINAR MACRO DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('destroyMacro') }}">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="text-center">
                <h2>Estas seguro de eliminar el Macro Distrito?</h2>
                <input type="hidden" class="form-control" id="id_mac" name="id_mac" value="{{$id}}">
            </div>
        </div>   
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="si" id="si">SI</button>
               <a href="{{ url('findMacro') }}" class="btn btn-danger">NO</a>
        </div>
      </form>
    </div>
  </div>

@endsection

@section('extra')

@endsection