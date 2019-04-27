@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR UNIDAD EJECUTORA
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findUnidad') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-10">
                <label for="unidad">Unidad Ejecutora:</label>
                <input class="form-control" id="unidad" name="unidad" placeholder="Unidad Ejecutora" type="text">
            </div>
          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createUnidad') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </form>
    </div>
    @if(isset($unidad))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Unidad Ejecutora</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
              @foreach($unidad as $key => $u)
              <tr>
                <td>{{ $u->unidad_ejecutora }}</td>
                <td>
                  @if ($u->estado == 1)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  @switch(Auth::user()->tipoUser(Auth::user()->id))
                    @case(1)
                      {{-- Boton Editar --}}
                      <a href="{{ url('editUnidad/'.$u->id_uni) }}" class="btn btn-warning">
                        <i class="glyphicon glyphicon-pencil"></i>
                      </a>
                      {{-- Boton Eliminar --}}
                      <a href="{{ url('confirmUnidad/'.$u->id_uni) }}" class="btn btn-danger">
                        <i class="glyphicon glyphicon-trash"></i>
                      </a>
                      @break
                    @case(2)
                      {{-- Boton Editar --}}
                      <a href="{{ url('editUnidad/'.$u->id_uni) }}" class="btn btn-warning">
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