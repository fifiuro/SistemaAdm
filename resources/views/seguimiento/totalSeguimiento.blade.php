@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR TOTALES DEL PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findTotal') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-2">
                <label for="gestion">Gestion:</label>
                <select name="gestion" id="gestion" class="form-control">
                    @foreach ($gestion as $key => $g)
                        <option value="{{ $g->id_ges }}">{{ $g->gestion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-3">
                <label for="mesI">Mes Inicio:</label>
                <select name="mesI" id="mesI" class="form-control">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="col-xs-3">
                <label for="mesF">Mes Fin:</label>
                <select name="mesF" id="mesF" class="form-control">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
            <div class="col-xs-2">
                <label for="ema">EMA</label>
                <input type="text" name="ema" id="ema" class="form-control">
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
                    <strong>Macro Distrito: </strong>
                    @if(is_null($r->nombre_mac))
                        GAMLP
                    @else
                        {{ $r->nombre_mac }}
                    @endif
                    <br>
                    <strong>Distrito: </strong>
                    @if(is_null($r->nombre_dis))
                        GAMLP
                    @else
                        {{ $r->nombre_dis }}
                    @endif
                    <br>
                    <strong>EMA: </strong>{{ $r->ema }}<br>
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
                            <td><strong>Volumen</strong></td>
                        </tr>
                        @foreach ($estimado as $key => $e)
                            @if ($e->id_pro == $r->id_pro)
                                <tr>
                                    <td>{{ nombreMes($e->fecha) }}</td>
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
                            <td><strong>Volumen</strong></td>
                        </tr>
                        @foreach ($result as $key => $re)
                            @if ($r->id_pro == $re->id_pro)
                                <tr>
                                    <td>{{ nombreMes($re->mes) }}</td>
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