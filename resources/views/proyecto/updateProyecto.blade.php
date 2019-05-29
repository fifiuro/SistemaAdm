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
                        <input type="hidden" name="id_pro" value="{{ $p->id_pro }}">
                    @endif
                @endforeach
            </div>
            <div class="group-form-control">
                <label for="id_uni">Unidad Ejecutora:</label>
                <select name="id_uni" id="id_uni" class="form-control" required>
                    <option value=""></option>
                    @foreach ($unidad as $key => $u)
                        @if($u->id_uni == $p->id_uni)
                            <option value="{{ $u->id_uni }}" selected>{{ $u->unidad_ejecutora }}</option>
                        @else
                            <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="hidden" name="id_uniA" value="{{ $p->id_uni }}">
            </div>
            <div class="group-form-control">
                <label for="id_mac">Macro Distrito:</label>
                <select name="id_mac" id="id_mac" class="form-control" required>
                    <option></option>
                    @foreach ($macro as $key => $m)
                        @if($m->id_mac == $p->id_mac)
                            <option value="{{ $m->id_mac }}" selected>{{ $m->nombre_mac }}</option>
                        @else
                            <option value="{{ $m->id_mac }}">{{ $m->nombre_mac }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="hidden" name="id_macA" value="{{ $p->id_mac }}">
            </div>
            <div class="group-form-control">
                <label for="id_dist">Distrito:</label>
                <select name="id_dist" id="id_dist" class="form-control" required>
                    <option value=""></option>
                    @foreach ($distrito as $key => $d)
                        @if($d->id_dist == $p->id_dist)
                            <option value="{{ $d->id_dist }}" selected>{{ $d->nombre_dis }}</option>
                        @else
                            <option value="{{ $d->id_dist }}">{{ $d->nombre_dis }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="hidden" name="id_distA" value="{{ $p->id_dist }}">
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
                <label for="adjudicado">Documento de Adijudicacion:</label>
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
      <meta name="csrf-token" content="{{ csrf_token() }}">
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#id_uni").change(function(){
    $.ajax({
        url: '{{ url("listaMacro") }}',
        data: {'id':$("#id_uni").val()},
        type: 'post',
        success: function(response){
            if(response != ''){
                $("#id_mac").attr('disabled',false);
                $("#id_mac").html(response);

                $("#id_dist").empty();
                $("#id_dist").attr('disabled',true);
            }else{
                $("#id_mac").empty();
                $("#id_mac").attr('disabled',true);

                $("#id_dist").empty();
                $("#id_dist").attr('disabled',true);

                alert('No se tuvieron resultados.');
            }
        },
        statusCode: {
            404: function*(){
                alert('No se pudo conectar con el Servidor.');
            }
        },
        error: function(x,xs,xt){
            // nos dara el errore si es que hay alguno
            window.open(JSON.stringify(x));
            // alert('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
});

$("#id_mac").change(function(){
    $.ajax({
        url: '{{ url("listaDistrito") }}',
        data: {'id':$("#id_mac").val()},
        type: 'post',
        success: function(response){
            if(response != ''){
                $("#id_dist").attr('disabled',false);
                $("#id_dist").html(response);
            }else{
                $("#id_dist").empty();
                $("#id_dist").attr('disabled',true);

                alert('No se tuvieron resultados.');
            }
        },
        statusCode: {
            404: function*(){
                alert('No se pudo conectar con el Servidor.');
            }
        },
        error: function(x,xs,xt){
            // nos dara el errore si es que hay alguno
            window.open(JSON.stringify(x));
            // alert('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
});
@endsection