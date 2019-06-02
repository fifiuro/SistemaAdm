@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR VOLUMEN
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateVolumen') }}">
        {{ csrf_field() }}
        <div class="group-form-control">
            <label for="fecha">Fecha: </label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="fecha" id="datepicker" value="{{ formatoFechaReporte($volumen->fecha) }}" required>
            </div>
            <input type="hidden" name="fechaA" value="{{ $volumen->fecha }}">
            <input type="hidden" name="id_mon" value="{{ $volumen->id_mon }}">
            <input type="hidden" name="id_pro" value="{{ $volumen->id_pro }}">
        </div>
        <div class="group-form-control">
            <label for="monto">Monto: </label>
            <input type="text" name="monto" id="monto" class="form-control" value="{{ $volumen->monto }}" required>
            <input type="hidden" name="montoA" value="{{ $volumen->monto }}">
        </div>
        <div class="group-form-control">
            <label for="monto">Numero de Boleta: </label>
            <input type="text" name="boleta" id="boleta" class="form-control" value="{{ $volumen->numero_boleta }}" required>
            <input type="hidden" name="boletaA" value="{{ $volumen->numero_boleta }}">
        </div>
        <hr>
        <div class="group-form-control">
            <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
            <a href="{{ url('findVolumen/'.$volumen->id_pro) }}" class="btn btn-danger">CANCELAR</a>
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