<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $u = new User;
        $u->name = 'hola';
        $u->email = 'hola@gmail.com';
        $u->password = Hash::make('12345678');
        $u->cargo = 'asd';
        $u->unidad = 'asd';
        $u->estado = 1;
        $u->save();
    }
}
