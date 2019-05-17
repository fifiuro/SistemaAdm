@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR DETALLES PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findDetalle') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-4">
                <label for="gestion">Gestion:</label>
                <select name="gestion" id="gestion" class="form-control">
                    @foreach ($gestion as $key => $g)
                        <option value="{{ $g->id_ges }}">{{ $g->gestion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-4">
                <label for="proyecto">Tipo Proyecto:</label>
                <select name="proyecto" id="proyecto" class="form-control">
                    <option></option>
                    <option>Recapeo</option>
                    <option>Bacheo</option>
                    <option>Asfalto</option>
                </select>
            </div>
            <div class="col-xs-4" style="z-index:0">
                <div class="form-group">
                    <label for="fecha">Fechas:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="fecha" id="reservation">
                    </div>
                </div>
            </div>

          <div class="col-xs-2">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </form>
    </div>
    
    
    @if(isset($result))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Datos proyecto</th>
                <th>Adjudicado A</th>
                <th>Estimado</th>
                <th>Volumen Real</th>
                <th>Acciones</th>
              </tr>
              @foreach($proy as $key => $r)
              <tr>
                <td>
                    <strong>Getion: </strong>{{ $r->gestion }}<br>
                    <strong>Unidad Ejecutora: </strong>{{ $r->unidad_ejecutora }}<br>
                    <strong>Macro Distrito: </strong>{{ $r->nombre_mac }}<br>
                    <strong>Distrito: </strong> {{ $r->nombre_dis }}<br>
                    <strong>Nombre Proyecto: </strong>{{ $r->nombre_pro }}<br>
                    <strong>Volumen Presupuestado: </strong>{{ formatoDecimal($r->presupuesto) }} Bs.<br>
                    <strong>volumen Programado: </strong>{{ formatoDecimal($r->programado) }} m<sup>3</sup>
                </td>
                <td>
                    <strong>Documento: </strong>{{ $r->adjudicacion }}<br>
                    <strong>Fecha: </strong>{{ formatoFechaReporte($r->fecha_adjudicacion) }}
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td><strong>Fecha</strong></td>
                            <td><strong>Monto</strong></td>
                        </tr>
                        @foreach ($estimado as $key => $e)
                            @if ($e->id_pro == $r->id_pro)
                                <tr>
                                    <td>{{ formatoFechaReporte($e->fecha) }}</td>
                                    <td>{{ $e->volumen }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td><strong>Fecha</strong></td>
                            <td><strong>Monto</strong></td>
                        </tr>
                        @foreach ($result as $key => $re)
                            @if ($r->id_pro == $re->id_pro)
                                <tr>
                                    <td>{{ formatoFechaReporte($re->fecha) }}</td>
                                    <td>{{ $re->monto }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </td>
                <td>
                    @switch(Auth::user()->tipoUser(Auth::user()->id))
                    @case(2)
                        {{-- Boton Exportar a Excel --}}
                        <a href="{{ url('exportarExcel/'.$r->id_pro) }}" class="btn btn-success">
                            <i class="fa fa-file-excel-o"></i>
                        </a>
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
//Date range picker
$('#reservation').daterangepicker({
    "locale": {
        "format": "DD/MM/YYYY",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "DE",
        "toLabel": "HASTA",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ]
    }
});
@endsection