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
        Unidad::create(array('unidad_ejecutora' => 'Unidad Ejecutora A',
                            'fecha_reg' => date('Y-m-d'),
                            'estado' => 1));
        Unidad::create(array('unidad_ejecutora' => 'Unidad Ejecutora B',
                            'fecha_reg' => date('Y-m-d'),
                            'estado' => 1));
        Unidad::create(array('unidad_ejecutora' => 'Unidad Ejecutora C',
                            'fecha_reg' => date('Y-m-d'),
                            'estado' => 1));
        Unidad::create(array('unidad_ejecutora' => 'Unidad Ejecutora D',
                            'fecha_reg' => date('Y-m-d'),
                            'estado' => 1));
        Unidad::create(array('unidad_ejecutora' => 'Unidad Ejecutora E',
                            'fecha_reg' => date('Y-m-d'),
                            'estado' => 1));
    }
}
