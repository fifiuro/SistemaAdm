<?php

use Illuminate\Database\Seeder;
use App\Unidad;

class UnidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidad::create(array('unidad_ejecutora' => 'MACRO DISTRITO COTAHUMA',
                             'fecha_reg' => date('Y-m-d'),
                             'estado' => 1));

        Unidad::create(array('unidad_ejecutora' => 'MACRO DISTRITO MAX PAREDES',
                             'fecha_reg' => date('Y-m-d'),
                             'estado' => 1));

        Unidad::create(array('unidad_ejecutora' => 'MACRO DISTRITO PERIFERICA',
                             'fecha_reg' => date('Y-m-d'),
                             'estado' => 1));

        Unidad::create(array('unidad_ejecutora' => 'MACRO DSITRITO SAN ANTONIO',
                             'fecha_reg' => date('Y-m-d'),
                             'estado' => 1));
    }
}
