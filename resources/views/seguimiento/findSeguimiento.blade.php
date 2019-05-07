@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    SEGUIMIENTO DE PROYECTOS
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('findSeguimiento') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-1">
                <label for="gestion">Gestion:</label>
                <select name="gestion" id="gestion" class="form-control">
                  <option value=""></option>
                  @foreach ($gestion as $key => $g)
                    <option value="{{ $g->id_ges }}">{{ $g->gestion }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-xs-3">
                <label for="unidad">Unidad Ejecutora:</label>
                <select name="unidad" id="unidad" class="form-control">
                  <option value=""></option>
                  @foreach ($unidad as $key => $u)
                    <option value="{{ $u->id_uni }}">{{ $u->unidad_ejecutora }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-xs-3">
                <label for="macro">Macro Distrito:</label>
                <select name="macro" id="macro" class="form-control">
                </select>
            </div>
            <div class="col-xs-2">
                <label for="distrito">Distrito:</label>
                <select name="distrito" id="distrito" class="form-control">
                </select>
            </div>
            <div class="col-xs-2">
              <label for="proyecto">Proyecto:</label>
              <input class="form-control" id="proyecto" name="proyecto" placeholder="Distrito" type="text">
            </div>
          <div class="col-xs-1">
            {{-- Boton Buscar --}}
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </form>
    </div>
    @if(isset($seg))
      @if($estado)
        <div class="box-footer">
          <table class="table">
            <tbody>
              <tr>
                <th>Gestion</th>
                <th>Unidad Ejecutora</th>
                <th>Proyecto</th>
                <th>Volumen<br>Presupuestado</th>
                <th>Volumen<br>Programado</th>
                <th>Volumen Total</th>
                <th>Saldo</th>
                <th>Acciones</th>
              </tr>
              @foreach($seg as $key => $s)
              <tr>
                <td>{{ $s->gestion }}</td>
                <td>
                  {{ $s->unidad_ejecutora }} <br>
                  <strong>Macro Distrito: </strong>{{ $s->nombre_mac }} <br>
                  <strong>Distrito: </strong>{{ $s->nombre_dis }}
                </td>
                <td>{{ $s->nombre_pro }}</td>
                <td>{{ $s->presupuesto }}</td>
                <td>{{ $s->programado }}</td>
                <td>{{ $s->total }}</td>
                <td>
                  @if(($s->programado - $s->total) > 0)
                    <span style="color:green"><strong>{{ ($s->programado - $s->total) }}</strong></span>
                  @else
                    <span style="color:red"><strong>{{ ($s->programado - $s->total) }}</strong></span>
                  @endif
                </td>
                <td>
                  @switch(Auth::user()->tipoUser(Auth::user()->id))
                      @case(2)
                          {{-- Boton Supervisar --}}
                          <a href="{{ url('supervisar/'.$s->id_dist.'/0') }}" class="btn btn-primary">
                            <i class="fa fa-bar-chart"></i>
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

    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
@endsection

@section('extra')
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$("#unidad").change(function(){
  $.ajax({
      url: 'listaMacro',
      data: {'id':$("#unidad").val()},
      type: 'post',
      success: function(response){
          if(response != ''){
              $("#macro").attr('disabled',false);
              $("#macro").html(response);
          }else{
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

$("#macro").change(function(){
  $.ajax({
      url: 'listaDistrito',
      data: {'id':$("#macro").val()},
      type: 'post',
      success: function(response){
          if(response != ''){
              $("#distrito").attr('disabled',false);
              $("#distrito").html(response);
          }else{
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