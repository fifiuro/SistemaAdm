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
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateUnidad') }}">
        {{ csrf_field() }}
            <div class="group-form-control">
                <label for="gestion">Gestión:</label>
                @foreach ($gestion as $key => $g)
                    <input type="text" name="gestion" id="gestion" value="{{ $unidad->gestion }}" disabled>
                    <input type="hidden" name="id_ges" value="{{ $unidad->id_uni }}" required>
                @endforeach
            </div>
            <div class="group-form-control">
                <label for="unidad">Unidad Ejecutora:</label>
                <input class="form-control" id="unidad" name="unidad" placeholder="Unidad Ejecutora" type="text" value="{{ $unidad->unidad_ejecutora }}" required>
            </div>
            <div class="group-form-control">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control">
                    @if($unidad->estado)
                        <option value="true" selected>Activo</option>
                        <option value="false">Desactivado</option>
                    @else
                        <option value="true">Activo</option>
                        <option value="false" selected>Desactivado</option>
                    @endif
                </select>
            </div>
            <div class="group-form-control">
            <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createUnidad') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
      </form>
    </div>
  </div>
@endsection

@section('extra')

@endsection