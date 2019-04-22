@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR USUARIOS
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findUsuario') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-5">
                <label for="nombre">Nombre:</label>
                <input class="form-control" id="nombre" name="nombre" placeholder="Nombre de Usuario" type="text">
            </div>
            <div class="col-xs-5">
                <label for="email">Correo Electrónico:</label>
                <input class="form-control" id="email" name="email" placeholder="Correo Electrónico" type="text">
            </div>
            <div class="col-xs-2">
                {{-- Boton Buscar --}}
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                {{-- Boton Nuevo --}}
                <a href="{{ url('createUsuario') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
        </div>
      </form>
    </div>
    @if(isset($usuario))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Cargo</th>
                <th>Unidad</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
              @foreach($usuario as $key => $u)
              <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->cargo }}</td>
                <td>{{ $u->unidad }}</td>
                <td>
                  @if ($u->estado)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  {{-- Boton Editar --}}
                  <a href="{{ url('editUsuario/'.$u->id) }}" class="btn btn-warning">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                  {{-- Boton Eliminar --}}
                  <a href="{{ url('confirmUsuario/'.$u->id) }}" class="btn btn-danger">
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