@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR ESTIMADO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateEstimado') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="fecha">Fecha: </label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="fecha" id="datepicker" value="{{ formatoFechaReporte($estimado->fecha) }}" required>
            </div>
            <input type="hidden" name="fechaA" value="{{ $estimado->fecha }}">
            <input type="hidden" name="id_est" value="{{ $estimado->id_est }}">
            <input type="hidden" name="id_pro" value="{{ $estimado->id_pro }}">
        </div>
        <div class="group-form-control">
            <label for="monto">Volumen: </label>
            <input type="text" name="monto" id="monto" class="form-control" value="{{ $estimado->volumen }}" required>
            <input type="hidden" name="montoA" value="{{ $estimado->volumen }}">
        </div>
        <div class="group-form-control">
            <label for="tipo">Tipo de mezcla: </label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value=" "></option>
                @if($estimado->tipo == 'Recapeo')
                    <option selected>Recapeo</option>
                    <option>Bacheo</option>
                    <option>Asfalto</option>
                @elseif($estimado->tipo == 'Bacheo')
                    <option>Recapeo</option>
                    <option selected>Bacheo</option>
                    <option>Asfalto</option>
                @elseif($estimado->tipo == 'Asfalto')
                    <option>Recapeo</option>
                    <option>Bacheo</option>
                    <option selected>Asfalto</option>
                @else
                    <option>Recapeo</option>
                    <option>Bacheo</option>
                    <option>Asfalto</option>
                @endif
            </select>
            <input type="hidden" name="tipoA" value="{{ $estimado->tipo }}">
        </div>
        <hr>
        <div class="group-form-control">
            <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
            <a href="{{ url('findEstimado/'.$estimado->id_pro) }}" class="btn btn-danger">CANCELAR</a>
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