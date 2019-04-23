@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR GESTION
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findGestion') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-10">
                <label for="unidad">Gestion:</label>
                <input class="form-control" id="gestion" name="gestion" placeholder="Gestion" type="text">
            </div>
          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createGestion') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </form>
    </div>
    @if(isset($gestion))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Gestion</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
              @foreach($gestion as $key => $g)
              <tr>
                <td>{{ $g->gestion }}</td>
                <td>
                  @if ($g->estado)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  @switch(Auth::user()->tipoUser(Auth::user()->id))
                      @case(1)
                          {{-- Boton Editar --}}
                          <a href="{{ url('editGestion/'.$g->id_ges) }}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                          </a>
                          {{-- Boton Eliminar --}}
                          <a href="{{ url('confirmGestion/'.$g->id_ges) }}" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                          </a>
                          @break
                      @case(2)
                          {{-- Boton Editar --}}
                          <a href="{{ url('editGestion/'.$g->id_ges) }}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                          </a>
                          @break
                      @case(3)
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