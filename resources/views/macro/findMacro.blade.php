@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR MACRO DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findMacro') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-5">
                <label for="id_uni">Unidad:</label>
                <select name="id_uni" id="id_uni" class="form-control" required>
                  <option value=""></option>
                  @foreach ($unidad as $key => $u)
                    <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-xs-5">
                <label for="nombre">Nombre Macro Distrito:</label>
                <input class="form-control" id="nombre" name="nombre" placeholder="Nombre Macro Distrito" type="text">
            </div>
          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {{-- Boton Nuevo --}}
            <a href="{{ url('createMacro') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </form>
    </div>
    @if(isset($macro))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Unidad Ejecutora</th>
                <th>Macro Distrito</th>
                <th>Número</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
              @foreach($macro as $key => $m)
              <tr>
                <td>{{ $m->unidad_ejecutora }}</td>
                <td>{{ $m->nombre_mac }}</td>
                <td>{{ $m->numero_mac }}</td>
                <td>
                  @if ($m->estado == 1)
                    <i class="fa fa-fw fa-check" style="color:green"></i>
                  @else
                    <i class="fa fa-fw fa-close" style="color:red"></i>
                  @endif
                </td>
                <td>
                  @switch(Auth::user()->tipoUser(Auth::user()->id))
                      @case(1)
                          {{-- Boton Editar --}}
                          <a href="{{ url('editMacro/'.$m->id_mac) }}" class="btn btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                          </a>
                          {{-- Boton Eliminar --}}
                          <a href="{{ url('confirmMacro/'.$m->id_mac) }}" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                          </a>
                          @break
                      @case(2)
                          {{-- Boton Editar --}}
                          <a href="{{ url('editMacro/'.$m->id_mac) }}" class="btn btn-warning">
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