@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVO MACRO DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeMacro') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="id_uni">Unidad Ejecutora:</label>
            <select name="id_uni[]" id="id_uni" class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidad Ejecutora" style="width: 100%;" required>
                <option value=""></option>
                @foreach ($unidad as $key => $u)
                    <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                @endforeach
            </select>
        </div>
        <div class="group-form-control">
            <label for="nombre_mac">Nombre Macro Distrito:</label>
            <input class="form-control" id="nombre_mac" name="nombre_mac" placeholder="Nombre de Macro Distrito" type="text" required>
        </div>
        <div class="group-form-control">
            <label for="numero_mac">Número de Macro Distrito:</label>
            <input class="form-control" id="numero_mac" name="numero_mac" placeholder="Número de Macro Distrito" type="number" required>
        </div>
        <br>
        <div class="group-form-control">
          <button type="submit" class="btn btn-primary" name="guardar" id="guardar">GUARDAR</button>
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