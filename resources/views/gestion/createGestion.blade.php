@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVA GESTION
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeGestion') }}">
        {{ csrf_field() }}
        
            <div class="group-from-control">
                <label for="unidad">Gestion:</label>
                <input class="form-control" id="gestion" name="gestion" placeholder="Gestion" type="text">
            </div>
          <div class="group-from-control">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary" name="guardar" id="guardar">GUARDAR</button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createGestion') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
      </form>
    </div>

  </div>


@endsection

@section('extra')

@endsection