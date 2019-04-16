@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVO DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeDistrito') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="id_uni">Unidad Ejecutora:</label>
            <select name="id_uni" id="id_uni" class="form-control">
              <option value=""></option>
              @foreach ($unidad as $key => $u)
                <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
              @endforeach
            </select>
        </div>
        <div class="group-form-control">
            <label for="nombre">Nombre de Distrito:</label>
            <input class="form-control" id="nombre" name="nombre" placeholder="Nombre de Distrito" type="text" required>
        </div>
        <div class="group-form-control">
            <label for="numero">Número de Distrito:</label>
            <input class="form-control" id="numero" name="numero" placeholder="Número de Distrito" type="text" required>
        </div>
        <div class="group-form-control">
            <label for="ubicacion">Ubicación:</label>
            <input class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" type="text" required>
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

@endsection