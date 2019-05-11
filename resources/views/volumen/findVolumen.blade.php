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
<div class="box box-danger">
    <div class="box-body">
        <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeVolumen') }}">
            {{ csrf_field() }}
            @foreach ($proy as $key => $p)
                <div class="group-form-control col-xs-4">
                    <label for="proyecto">Unidad Ejecutora:</label>
                    {{ $p->unidad_ejecutora }}
                </div>
                <div class="group-form-control col-xs-4">
                    <label for="proyecto">Macro Distrito:</label>
                    {{ $p->nombre_mac }}
                </div>
                <div class="group-form-control col-xs-4">
                    <label for="proyecto">Distrito:</label>
                    {{ $p->nombre_dis }}
                </div>
                <div class="group-form-control">
                    <label for="proyecto">Proyecto:</label>
                    {{ $p->nombre_pro }}
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label for="ema">EMA:</label>
                        {{ $p->ema }}
                    </div>
                    <div class="col-xs-3">
                        <label for="presupuesto">Monto de Contrato:</label>
                        {{ formatoDecimal($p->presupuesto) }} <strong>Bs.</strong>
                    </div>
                    <div class="col-xs-3">
                        <label for="presupuesto">Volumen Proyectado:</label>
                        {{ formatoDecimal($p->programado) }}
                    </div>
                    <div class="col-xs-3">
                        <label for="estado">Estado:</label>
                        @if ($p->estado == 1)
                            Activo
                        @else
                            Desactivado
                        @endif
                    </div>
                </div>
                @if ($p->estado == 1)
                    <hr>
                    <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeEstimado') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="group-form-control col-xs-4">
                                <label for="fecha">Fecha: </label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="fecha" id="datepicker" autocomplete="off" required>
                                </div>
                                <input type="hidden" name="id_pro" value="{{ $proy[0]->id_pro }}">
                            </div>
                            <div class="group-form-control col-xs-4">
                                <label for="monto">Volumen Proyectado: </label>
                                <input type="text" name="monto" id="monto" class="form-control" required>
                            </div>
                            <div class="group-form-control col-xs-4">
                                <button type="submit" class="btn btn-primary">GUARDAR</button>
                            </div>
                        </div>
                    </form>
                @endif
            @endforeach
            <hr>
            @if (isset($volumen))
                @if ($estado)
                    <table class="table">
                    <div class="box-footer">
                        <tbody>
                            <th>Fecha</th>
                            <th>Volumen</th>
                            <th>Acciones</th>
                        </tbody>
                    </div>
                    @foreach ($volumen as $key => $v)
                        <tr>
                            <td>{{ formatoFechaReporte($v->fecha) }}</td>
                            <td>{{ formatoDecimal($v->monto) }}</td>
                            <td>
                                @switch(Auth::user()->tipoUser(Auth::user()->id))
                                    @case(1)
                                        {{-- Boton Editar --}}
                                        <a href="{{ url('editVolumen/'.$v->id_mon) }}" class="btn btn-warning">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        {{-- Boton Eliminar --}}
                                        <a href="{{ url('confirmVolumen/'.$v->id_mon.'/'.$proy[0]->id_pro) }}" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                        @break
                                    @case(5)
                                        {{-- Boton Editar --}}
                                        <a href="{{ url('editVolumen/'.$v->id_mon) }}" class="btn btn-warning">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        @break                                        
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align:right"><h3><strong>TOTAL</strong></h3></td>
                        <td>
                            <h3>{{ formatoDecimal($sum[0]->total) }}</h3>
                        </td>
                        <td>
                            <h3><strong>Saldo:</strong> {{ formatoDecimal($proy[0]->programado - $sum[0]->total) }}</h3>
                        </td>
                    </tr>
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
                <a href="{{ url('findProyecto') }}" class="btn btn-danger">VOLVER</a>
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