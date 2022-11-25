<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'Secretaria',
            'email' => 'Yahp@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 2,
            'CPF' => '0',
            'endereco' => 'Yahp',
            'filme' => 'N/A',
        ]);

        DB::table('users')->insert([
            'name' => 'Leandro Xastre',
            'username' => 'Xastre',
            'email' => 'N/A',
            'password' => Hash::make('12345678'),
            'perm' => 1,
            'CPF' => '0',
            'endereco' => '0',
            'filme' => 'N/A',
            'imagem' => '/images/profavatar/atumalaca.jpg',
        ]);

        DB::table('users')->insert([
            'name' => 'Gabriel Yoshikage',
            'username' => 'Gabriel',
            'email' => 'gabriel@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 0,
            'CPF' => '0',
            'endereco' => '0',
            'filme' => 'Taxi Driver',
        ]);
    }

}
