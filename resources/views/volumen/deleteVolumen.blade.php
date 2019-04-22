@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    ELIMINAR VOLUMEN
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
    
<div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('destroyVolumen') }}">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="text-center">
                <h2>Estas seguro de eliminar el Volumen?</h2>
                <input type="hidden" class="form-control" id="id_mon" name="id_mon" value="{{$id}}">
                <input type="hidden" class="form-control" id="id_pro" name="id_pro" value="{{$id_pro}}">
            </div>
        </div>   
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="si" id="si">SI</button>
               <a href="{{ url('findVolumen/'.$id_pro) }}" class="btn btn-danger">NO</a>
        </div>
      </form>
    </div>
  </div>

@endsection

@section('extra')

@endsection