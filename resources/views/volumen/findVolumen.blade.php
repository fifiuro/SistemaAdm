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
            {{ csrf_field() }}
            @foreach ($proy as $key => $p)
                <div class="row">
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
                </div>
                <div class="row">
                    <div class="group-form-control col-xs-12">
                        <label for="proyecto">Proyecto:</label>
                        {{ $p->nombre_pro }}
                    </div>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeVolumen') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="group-form-control col-xs-4">
                                        <label for="fecha">Fecha: </label>
                                        <div class="input-group date" style="position:relative; z-index:1000">
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
                        </div>
                    </div>
                @endif
            @endforeach
            <hr>
                <div class="row">
                @if ($estado)
                    <div class="col-xs-6">
                        <h3 class="text-center">TABLA DE VOLUMEN</h3>
                        @if(isset($volumen) and count($volumen) > 0)
                        <table class="table">
                            <tbody>
                                <th>Fecha</th>
                                <th>Volumen</th>
                                <th>Acciones</th>
                            </tbody>
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
                                <td></td>
                                <td style="text-align:right">
                                    <h3><strong>TOTAL</strong> {{ formatoDecimal($sum[0]->total) }} m<sup>3</sup></h3>
                                </td>
                                <td>
                                    <h3><strong>SALDO:</strong> {{ formatoDecimal($proy[0]->programado - $sum[0]->total) }} m<sup>3</sup></h3>
                                </td>
                            </tr>
                        </table>
                        @endif
                    </div>

                    <div class="col-xs-6">
                        <h3 class="text-center">TABLA DE ESTIMADO</h3>
                        @if(isset($estimado) and count($estimado) > 0)
                        <table class="table">
                            <tbody>
                                <th>Fecha</th>
                                <th>Volumen</th>
                                <th>Tipo</th>
                            </tbody>
                            @foreach ($estimado as $key => $e)
                                <tr>
                                    <td>{{ formatoFechaReporte($e->fecha) }}</td>
                                    <td>{{ formatoDecimal($e->volumen) }}</td>
                                    <td>{{ $e->tipo }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td style="text-align:right">
                                    <h3><strong>TOTAL</strong> {{ formatoDecimal($sume[0]->total) }} m<sup>3</sup></h3>
                                </td>
                            </tr>
                        </table>
                        @endif
                    </div>
                @else
                    <h3>
                        <p class="text-red" style="text-align:center;">
                            {{ $mensaje }}
                        </p>
                    </h3>
                @endif
                </div>
            <hr>
            <div class="group-form-control">
                <a href="{{ url('findProyecto') }}" class="btn btn-danger">VOLVER</a>
            </div>
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