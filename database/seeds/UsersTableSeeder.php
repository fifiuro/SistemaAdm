<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array( 'name' => 'Administrador',
                            'email' => 'administrador@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Administrador',
                            'unidad' => 'Sistema',
                            'estado' => '1',
                            'tipo' => '1'));
        
        User::create(array( 'name' => 'Estandar',
                            'email' => 'estandar@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Normal',
                            'unidad' => 'Normal',
                            'estado' => '1',
                            'tipo' => '2'));

        User::create(array( 'name' => 'Gerente',
                            'email' => 'gerente@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Gerente',
                            'unidad' => 'Gerencial',
                            'estado' => '1',
                            'tipo' => '3'));
    }
}
