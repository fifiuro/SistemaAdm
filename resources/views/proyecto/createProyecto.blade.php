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
                <input type="hidden" name="id_ges" value="{{ $gestion[0]->gestion }}" required>
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
                    <option value=""></option>
                </select>
                <div id="resultado"></div>
            </div>
            <div class="group-form-control">
                <label for="id_dist">Distrito:</label>
                <select name="id_dist" id="id_dist" class="form-control" disabled required>
                    <option value=""></option>
                </select>
            </div>
            <div class="group-form-control">
                <label for="nombre_pro">Nombre del Proyecto:</label>
                <input class="form-control" id="nombre_pro" name="nombre_pro" placeholder="Nombre del Proyecto" type="text" disabled required>
            </div>
            <div class="group-form-control">
                <label for="ema">Codigo EMA:</label>
                <input class="form-control" id="ema" name="ema" placeholder="Codigo EMA" type="text" disabled required>
            </div>
            <div class="group-form-control">
                <label for="presupuesto">Volumen Presupuestario:</label>
                <input class="form-control" id="presupuesto" name="presupuesto" placeholder="Presupuesto" type="text" disabled required>
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
            }else{
                $("#id_mac").empty();
                $("#id_mac").attr('disabled',true);
            }
        },
        statusCode: {
            404: function*(){
                alert('No se encontro la WEB');
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
        url: 'listaDistrito',
        data: {'id':$("#id_mac").val()},
        type: 'post',
        success: function(response){
            if(response != ''){
                $("#id_dist").attr('disabled',false);
                $("#id_dist").html(response);
            }else{
                $("#id_dist").empty();
                $("#id_dist").attr('disabled',true);
            }
        },
        statusCode: {
            404: function*(){
                alert('No se encontro la WEB');
            }
        },
        error: function(x,xs,xt){
            // nos dara el errore si es que hay alguno
            window.open(JSON.stringify(x));
            // alert('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
});

$("#id_dist").change(function(){
    if($("#id_dist").val() != '' && $("#id_mac").val() != '' && $("#id_uni").val() != ''){
        $("#nombre_pro").attr('disabled',false);
        $("#ema").attr('disabled',false);
        $("#presupuesto").attr('disabled',false);
    }
});
@endsection