@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR GESTION
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')

<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateGestion') }}">
        {{ csrf_field() }}        
        <div class="group-from-control">
            <label for="unidad">Gestion:</label>
            <input class="form-control" id="gestion" name="gestion" placeholder="Gestion" type="text" value="{{ $gestion->gestion }}">
            <input type="hidden" name="gestionA" value="{{ $gestion->gestion }}">
            <input type="hidden" name="id_ges" value="{{$gestion->id_ges}}">
        </div>
        <div class="group-from-control">
            <label for="unidad">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                @if($gestion->estado)
                <option value="1" selected>Activo</option>
                <option value="0">Desactivado</option>
                @else
                <option value="1" >Activo</option>
                <option value="0"selected>Desactivado</option>
                @endif
            </select>
            <input type="hidden" name="estadoA" value="{{ $gestion->estado }}">
        </div>
        <br>
        <div class="group-from-control">
          <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
          <a href="{{ url('findGestion') }}" class="btn btn-danger">CANCELAR</a>
        </div>
      </form>
    </div>

  </div>


@endsection

@section('extra')

@endsection