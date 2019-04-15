@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVA UNIDAD
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeUnidad') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="gestion">Gestión:</label>
            @foreach ($gestion as $key => $g)
                <input type="text" name="gestion" id="gestion" value="{{ $g->gestion }}" class="form-control" disabled>
                <input type="hidden" name="id_ges" value="{{ $g->id_ges }}" required>
            @endforeach
        </div>
        <div class="group-form-control">
            <label for="unidad">Unidad Ejecutora:</label>
            <input class="form-control" id="unidad" name="unidad" placeholder="Unidad Ejecutora" type="text" required>
        </div>
        <div class="group-form-control">
        <br>
        <button type="submit" class="btn btn-primary" name="guardar" id="guardar">GUARDAR</button>
        <a href="{{ url('findUnidad') }}" class="btn btn-danger">CANCELAR</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('extra')

@endsection