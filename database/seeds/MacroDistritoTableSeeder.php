<?php

use Illuminate\Database\Seeder;
use App\Macro;

class MacroDistritoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Macro::create(array('nombre_mac' => 'COTAHUMA',
                            'numero_mac' => 1,
                            'estado' => 1));

        Macro::create(array('nombre_mac' => 'MAX PAREDES',
                            'numero_mac' => 2,
                            'estado' => 1));

        Macro::create(array('nombre_mac' => 'PERIFERICA',
                            'numero_mac' => 3,
                            'estado' => 1));
    }
}
