@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateDistrito') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="id_uni">Unidad Ejecutora:</label>
            <select name="id_uni" id="id_uni" class="form-control">
              <option value=""></option>
              @foreach ($unidad as $key => $u)
                @if ($distrito->id_uni == $u->id_uni)
                    <option value="{{ $u->id_uni }}" selected>{{ $u->unidad_ejecutora }}</option>
                @else
                    <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                @endif
              @endforeach
            </select>
        </div>
        <div class="group-form-control">
            <label for="nombre">Nombre de Distrito:</label>
            <input class="form-control" id="nombre" name="nombre" placeholder="Nombre de Distrito" type="text" value="{{ $distrito->nombre_dis }}" required>
            <input type="hidden" name="id_dist" value="{{ $distrito->id_dist }}">
        </div>
        <div class="group-form-control">
            <label for="numero">Número de Distrito:</label>
            <input class="form-control" id="numero" name="numero" placeholder="Número de Distrito" type="number" value="{{ $distrito->numero_dis }}" required>
        </div>
        <div class="group-form-control">
            <label for="ubicacion">Ubicación:</label>
            <input class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" type="text" value="{{ $distrito->ubicacion }}" required>
        </div>
        <div class="group-form-control">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                @if ($distrito->estado == 1)
                    <option value="1" selected>Activo</option>
                    <option value="0">Desactivado</option>
                @else
                    <option value="1">Activo</option>
                    <option value="0" selected>Desactivado</option>
                @endif
            </select>
        </div>
        <br>
        <div class="group-form-control">
          <button type="submit" class="btn btn-primary" name="guardar" id="guardar">GUARDAR</button>
          <a href="{{ url('findDistrito') }}" class="btn btn-danger">CANCELAR</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('extra')
$("input").on("keypress",function(){
    $input = $(this);
  
    setTimeout(function(){
      $input.val($input.val().toUpperCase());
    },50);
  });
@endsection