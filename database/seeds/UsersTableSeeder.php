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

        User::create(array( 'name' => 'Gerente',
                            'email' => 'gerente@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Gerente',
                            'unidad' => 'Gerencial',
                            'estado' => '1',
                            'tipo' => '2'));

        User::create(array( 'name' => 'Director de Obra',
                            'email' => 'directorobra@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Director',
                            'unidad' => 'Director',
                            'estado' => '1',
                            'tipo' => '3'));

        User::create(array( 'name' => 'Jefe de Asfalto y Bacheos',
                            'email' => 'Jefeasfaltobacheos@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Jefe',
                            'unidad' => 'Jefe',
                            'estado' => '1',
                            'tipo' => '4'));

        User::create(array( 'name' => 'Jefe de Producción',
                            'email' => 'jefeproduccion@gmail.com',
                            'password' => Hash::make('12345678'),
                            'cargo' => 'Produccion',
                            'unidad' => 'Produccion',
                            'estado' => '1',
                            'tipo' => '5'));
    }
}
