@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    BUSCAR MODIFICACIONES
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findModificaciones') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-4">
                <label for="tabla">Tabla:</label>
                <select name="tabla" id="tabla" class="form-control">
                    <option value=""></option>
                        @for ($i = 0; $i < count($tabla); $i++)
                            <option value="{{ $tabla[$i] }}">{{ $tabla[$i] }}</option>
                        @endfor
                </select>
            </div>
            <div class="col-xs-3">
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
            <div class="col-xs-3">
                <label for="nombre">Nombre de Usuario:</label>
                <input class="form-control" id="nombre" name="nombre" placeholder="Nombre de Usuario" type="text">
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
                <th>Tabla</th>
                <th>Dato Anterior</th>
                <th>Dato Actual</th>
                <th>Fecha de Modificación</th>
                <th>Nombre de Usuario</th>
              </tr>
              @foreach($result as $key => $r)
              <tr>
                <td>{{ $r->tabla }}</td>
                <td>{{ $r->anterior }}</td>
                <td>{{ $r->actual }}</td>
                <td>{{ formatoFechaReporte($r->fecha) }}</td>
                <td>{{ $r->name }}</td>
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