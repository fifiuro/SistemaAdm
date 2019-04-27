@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR MACRO DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateMacro') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="id_uni">Unidad Ejecutora:</label>
            <select name="id_uni[]" id="id_uni" class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidad Ejecutora" style="width: 100%;" required>
                <option value=""></option>
                @foreach ($unidad as $key => $u)
                    @if(buscarDato($unma, $u->id_uni))
                        <option value="{{ $u->id_uni }}" selected>{{ $u->unidad_ejecutora }}</option>
                    @else
                        <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="group-form-control">
            <label for="nombre_mac">Nombre Macro Distrito:</label>
            <input class="form-control" id="nombre_mac" name="nombre_mac" placeholder="Nombre de Macro Distrito" type="text" value="{{ $macro->nombre_mac }}" required>
            <input type="hidden" name="id_mac" id="id_mac" value="{{ $macro->id_mac }}">
        </div>
        <div class="group-form-control">
            <label for="numero_mac">Número de Macro Distrito:</label>
            <input class="form-control" id="numero_mac" name="numero_mac" placeholder="Número de Macro Distrito" type="number" value="{{ $macro->numero_mac }}" required>
        </div>
        <div class="group-form-control">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                @if($macro->estado == 1)
                    <option value="1" selected>Activo</option>
                    <option value="0">Desactivado</option>
                @elseif($macro->estado == 0)
                    <option value="1">Activo</option>
                    <option value="0" selected>Desactivado</option>
                @endif
            </select>
        </div>
        <br>
        <div class="group-form-control">
          <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
          <a href="{{ url('findMacro') }}" class="btn btn-danger">CANCELAR</a>
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

$(".select2").select2();
@endsection