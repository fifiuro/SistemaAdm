@extends('plantilla.master')

@section('menu')
    @include('menus.adm')
@endsection

@section('tituloPag')
    SUPERVISION DE PROYECTOS
@endsection

@section('subtituloPag')
    
@endsection

@section('contenido')
@if ($estado)
    <div class="box box-danger">
        <div class="box-body">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    {{ $distrito->nombre_dis}}
                    <small>Total de proyectos {{ $numProyecto[0]->total }}</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>Proyectos</strong></h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($proyecto as $key => $p)
                                        @if ($id_pro == $p->id_pro)
                                            <li class="active"><a href="{{ url('supervisar/'.$distrito->id_dist.'/'.$p->id_pro) }}"><i class="fa fa-archive"></i> {{ $p->nombre_pro }}</a></li>
                                        @else
                                            <li><a href="{{ url('supervisar/'.$distrito->id_dist.'/'.$p->id_pro) }}"><i class="fa fa-archive"></i> {{ $p->nombre_pro }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /. box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <strong>VOLUMENES</strong>
                                    {{-- Boton imprmir --}}
                                    <a href="{{ url('reporteProyecto/'.$id_pro) }}" target="_blank" class="btn btn-success">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            @foreach ($volumen as $key => $v)
                                                <tr>
                                                    <td colspan="2">{{ formatoFechaReporte($v->fecha) }}</td>
                                                    <td colspan="2" style="text-align: center">{{ $v->monto }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong>Área: </strong>{{ $area }}</td>
                                                <td><strong>Volumen: </strong>{{ $vol }}</td>
                                                <td><strong>Presupuesto: </strong>{{ $presupuesto }}</td>
                                                <td><strong>Sumatoria: </strong>{{ $sumatoria }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /. box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
            <div class="group-form-control">
                @if (Auth::user()->tipoUser(Auth::user()->id) == 3)
                    <a href="{{ url('findSeguimiento') }}" class="btn btn-danger">VOLVER</a>
                @else
                    <a href="{{ url('findDistrito') }}" class="btn btn-danger">VOLVER</a>
                @endif
            </div>
        </div>
    </div>
@else
    <h3 style="color:green; text-align:center;">NO SE TIENE PROYECTOS EN ESTE DISTRITO</h3>
    <div class="group-form-control">
        <a href="{{ url('findDistrito') }}" class="btn btn-danger">VOLVER</a>
    </div>
@endif
@endsection

@section('extra')

@endsection