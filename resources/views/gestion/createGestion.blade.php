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

<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeGestion') }}">
        {{ csrf_field() }}
        <div class="group-from-control">
            <label for="unidad">Gestion:</label>
            <input class="form-control" id="gestion" name="gestion" placeholder="Gestion" type="text" required>
        </div>
        <br>
        <div class="group-from-control">
          <button type="submit" class="btn btn-primary" name="guardar" id="guardar">GUARDAR</button>
          <a href="{{ url('findGestion') }}" class="btn btn-danger">CANCELAR</a>
        </div>
      </form>
    </div>

</div>


@endsection

@section('extra')

@endsection