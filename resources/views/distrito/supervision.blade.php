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
<div class="box box-danger">
    <div class="box-body">
        {{-- <form class="form-horizontal" name="form" id="form" role="form" method="POST" action="{{ url('BuscarSuperProyecto') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-3">
                    <label for="gestion">Gestión:</label>
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
                <div class="col-xs-4">
                    <label for="distrito">Distrito:</label>
                    <select name="distrito" id="distrito" class="form-control">
                        <option value=""></option>
                        @foreach ($distrito as $key => $d)
                            <option value="{{ $d->id_dist }}">{{ $d->nombre_dis }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="col-xs-2">
                    {{-- Boton Buscar --}}
                    {{-- <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                    {{-- Boton Nuevo --}}
                    {{-- <a href="{{ url('createUnidad') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
            </div>
        </form> --}}

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $distrito->nombre_dis}}
                <small>Tota de proyectos {{ $numProyecto[0]->total }}</small>
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
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><strong>VOLUMENES</strong></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($volumen as $key => $v)
                                            <tr>
                                                <td>{{ formatoFechaReporte($v->fecha) }}</td>
                                                <td>{{ $v->monto }}</td>
                                            </tr>
                                        @endforeach
                                        <!-- <tr>
                                            <td><input type="checkbox"></td>
                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                                            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                            <td class="mailbox-date">15 days ago</td>
                                        </tr> -->
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
    </div>
</div>
@endsection

@section('extra')

@endsection