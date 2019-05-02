@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    SEGUIMIENTO DE PROYECTOS
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findSeguimiento') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-2">
                <label for="gestion">Gestion:</label>
                <select name="gestion" id="gestion" class="form-control">
                  <option value=""></option>
                  @foreach ($gestion as $key => $g)
                    <option value="{{ $g->id_ges }}">{{ $g->gestion }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-xs-3">
                <label for="macro">Macro Distrito:</label>
                <input class="form-control" id="macro" name="macro" placeholder="Macro Distrito" type="text">
            </div>
            <div class="col-xs-2">
                <label for="distrito">Distrito:</label>
                <input class="form-control" id="distrito" name="distrito" placeholder="Distrito" type="text">
            </div>
            <div class="col-xs-3">
              <label for="proyecto">Proyecto:</label>
              <input class="form-control" id="proyecto" name="proyecto" placeholder="Distrito" type="text">
            </div>
          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </form>
    </div>
    @if(isset($seg))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Gestion</th>
                <th>Unidad Ejecutora</th>
                <th>Macro Distrito</th>
                <th>Distrito</th>
                <th>Proyecto</th>
                <th>Volumen Total</th>
                <th>Acciones</th>
              </tr>
              @foreach($seg as $key => $s)
              <tr>
                <td>{{ $s->gestion }}</td>
                <td>{{ $s->unidad_ejecutora }}</td>
                <td>{{ $s->nombre_mac }}</td>
                <td>{{ $s->nombre_dis }}</td>
                <td>{{ $s->nombre_pro }}</td>
                <td>
                  @if(($s->programado - $s->total) > 0)
                    <span style="color:green"><strong>{{ ($s->programado - $s->total) }}</strong></span>
                  @else
                    <span style="color:red"><strong>{{ ($s->programado - $s->total) }}</strong></span>
                  @endif
                </td>
                <td>
                  @switch(Auth::user()->tipoUser(Auth::user()->id))
                      @case(3)
                          {{-- Boton Supervisar --}}
                          <a href="{{ url('supervisar/'.$s->id_dist.'/0') }}" class="btn btn-primary">
                            <i class="fa fa-bar-chart"></i>
                          </a>
                          @break
                  @endswitch
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <h3>
        <p class="text-red" style="text-align:center;">
          {{ $mensaje }}
        </p>
        </h2>
      @endif
    @endif
  </div>
@endsection

@section('extra')

@endsection