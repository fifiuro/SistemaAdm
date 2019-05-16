<table>
    <thead>
        <tr>
            <td>NOMBRE PROYECTO</td>
            <td>UBICACION</td>
            <td>EMA</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyecto as $key => $p)
            <tr>
                <td>{{ $p->nombre_pro }}</td>
                <td>{{ $p->ubicacion }}</td>
                <td>{{ $p->ema }}</td>
            </tr>
        @endforeach
    </tbody>
</table>