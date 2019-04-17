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
            <hr>
            <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeVolumen') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="group-form-control col-xs-4">
                        <label for="fecha">Fecha: </label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="fecha" id="datepicker" required>
                        </div>
                        <input type="hidden" name="id_pro" value="{{ $proy->id_pro }}">
                    </div>
                    <div class="group-form-control col-xs-4">
                        <label for="monto">Monto: </label>
                        <input type="text" name="monto" id="monto" class="form-control" required>
                    </div>
                    <div class="group-form-control col-xs-4">
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                    </div>
                </div>
            </form>
            <hr>
            @if (isset($volumen))
                @if ($estado)
                    <table class="table">
                    <div class="box-footer">
                        <tbody>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tbody>
                    </div>
                    @foreach ($volumen as $key => $v)
                        <tr>
                            <td>{{ formatoFechaReporte($v->fecha) }}</td>
                            <td>{{ $v->monto }}</td>
                            <td>
                                {{-- Boton Editar --}}
                                <a href="{{ url('editVolumen/'.$v->id_mon) }}" class="btn btn-warning">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                {{-- Boton Eliminar --}}
                                <a href="{{ url('confirmVolumen/'.$v->id_mon.'/'.$proy->id_pro) }}" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                @else
                    <h3>
                        <p class="text-red" style="text-align:center;">
                            {{ $mensaje }}
                        </p>
                    </h3>
                @endif
            @endif
            <hr>
            <div class="group-form-control">
                <a href="{{ url('/') }}" class="btn btn-danger">CANCELAR</a>
            </div>
        </form>
    </div>
  </div>
@endsection

@section('extra')

// Campo de Fecha
$('#datepicker').datepicker({
    autoclose: true,
    format: "dd/mm/yyyy"
});

// Validacion de campos requeridos
$('#form input[id=monto]').on('change invalid', function() {
    var campotexto = $(this).get(0);

    campotexto.setCustomValidity('');

    if (!campotexto.validity.valid) {
      campotexto.setCustomValidity('Esta información es requerida, por favor ingrese un número.');  
    }
});

$('#form input[id=datepicker]').on('change invalid', function() {
    var campotexto = $(this).get(0);

    campotexto.setCustomValidity('');

    if (!campotexto.validity.valid) {
      campotexto.setCustomValidity('Ingrese la fecha es un campo requerido.');  
    }
});

@endsection