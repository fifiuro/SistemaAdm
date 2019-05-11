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
                <table class="table table-striped" id="unidad">
                    <tr>
                        @foreach ($unidad as $key => $u)
                        <tr>
                            <td>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="id_uni" id="id_uni" value="{{ $u->id_uni }}" class="uni">
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
                <table class="table table-striped" id="macro">
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-xs-12">
                {{-- Boton Volver --}}
                <a href="{{ url('/') }}" class="btn btn-danger">VOLVER</a>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" id="id">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
@endsection

@section('extra')

$("#unidad input[class=uni]").on("click",function(){
    $("#id").val($(this).val());
    $.ajax({
        url: 'showMacroUnidad',
        data: { 'id':$(this).val() },
        type: 'post',
        dataType: "json",
        success: function(response){
            $("#macro tbody").empty();
            $.each(response, function(index,value){
                if(value.id_uni === null){
                    $("#macro tbody").append("<tr><td><div class='checkbox'><label><input type='checkbox' name='id_mac' id='" + value.id_um + "' value='" + value.id_mac + "' class='titulo'>" + value.nombre_mac + "</label></div></td></tr>");
                }else{
                    $("#macro tbody").append("<tr><td><div class='checkbox'><label><input type='checkbox' name='id_mac' id='" + value.id_um + "' value='" + value.id_mac + "' class='titulo' checked>" + value.nombre_mac + "</label></div></td></tr>");
                }
            });
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Acciones de clic
$("#macro").on("click",".titulo",function(){
    if($(this).is(':checked')){
        $.ajax({
            url: 'storeUnidadMacro',
            data: {
                    'id_uni':$("#id").val(),
                    'id_mac':$(this).val()
                },
            type: 'post',
            success: function(response){
                if(response == true){
                    alert("Se asignó el corretamente.");
                }else{
                    alert('No se realizo la asignación.');
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
        alert($(this).attr('id'));
        $.ajax({
            url: 'destroyUnidadMacro',
            data: {
                    'id':$(this).attr('id')
                },
            type: 'post',
            success: function(response){
                if(response == true){
                    alert("Se Eliminó la asignación.");
                }else{
                    alert('No Eliminó la asignación.');
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
    }
});

@endsection