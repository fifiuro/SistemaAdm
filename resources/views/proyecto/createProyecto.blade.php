@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVA PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeProyecto') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="distrito">Distrito:</label>
            <select name="id_dist" class="form-control">
            @foreach ($distrito as $key => $d)
              <option value="{{$d->id_dist}}">{{$d->nombre_dis}}</option>  
            @endforeach
            </select>
        </div>
        <div class="group-form-control">
            <label for="nombre_pro">Nombre del Proyecto:</label>
            <input class="form-control" id="nombre_pro" name="nombre_pro" placeholder="Nombre del Proyecto" type="text" required>
        </div>
        <div class="group-form-control">
            <label for="ema">Codigo EMA:</label>
            <input class="form-control" id="ema" name="ema" placeholder="Codigo EMA" type="text" required>
        </div>
        <div class="group-form-control">
            <label for="presupuesto">Presupuesto:</label>
            <input class="form-control" id="presupuesto" name="presupuesto" placeholder="Presupuesto" type="text" required>
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