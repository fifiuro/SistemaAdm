@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    NUEVA PROYECTO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')

<div class="box box-danger">
    <div class="box-body">
        <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('storeProyecto') }}">
            {{ csrf_field() }}
            <div class="group-form-control">
                <label for="gestion">Gestión:</label>
                <input class="form-control" id="gestion" name="gestion" placeholder="Nombre del Proyecto" type="text" value="{{ $gestion[0]->gestion }}" disabled>
                <input type="hidden" name="id_ges" value="{{ $gestion[0]->id_ges }}" required>
            </div>
            <div class="group-form-control">
                <label for="id_uni">Unidad Ejecutora:</label>
                <select name="id_uni" id="id_uni" class="form-control" required>
                    <option value=""></option>
                    @foreach ($unidad as $key => $u)
                        <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                    @endforeach
                </select>
            </div>
            <div class="group-form-control">
                <label for="id_mac">Macro Distrito:</label>
                <select name="id_mac" id="id_mac" class="form-control" disabled required>
                </select>
                <div id="resultado"></div>
            </div>
            <div class="group-form-control">
                <label for="id_dist">Distrito:</label>
                <select name="id_dist" id="id_dist" class="form-control" disabled required>
                </select>
            </div>
            <div class="group-form-control">
                <label for="ubicacion">Nombre del Proyecto:</label>
                <input class="form-control" id="ubicacion" name="ubicacion" placeholder="Nombre del Proyecto" type="text" disabled required>
            </div>
            <div class="row">
                <div class="group-form-control col-md-6">
                    <label for="tipoEma">Tipo EMA:</label>
                    <select name="tipoEma" id="tipoEma" class="form-control" disabled required>
                        <option>EMA</option>
                        <option>EMA Externo</option>
                    </select>
                </div>
                <div class="group-form-control col-md-6">
                    <label for="ema">Codigo EMA:</label>
                    <input class="form-control" id="ema" name="ema" placeholder="Codigo EMA" type="text" disabled required>
                </div>
            </div>
            <div class="group-form-control">
                <label for="presupuesto">Monto de Contrato:</label>
                <div class="input-group">
                    <input class="form-control" id="presupuesto" name="presupuesto" placeholder="Monto de Contrato" type="text" disabled>
                    <div class="input-group-addon">
                        <strong>Bs.</strong>
                    </div>
                </div>
            </div>
            <div class="group-form-control">
                <label for="programado">Volumen Proyectado:</label>
                <input class="form-control" id="programado" name="programado" placeholder="Volumen Programado" type="text" disabled required>
            </div>
            <div class="row">
                <div class="group-form-control col-md-6">
                    <label for="adjudicado">Contrato:</label>
                    <input class="form-control" id="adjudicado" name="adjudicado" placeholder="Contrato" type="text" disabled required>
                </div>
                <div class="group-form-control col-md-6">
                    <label for="fechaContrato">Fecha:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="fechaContrato" class="form-control pull-right" id="fechaContrato" disabled required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="group-form-control col-md-6">
                    <label for="fecha">Fecha de Orden de Proceder:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="fecha" class="form-control pull-right" id="datepicker" disabled required>
                    </div>
                </div>
                <div class="group-form-control col-md-6">
                    <label for="plazo">Plazo:</label>
                    <input type="text" name="plazo" class="form-control" id="plazo" disabled required>
                </div>
            </div>
            <hr>
            <div class="group-form-control">
                <button type="submit" class="btn btn-primary" name="guardar" id="guardar">GUARDAR</button>
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

$('#fechaContrato').datepicker({
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
        url: 'listaMacro',
        data: {'id':$("#id_uni").val()},
        type: 'post',
        success: function(response){
            if(response != ''){
                $("#id_mac").attr('disabled',false);
                $("#id_mac").html(response);

                $("#id_dist").empty();
                $("#id_dist").attr('disabled',true);

                $("#nombre_pro").attr('disabled',true);
                $("#ema").attr('disabled',true);
                $("#presupuesto").attr('disabled',true);

                $("#nombre_pro").val('');
                $("#ema").val('');
                $("#presupuesto").val('');
            }else{
                $("#id_mac").empty();
                $("#id_mac").attr('disabled',true);

                $("#id_dist").empty();
                $("#id_dist").attr('disabled',true);

                $("#nombre_pro").attr('disabled',true);
                $("#ema").attr('disabled',true);
                $("#presupuesto").attr('disabled',true);

                $("#nombre_pro").val('');
                $("#ema").val('');
                $("#presupuesto").val('');

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
    if($("#id_mac").val() != 0){
        $.ajax({
            url: 'listaDistrito',
            data: {'id':$("#id_mac").val()},
            type: 'post',
            success: function(response){
                if(response != ''){
                    $("#id_dist").attr('disabled',false);
                    $("#id_dist").html(response);
    
                    $("#nombre_pro").attr('disabled',true);
                    $("#ema").attr('disabled',true);
                    $("#presupuesto").attr('disabled',true);
    
                    $("#nombre_pro").val('');
                    $("#ema").val('');
                    $("#presupuesto").val('');
                }else{
                    $("#id_dist").empty();
                    $("#id_dist").attr('disabled',true);
    
                    $("#nombre_pro").attr('disabled',true);
                    $("#ema").attr('disabled',true);
                    $("#presupuesto").attr('disabled',true);
    
                    $("#nombre_pro").val('');
                    $("#ema").val('');
                    $("#presupuesto").val('');
    
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
    }else{
        $("#nombre_pro").attr('disabled',false);
        $("#ubicacion").attr('disabled',false);
        $("#ema").attr('disabled',false);
        $("#presupuesto").attr('disabled',false);
        $("#programado").attr('disabled',false);
        $("#adjudicado").attr('disabled',false);
        $("#datepicker").attr('disabled',false);
        $("#fechaContrato").attr('disabled',false);
        $("#numero").attr('disabled',false);
        $("#tipoEma").attr('disabled',false);
        $("#plazo").attr('disabled',false);
    }
});

$("#id_dist").change(function(){
    if($("#id_dist").val() != '' && $("#id_mac").val() != '' && $("#id_uni").val() != ''){
        $("#nombre_pro").attr('disabled',false);
        $("#ubicacion").attr('disabled',false);
        $("#ema").attr('disabled',false);
        $("#presupuesto").attr('disabled',false);
        $("#programado").attr('disabled',false);
        $("#adjudicado").attr('disabled',false);
        $("#datepicker").attr('disabled',false);
        $("#fechaContrato").attr('disabled',false);
        $("#numero").attr('disabled',false);
        $("#tipoEma").attr('disabled',false);
        $("#plazo").attr('disabled',false);
    }else{
        $("#nombre_pro").attr('disabled',true);
        $("#ubicacion").attr('disabled',true);
        $("#ema").attr('disabled',true);
        $("#presupuesto").attr('disabled',true);
        $("#programado").attr('disabled',true);
        $("#adjudicado").attr('disabled',true);
        $("#datepicker").attr('disabled',true);
        $("#fechaContrato").attr('disabled',true);
        $("#numero").attr('disabled',true);
        $("#tipoEma").attr('disabled',true);
        $("#plazo").attr('disabled',true);
    }
});
@endsection