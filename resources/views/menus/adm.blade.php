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
        @break
    @case(2)
        <li>
            <a href="{{ url('findUnidad') }}">
                <i class="fa fa-bank"></i>
                <span>UNIDAD EJECUTORA</span>
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
        @break
    @case(3)
        <li>
            <a href="{{ url('findSeguimiento') }}">
                <i class="fa fa-calendar"></i>
                <span>SEGUIMIENTO PROYECTOS</span>
            </a>
        </li>
        @break
        
@endswitch