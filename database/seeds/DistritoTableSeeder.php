<?php

use Illuminate\Database\Seeder;
use App\Distrito;

class DistritoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distrito::create(array('id_uni' => '1',
                               'nombre_dis' => 'DISTRITO 3',
                               'numero_dis' => '3',
                               'ubicacion' => 'POR AHI',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '1',
                               'nombre_dis' => 'DISTRITO 4',
                               'numero_dis' => '4',
                               'ubicacion' => 'MUY',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '1',
                               'nombre_dis' => 'DISTRITO 5',
                               'numero_dis' => '5',
                               'ubicacion' => 'LJKA',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '1',
                               'nombre_dis' => 'DISTRITO 6',
                               'numero_dis' => '6',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '2',
                               'nombre_dis' => 'DISTRITO 7',
                               'numero_dis' => '7',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '2',
                               'nombre_dis' => 'DISTRITO 8',
                               'numero_dis' => '8',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '2',
                               'nombre_dis' => 'DISTRITO 9',
                               'numero_dis' => '9',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '2',
                               'nombre_dis' => 'DISTRITO 10',
                               'numero_dis' => '10',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '3',
                               'nombre_dis' => 'DISTRITO 11',
                               'numero_dis' => '11',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '3',
                               'nombre_dis' => 'DISTRITO 12',
                               'numero_dis' => '12',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '3',
                               'nombre_dis' => 'DISTRITO 13',
                               'numero_dis' => '13',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '4',
                               'nombre_dis' => 'DISTRITO 14',
                               'numero_dis' => '14',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '4',
                               'nombre_dis' => 'DISTRITO 15',
                               'numero_dis' => '15',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '4',
                               'nombre_dis' => 'DISTRITO 16',
                               'numero_dis' => '16',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));

        Distrito::create(array('id_uni' => '4',
                               'nombre_dis' => 'DISTRITO 17',
                               'numero_dis' => '17',
                               'ubicacion' => 'ASDAS',
                               'estado' => 1));
    }
}
