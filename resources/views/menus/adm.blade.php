@switch(Auth::user()->tipoUser(Auth::user()->id))
    @case(1)
        <li>
            <a href="{{ url('findUsuario') }}">
                <i class="fa fa-users"></i>
                <span>USUARIOS</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findGestion') }}">
                <i class="fa fa-calendar"></i>
                <span>GESTION</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findUnidad') }}">
                <i class="fa fa-bank"></i>
                <span>UNIDAD EJECUTORA</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findMacro') }}">
                <i class="fa fa-building-o"></i>
                <span>MACRO DISTRITO</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findAsignacion') }}">
                <i class="fa fa-arrows-h"></i>
                <span>ASIGNACION</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findDistrito') }}">
                <i class="fa fa-building-o"></i>
                <span>DISTRITO</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findProyecto') }}">
                <i class="fa fa-archive"></i>
                <span>PROYECTO</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findModificaciones') }}">
                <i class="fa fa-archive"></i>
                <span>REPORTE DE MODIFICACIONES</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findSeguimiento') }}">
                <i class="fa fa-eye"></i>
                <span>SEGUIMIENTO PROYECTOS</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findDetalle') }}">
                <i class="fa fa-eye"></i>
                <span>DETALLE DE PROYECTOS</span>
            </a>
        </li>
        @break
    @case(2)
        <li>
            <a href="{{ url('findSeguimiento') }}">
                <i class="fa fa-eye"></i>
                <span>SEGUIMIENTO PROYECTOS</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findDetalle') }}">
                <i class="fa fa-eye"></i>
                <span>DETALLE DE PROYECTOS</span>
            </a>
        </li>
        @break
    @case(3)
    @case(4)
    @case(5)
        <li>
            <a href="{{ url('findProyecto') }}">
                <i class="fa fa-archive"></i>
                <span>PROYECTO</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findSeguimiento') }}">
                <i class="fa fa-eye"></i>
                <span>SEGUIMIENTO PROYECTOS</span>
            </a>
        </li>
        <li>
            <a href="{{ url('findDetalle') }}">
                <i class="fa fa-eye"></i>
                <span>DETALLE DE PROYECTOS</span>
            </a>
        </li>
        @break
        
@endswitch