@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('updateProyecto') }}">
        {{ csrf_field() }}
        @foreach ($proyecto as $key => $p)
            <div class="group-form-control">
                <label for="gestion">Gestión:</label>
                @foreach ($gestion as $key => $g)
                    @if($p->id_ges == $g->id_ges)
                        <input class="form-control" id="gestion" name="gestion" placeholder="Gestion" type="text" value="{{ $g->gestion }}" disabled>
                        <input type="hidden" name="id_ges" value="{{ $g->id_ges }}" required>
                    @endif
                @endforeach
            </div>
            <div class="group-form-control">
                <label for="distrito">Distrito:</label>
                <input type="text" name="distrito" id="distrito" value="{{ $p->nombre_dis }}" class="form-control" disabled>
                <input type="hidden" name="id_pro" value="{{ $p->id_pro }}" required>
                <input type="hidden" name="id_dist" id="id_dist" value="{{ $p->id_dist }}">
            </div>
            <div class="group-form-control">
                <label for="nombre_pro">Nombre del Proyecto:</label>
                <select name="nombre_pro" id="nombre_pro" class="form-control" required>
                    @if($p->nombre_pro == 'Señalización')
                        <option selected>Señalización</option>
                        <option>Recapeo</option>
                        <option>Bacheo</option>
                        <option>Asfalto</option>
                    @elseif($p->nombre_pro == 'Recapeo')
                        <option>Señalización</option>
                        <option selected>Recapeo</option>
                        <option>Bacheo</option>
                        <option>Asfalto</option>
                    @elseif($p->nombre_pro == 'Bacheo')
                        <option>Señalización</option>
                        <option>Recapeo</option>
                        <option selected>Bacheo</option>
                        <option>Asfalto</option>
                    @elseif($p->nombre_pro == 'Asfalto')
                        <option>Señalización</option>
                        <option>Recapeo</option>
                        <option>Bacheo</option>
                        <option selected>Asfalto</option>
                    @endif
                </select>
                <input type="hidden" name="nombre_proA" value="{{ $p->nombre_pro }}">
            </div>
            <div class="group-form-control">
                <label for="ubicacion">Ubicacion:</label>
                <input class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicacion" type="text" value="{{ $p->ubicacion }}" required>
                <input type="hidden" name="ubicacionA" value="{{ $p->ubicacion }}">
            </div>
            <div class="group-form-control">
                <label for="ema">Codigo EMA:</label>
                <input class="form-control" id="ema" name="ema" placeholder="Codigo EMA" type="text" value="{{ $p->ema}}" required>
                <input type="hidden" name="emaA" value="{{ $p->ema }}">
            </div>
            <div class="group-form-control">
                <label for="presupuesto">Volumen Presupuesto:</label>
                <input class="form-control" id="presupuesto" name="presupuesto" placeholder="Presupuesto" type="text" value="{{ $p->presupuesto }}" required>
                <input type="hidden" name="presupuestoA" value="{{ $p->presupuesto }}">
            </div>
            <div class="group-form-control">
                <label for="programado">Volumen Proyectado:</label>
                <input class="form-control" id="programado" name="programado" placeholder="Volumen Programado" type="text" value="{{ $p->programado }}" required>
                <input type="hidden" name="programadoA" value="{{ $p->programado }}">
            </div>
            <div class="group-form-control">
                <label for="adjudicado">Adjudico A:</label>
                <input class="form-control" id="adjudicado" name="adjudicado" placeholder="Adjudicado A" type="text" value="{{ $p->adjudicacion }}" required>
                <input type="hidden" name="adjudicadoA" value="{{ $p->adjudicacion }}">
            </div>
            <div class="group-form-control">
                <label for="fecha">Fecha de Adjudicación:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="fecha" class="form-control pull-right" id="datepicker" value="{{ formatoFechaReporte($p->fecha_adjudicacion) }}" required>
                    <input type="hidden" name="fechaA" value="{{ formatoFechaReporte($p->fecha_adjudicacion) }}">
                </div>
            </div>
            <div class="group-form-control">
                <label for="numero">Número Adjudicación:</label>
                <input class="form-control" id="numero" name="numero" placeholder="Número de Adjudicación" type="text" value="{{ $p->numero_adjudicacion }}" required>
                <input type="hidden" name="numeroA" value="{{ $p->numero_adjudicacion }}">
            </div>
            <div class="group-form-control">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control">
                    @if($p->estado == 1)
                        <option value="1" selected>Activo</option>
                        <option value="0">Desactivado</option>
                    @else
                        <option value="1">Activo</option>
                        <option value="0" selected>Desactivado</option>
                    @endif
                </select>
                <input type="hidden" name="estadoA" value="{{ $p->estado }}">
            </div>    
        @endforeach
        <br>
        <div class="group-form-control">
            <button type="submit" class="btn btn-primary" name="guardar" id="guardar">MODIFICAR</button>
            <a href="{{ url('findProyecto') }}" class="btn btn-danger">CANCELAR</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('extra')
$("input").on("keypress",function(){
    $input = $(this);
  
    setTimeout(function(){
      $input.val($input.val().toUpperCase());
    },50);
});

$('#datepicker').datepicker({
    autoclose: true,
    format: "dd/mm/yyyy"
});
@endsection