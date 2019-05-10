@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    ASIGNAR UNIDAD EJECUTORA - MACRO DISTRITO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
        <div class="row">
            <div class="col-xs-6">
                <label class="titulo" for="unidad">UNIDAD EJECUTORA</label>
                <table class="table table-striped">
                    <tr>
                        @foreach ($unidad as $key => $u)
                        <tr>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="id_uni" id="id_uni" value="{{ $u->id_uni }}" class="minimal">
                                        {{ $u->unidad_ejecutora }}
                                    </label>
                                </div>
                            </td>
                        </tr>
                         @endforeach
                    </tr>
                </table>
            </div>
            <div class="col-xs-6">
                <label for="macro">MACRO DISTRITO:</label>
                <table class="table table-striped" id="todo">
                    <tr>
                        @foreach ($macro as $key => $m)
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="id_dist" id="id_dist" value="{{ $m->id_mac }}" class="titulo">
                                        {{ $m->nombre_mac }}
                                    </label>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                    </tr>
                </table>
            </div>
            <div class="col-xs-12">
                {{-- Boton Volver --}}
                <a href="{{ url('/') }}" class="btn btn-danger">VOLVER</a>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
@endsection

@section('extra')

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Acciones de clic
$("#todo input[class=titulo]").on("click",function(){
    if($(this).is(':checked')){
        alert('seleccionado:' + $(this).val());
        $.ajax({
            url: 'storeUnidadMacro',
            data: {
                    'id_uni':$("#id_uni").val(),
                    'id_mac':$(this).val()
                },
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
    }else{
        alert('No seleccionado');
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

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
@endsection