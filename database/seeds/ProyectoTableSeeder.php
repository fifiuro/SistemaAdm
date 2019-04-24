<?php

use Illuminate\Database\Seeder;
use App\Proyecto;

class ProyectoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proyecto::create(array('id_dist' => '1',
                               'nombre_pro' => 'PROYECTO MEJORANDO NUESTRA VIDA EN SANTA CRUZ “SALUD INFANTIL Y NUTRICIÓN EN BOLIVIA”',
                               'ema' => '50',
                               'presupuesto' => '13000',
                               'fecha_reg' => date('Y-m-d'),
                               'estado' => 1));
    }
}
