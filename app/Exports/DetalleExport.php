<?php

namespace App\Exports;

use App\Proyecto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DetalleExport implements FromView
{
    public function view(): View
    {
        $proy = Proyecto::all();

        return view('seguimiento.detalleProyecto', ['proyecto' => $proy]);
    }
}

/*namespace App\Exports;

use App\Proyecto;
use Maatwebsite\Excel\Concerns\FromCollection;

class DetalleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Proyecto::all();
    }
}*/
