@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVO PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateProyecto') }}">
        {{ csrf_field() }}
        @foreach ($proyecto as $key => $p)
            <div class="group-form-control">
                <label for="distrito">Distrito:</label>
                <input type="text" name="distrito" id="distrito" value="{{ $p->nombre_dis }}" class="form-control" disabled>
                <input type="hidden" name="id_pro" value="{{ $p->id_pro }}" required>
            </div>
            <div class="group-form-control">
                <label for="nombre_pro">Nombre del Proyecto:</label>
                <input class="form-control" id="nombre_pro" name="nombre_pro" placeholder="Nombre del Proyecto" type="text" value="{{ $p->nombre_pro }}" required>
            </div>
            <div class="group-form-control">
                    <label for="ema">Codigo EMA:</label>
                    <input class="form-control" id="ema" name="ema" placeholder="Codigo EMA" type="text" value="{{ $p->ema}}" required>
            </div>
            <div class="group-form-control">
                    <label for="presupuesto">Presupuesto:</label>
                    <input class="form-control" id="presupuesto" name="presupuesto" placeholder="Presupuesto" type="text" value="{{ $p->presupuesto }}" required>
            </div>

            <div class="group-form-control">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control">
                    @if($p->estado)
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