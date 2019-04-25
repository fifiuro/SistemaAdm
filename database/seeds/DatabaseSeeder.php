<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        //$this->call(GestionTableSeeder::class);
        //$this->call(UnidadTableSeeder::class);
        //$this->call(DistritoTableSeeder::class);
        //$this->call(ProyectoTableSeeder::class);

        Model::reguard();
        
    }
}
