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
    
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findProyecto') }}">
        {{ csrf_field() }}
        <div class="row">
            
            <div class="col-xs-5">
                <label for="distrito">Distrito:</label>
                    <select name="distrito" id="distrito" class="form-control">
                      <option value=""></option>
                      @foreach ($distrito as $key => $d)
                      <option value="{{ $d->id_dis }}">{{ $d->distrito }}</option>
                      @endforeach
                    </select>
            </div>
            <div class="col-xs-5">
                <label for="proyecto">Nombre del Proyecto:</label>
                <input class="form-control" id="proyecto" name="proyecto" placeholder="Nombre del Proyecto" type="text">
            </div>

          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createProyecto') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
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
                <th>Nombre del Proyecto</th>
                <th>Codigo EMA</th>
                <th>Presupuesto</th>
              </tr>
              @foreach($proyecto as $key => $p)
              <tr>
                <td>{{ $p->proyecto }}</td>
                <td>
                  @if ($p->estado)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  {{-- Boton Editar --}}
                  <a href="{{ url('editProyecto/'.$p->id_pro) }}" class="btn btn-warning">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                  {{-- Boton Eliminar --}}
                  <a href="{{ url('confirmProyecto/'.$p->id_pro) }}" class="btn btn-danger">
                    <i class="glyphicon glyphicon-trash"></i>
                  </a>
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