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
<div class="box box-primary">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findUnidad') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-5">
                <label for="gestion">Gestión:</label>
                <select name="gestion" id="gestion" class="form-control">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-xs-5">
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





    @if(isset($alumno))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Acciones</th>
              </tr>
              @foreach($alumno as $key => $a)
              <tr>
                <td>{{ $a->nombre }}</td>
                <td>{{ $a->apellidos }}</td>
                <td>{{ $a->celular }}</td>
                <td>{{ $a->email }}</td>
                <td>
                  {{-- Boton Editar --}}
                  <a href="{{ url('editAlumno/'.$a->id_alu) }}" class="btn btn-warning">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                  {{-- Boton Eliminar --}}
                  <a href="{{ url('confirmAlumno/'.$a->id_pe) }}" class="btn btn-danger">
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