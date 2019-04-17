@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR PROYECTO / VOLUMEN
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-primary">
    <div class="box-body">
        <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeVolumen') }}">
            {{ csrf_field() }}
            <div class="group-form-control">
                <label for="proyecto">Proyecto:</label>
                {{ $proy->nombre_pro }}
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <label for="ema">EMA:</label>
                    {{ $proy->ema }}
                </div>
                <div class="col-xs-4">
                    <label for="presupuesto">Presupuesto:</label>
                    {{ $proy->presupuesto }}
                </div>
                <div class="col-xs-4">
                    <label for="estado">Estado:</label>
                    @if ($proy->estado == 1)
                        Activo
                    @else
                        Desactivado
                    @endif
                </div>
            </div>

            <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeVolumen') }}">
                {{ csrf_field() }}
                <fiv class="row">
                    <div class="group-form-control col-xs-4">
                        <label for="fecha">Fecha: </label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="group-form-control col-xs-4">
                        <label for="monto">Monto: </label>
                        <input type="text" name="monto" id="monto" class="form-control">
                    </div>
                    <div class="group-form-control col-xs-4">
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                </fiv>
            </form>
            @if (isset($volumen))
                @if ($estado)
                    <div class="box-footer">
                        <tbody>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tbody>
                    </div>
                    @foreach ($volumen as $key => $v)
                        <tr>
                            <td>{{ $v->fecha }}</td>
                            <td>{{ $v->monto }}</td>
                            <td>
                                {{-- Boton Editar --}}
                                <a href="{{ url('editVolumen/'.$v->id_mon) }}" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                {{-- Boton Eliminar --}}
                                <a href="{{ url('confirmVolumen/'.$v->id_mon) }}" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h3>
                        <p class="text-red" style="text-align:center;">
                            {{ $mensaje }}
                        </p>
                    </h3>
                @endif
            @endif
            <div class="group-form-control">
                <a href="{{ url('/') }}" class="btn btn-danger">CANCELAR</a>
            </div>
        </form>
    </div>
    @if(isset($volumen))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Acciones</th>
              </tr>
              @foreach($volumen as $key => $v)
              <tr>
                <td>{{ $v->fecha }}</td>
                <td>{{ $v->monto }}</td>
                <td>
                  {{-- Boton Editar --}}
                  <a href="{{ url('editVolumen/'.$v->id_mon) }}" class="btn btn-warning">
                    <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                  {{-- Boton Eliminar --}}
                  <a href="{{ url('confirmVolumen/'.$v->id_mon) }}" class="btn btn-danger">
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