<?php

use Illuminate\Database\Seeder;
use App\Gestion;

class GestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gestion::create(array('gestion' => '2015',
                              'estado' => 0));

        Gestion::create(array('gestion' => '2016',
                              'estado' => 0));
        
        Gestion::create(array('gestion' => '2016',
                              'estado' => 0));

        Gestion::create(array('gestion' => '2017',
                              'estado' => 0));

        Gestion::create(array('gestion' => '2018',
                              'estado' => 0));

        Gestion::create(array('gestion' => '2019',
                              'estado' => 1));

    }
}
