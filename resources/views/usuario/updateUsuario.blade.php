@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    MODIFICAR USUARIO
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')

<div class="box box-danger">
    <div class="box-body">
        <form method="POST" action="{{ url('updateUsuario') }}">
            @csrf
            <div class="group-from-control">
                <label for="name">Nombre Completo: </label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $usuario->name }}" required autocomplete="name" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <input type="hidden" name="id" value="{{ $usuario->id }}">
            </div>
            <div class="group-from-control">
                <label for="cargo">Cargo: </label>
                <input id="cargo" type="text" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" name="cargo" value="{{ $usuario->cargo }}" required autocomplete="cargo" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="group-from-control">
                <label for="unidad">Unidad: </label>
                <input id="unidad" type="text" class="form-control{{ $errors->has('unidad') ? ' is-invalid' : '' }}" name="unidad" value="{{ $usuario->unidad }}" required autocomplete="unidad" autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="group-from-control">
                <label for="email">Correo electrónico: </label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuario->email }}" required autocomplete="email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="group-from-control">
                <label for="tipo">Tipo Usuario: </label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value=""></option>
                    @if ($usuario->tipo == 1)
                        <option value="1" selected>Administrador</option>
                        <option value="2">Gerencia General</option>
                        <option value="3">Director de Obra</option>
                        <option value="4">Jefe de Asfalto y Bacheos</option>
                        <option value="5">Jefe de Producción</option>
                    @elseif($usuario->tipo == 2)
                        <option value="1">Administrador</option>
                        <option value="2" selected>Gerencia General</option>
                        <option value="3">Director de Obra</option>
                        <option value="4">Jefe de Asfalto y Bacheos</option>
                        <option value="5">Jefe de Producción</option>
                    @elseif($usuario->tipo == 3)
                        <option value="1">Administrador</option>
                        <option value="2">Gerencia General</option>
                        <option value="3" selected>Director de Obra</option>
                        <option value="4">Jefe de Asfalto y Bacheos</option>
                        <option value="5">Jefe de Producción</option>
                    @elseif($usuario->tipo == 4)
                        <option value="1">Administrador</option>
                        <option value="2">Gerencia General</option>
                        <option value="3">Director de Obra</option>
                        <option value="4" selected>Jefe de Asfalto y Bacheos</option>
                        <option value="5">Jefe de Producción</option>
                    @elseif($usuario->tipo == 5)
                        <option value="1">Administrador</option>
                        <option value="2">Gerencia General</option>
                        <option value="3">Director de Obra</option>
                        <option value="4">Jefe de Asfalto y Bacheos</option>
                        <option value="5" selected>Jefe de Producción</option>
                    @else
                        <option value="1">Administrador</option>
                        <option value="2">Gerencia General</option>
                        <option value="3">Director de Obra</option>
                        <option value="4">Jefe de Asfalto y Bacheos</option>
                        <option value="5">Jefe de Producción</option>
                    @endif
                </select>
            </div>
            <div class="group-from-control">
                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña: </label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="new-password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="group-from-control">
                <label for="estado" class="col-md-4 col-form-label text-md-right">Estado: </label>
                <select name="estado" id="estado" class="form-control">
                    @if ($usuario->estado == 1)
                        <option value="1" selected>Activo</option>
                        <option value="0">Desactivado</option>
                    @else
                        <option value="1">Activo</option>
                        <option value="0" selected>Desactivado</option>
                    @endif
                </select>
            </div>
            <hr>
            <div class="group-from-control">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">MODIFICAR</button>
                    <a href="{{ url('findUsuario') }}" class="btn btn-danger">CANCELAR</a>
                </div>
            </div>
        </form>     
    </div>
</div>

@endsection

@section('extra')

@endsection
