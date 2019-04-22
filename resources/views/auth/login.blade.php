@extends('plantilla.master')

@section('contenido')

<div class="box box-danger login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Plan Asfalto</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión para iniciar tu sesión.</p>
    
	<form action="{{ route('login') }}" method="post">
		@csrf
		<div class="form-group has-feedback">
			<input type="email" class="form-control" placeholder="Correo Electrónico" id="email" name="email" required autofocus>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="row">
			<!-- /.col -->
			<div>
			<button type="submit" class="btn btn-primary">Iniciar sesión</button>
			</div>
			<!-- /.col -->
		</div>
    </form>
        
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection
