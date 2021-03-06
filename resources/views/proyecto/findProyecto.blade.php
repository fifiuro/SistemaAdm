@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findProyecto') }}">
        {{ csrf_field() }}
        <div class="row">
            
            <div class="col-xs-5">
                <label for="unidad">Unidad Ejecutora:</label>
                    <select name="unidad" id="unidad" class="form-control">
                      <option value=""></option>
                      @foreach ($unidad as $key => $u)
                      <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                      @endforeach
                    </select>
            </div>
            <div class="col-xs-5">
                <label for="ema">EMA:</label>
                <input class="form-control" id="ema" name="ema" placeholder="EMA" type="text">
            </div>

          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            @switch(Auth::user()->tipoUser(Auth::user()->id))
              @case(1)
              @case(3)
                {{-- Boton Nuevo --}}
                <a href="{{ url('createProyecto') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
                @break
            @endswitch
            
          </div>
        </div>
      </form>
    </div>
        
    @if(isset($proyecto))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Nombre de Distrito</th>
                <th>Ubicacion</th>
                <th>Codigo EMA</th>
                <th>Presupuesto Bs.</th>
                <th>Programado m<sup>3</sup></th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
              @foreach($proyecto as $key => $p)
              <tr>
                <td>
                  <strong>Unidad Ejecutora: </strong>{{ $p->unidad }}<br>
                  <strong>Macro Distrito: </strong>
                  @if($p->macro == '0')
                    Todos
                  @else
                    {{ $p->macro }}
                  @endif
                  <br>
                  <strong>Distrito: </strong>
                  @if($p->distrito == '0')
                    Todos
                  @else
                    {{ $p->distrito }}
                  @endif
                </td>
                <td>{{ $p->ubicacion }}</td>
                <td>{{ $p->ema }}</td>
                <td>{{ formatoDecimal($p->presupuesto) }}</td>
                <td>{{ formatoDecimal($p->programado) }}</td>
                <td>
                  @if ($p->estado)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  @switch(Auth::user()->tipoUser(Auth::user()->id))
                      @case(1)
                          {{-- Boton Editar --}}
                          <a href="{{ url('editProyecto/'.$p->id_pro) }}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                          </a>
                          {{-- Boton Eliminar --}}
                          <a href="{{ url('confirmProyecto/'.$p->id_pro) }}" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                          </a>
                          {{-- Boton estimado --}}
                          <a href="{{ url('findEstimado/'.$p->id_pro) }}" class="btn btn-default">
                            <i class="fa fa-bar-chart-o"></i>
                          </a>
                          {{-- Boton volumes --}}
                          <a href="{{ url('findVolumen/'.$p->id_pro) }}" class="btn btn-primary">
                            <i class="fa fa-area-chart"></i>
                          </a>
                          {{-- Boton imprmir --}}
                          <a href="{{ url('reporteProyecto/'.$p->id_pro) }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-print"></i>
                          </a>
                          @break
                      @case(2)
                          @break
                      @case(3)
                          {{-- Boton Editar --}}
                          <a href="{{ url('editProyecto/'.$p->id_pro.'/'.$p->id_uni) }}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                          </a>
                          {{-- Boton imprmir --}}
                          <a href="{{ url('reporteProyecto/'.$p->id_pro) }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-print"></i>
                          </a>
                          @break
                      @case(4)
                          {{-- Boton estimado --}}
                          <a href="{{ url('findEstimado/'.$p->id_pro) }}" class="btn btn-default">
                            <i class="fa fa-bar-chart-o"></i>
                          </a>
                          {{-- Boton imprmir --}}
                          <a href="{{ url('reporteProyecto/'.$p->id_pro) }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-print"></i>
                          </a>
                          @break
                      @case(5)
                          {{-- Boton volumes --}}
                          <a href="{{ url('findVolumen/'.$p->id_pro) }}" class="btn btn-primary">
                            <i class="fa fa-area-chart"></i>
                          </a>
                          {{-- Boton imprmir --}}
                          <a href="{{ url('reporteProyecto/'.$p->id_pro) }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-print"></i>
                          </a>
                          @break
                      @default
                          
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