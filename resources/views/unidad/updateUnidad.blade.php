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
        @foreach ($unidad as $key => $u)
            <div class="group-form-control">
                <label for="gestion">Gestión:</label>
                <input type="text" name="gestion" id="gestion" value="{{ $u->gestion }}" class="form-control" disabled>
                <input type="hidden" name="id_uni" value="{{ $u->id_uni }}" required>
            </div>
            <div class="group-form-control">
                <label for="unidad">Unidad Ejecutora:</label>
                <input class="form-control" id="unidad" name="unidad" placeholder="Unidad Ejecutora" type="text" value="{{ $u->unidad_ejecutora }}" required>
            </div>
            <div class="group-form-control">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control">
                    @if($u->estado)
                        <option value="1" selected>Activo</option>
                        <option value="0">Desactivado</option>
                    @else
                        <option value="1">Activo</option>
                        <option value="0" selected>Desactivado</option>
                    @endif
                </select>
            </div>    
        @endforeach
        <br>
        <div class="group-form-control">
            <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
            <a href="{{ url('findUnidad') }}" class="btn btn-danger">CANCELAR</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('extra')

@endsection