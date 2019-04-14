<li class="treeview">
    <a href="#">
        <i class="fa fa-gears"></i>
        <span>Sistema</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="{{ url('findGestion') }}">
                <i class="fa fa-circle-o"></i> Gestión</a>
        </li>
        <li>
            <a href="{{ url('findUnidad') }}">
                <i class="fa fa-circle-o"></i> Unidad Ejecutora</a>
        </li>
        <li>
            <a href="{{ url('findDistrito') }}">
                <i class="fa fa-circle-o"></i> Distrito</a>
        </li>
        <li>
            <a href="{{ url('findProyecto') }}">
                <i class="fa fa-circle-o"></i> Proyecto</a>
        </li>
        <li>
            <a href="{{ url('findVolumenes') }}">
                <i class="fa fa-circle-o"></i> Volúmenes</a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-institution"></i>
        <span>COGNOS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="{{ url('findPersonal') }}">
                <i class="fa fa-circle-o"></i> Personal Cognos</a>
        </li>
        <li>
            <a href="{{ url('findInstructor') }}">
                <i class="fa fa-circle-o"></i> Instructores</a>
        </li>
        <li>
            <a href="{{ url('findCurso') }}">
                <i class="fa fa-circle-o"></i> Cursos</a>
        </li>
        <li>
            <a href="{{ url('findEmpresa') }}">
                <i class="fa fa-circle-o"></i> Empresas</a>
        </li>
    </ul>
</li>

<li>
    <a href="{{ url('findCronograma') }}">
        <i class="fa fa-calendar"></i>
        <span>CRONOGRAMA</span>
    </a>
</li>
<li>
    <a href="{{ url('findInscripcion') }}">
        <i class="fa fa-child"></i>
        <span>INSCRIPCIONES</span>
    </a>
</li>