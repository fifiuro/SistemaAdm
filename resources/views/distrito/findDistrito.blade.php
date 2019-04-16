@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findDistrito') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-5">
                <label for="id_uni">Unidad:</label>
                <select name="id_uni" id="id_uni" class="form-control">
                  <option value=""></option>
                  @foreach ($unidad as $key => $u)
                    <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-xs-5">
                <label for="distrito">Nombre Distrito:</label>
                <input class="form-control" id="distrito" name="distrito" placeholder="Nombre Distrito" type="text">
            </div>
          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createDistrito') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </form>
    </div>
    @if(isset($distrito))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Unidad Ejecutora</th>
                <th>Distrito</th>
                <th>Número</th>
                <th>Ubicacion</th>
                <th>Acciones</th>
              </tr>
              @foreach($distrito as $key => $d)
              <tr>
                <td>{{ $d->unidad_ejecutora }}</td>
                <td>{{ $d->nombre_dis }}</td>
                <td>{{ $d->numero_dis }}</td>
                <td>{{ $d->ubicacion }}</td>
                <td>
                  @if ($d->estado == 1)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  {{-- Boton Editar --}}
                  <a href="{{ url('editDistrito/'.$d->id_dist) }}" class="btn btn-warning">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                  {{-- Boton Eliminar --}}
                  <a href="{{ url('confirmDistrito/'.$d->id_dist) }}" class="btn btn-danger">
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