<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('../assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <title>Document</title>
</head>
<body style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
    <div style="text-align:center">
        <h3> CRONOGRAMA PLAN ASFALTO </h3>
    </div>
    <table style="width:100%; font-size:12px">
    @foreach ($proy as $key => $g)
        <tr>
            <td><strong>Gestion:</strong> </td>
            <td>{{ $g->gestion }}</td>
            <td><strong>Unidad Ejecutora:</strong> </td>
            <td colspan="2">{{ $g->unidad_ejecutora }}</td>
        </tr>
        <tr>
            <td><strong>Nombre Distrito:</strong> </td>
            <td>{{ $g->nombre_dis }}</td>
            <td><strong>Numero Distrito:</strong> </td>
            <td>{{ $g->numero_dis }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Nombre Proyecto:</strong> </td>
            <td colspan="3">{{ $g->nombre_pro }}</td>
        </tr>
        <tr>
            <td><strong>Código EMA:</strong> </td>
            <td>{{ $g->ema }}</td>
            <td><strong>Volumen Presupuestado:</strong> </td>
            <td>{{ formatoDecimal($g->presupuesto) }}</td>
            <td><strong>Volumen Programado:</strong> </td>
            <td>{{ formatoDecimal($g->programado) }}</td>
        </tr>
    @endforeach
    </table>
    <br>
    <table style="width:100%; font-size:12px" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="border:1px #000000 solid; padding:5px; text-align:center"><strong>FECHA</strong></td>
            <td style="border:1px #000000 solid; padding:5px; text-align:center"><strong>VOLUMEN</strong></td>
        </tr>
        @foreach ($volumen as $key => $v)
            <tr>
                <td style="border:1px #000000 solid; padding:3px">{{ formatoFechaReporte($v->fecha) }}</td>
                <td style="border:1px #000000 solid; padding:3px">{{ formatoDecimal($v->monto) }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="border:1px #000000 solid; padding:3px; text-align:right;"><strong>Total Volumen: </strong></td>
            <td style="border:1px #000000 solid; padding:3px">{{ formatoDecimal($sumatoria) }}</td>
        </tr>
        <tr>
            <td style="border:1px #000000 solid; padding:3px; text-align:right;"><strong>Saldo: </strong></td>
            <td style="border:1px #000000 solid; padding:3px">{{ formatoDecimal($proy[0]->programado - $sumatoria) }}</td>
        </tr>
    </table>

</body>
</html>