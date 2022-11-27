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
            'name' => 'SuperAdmin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminadmin'),
            'perm' => 3,
            'CPF' => '0',
            'endereco' => 'Yahp',
            'num' => '0',
            'filme' => 'N/A',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'Secretaria',
            'email' => 'Yahp@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 2,
            'CPF' => '0',
            'endereco' => 'Yahp',
            'num' => '0',
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
            'num' => '0',
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
            'num' => '0',
            'filme' => 'Taxi Driver',
        ]);

        DB::table('users')->insert([
            'name' => 'Leonardo Nijimura',
            'username' => 'Leonardo',
            'email' => 'leonardo@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 0,
            'CPF' => '0',
            'endereco' => '0',
            'num' => '0',
            'filme' => 'American Psycho',
        ]);

        DB::table('users')->insert([
            'name' => 'Pedro Hirose',
            'username' => 'Perdro',
            'email' => 'Pedro@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 0,
            'CPF' => '0',
            'endereco' => '0',
            'num' => '0',
            'filme' => 'Clube da Luta',
        ]);

        DB::table('users')->insert([
            'name' => 'Felipe Ghirga',
            'username' => 'Felipe',
            'email' => 'felipe@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 0,
            'CPF' => '0',
            'endereco' => '0',
            'num' => '0',
            'filme' => 'Até o Último Homem',
        ]);

        DB::table('users')->insert([
            'name' => 'Amanda Costello',
            'username' => 'Amanda',
            'email' => 'amanda@gmail.com',
            'password' => Hash::make('12345678'),
            'perm' => 0,
            'CPF' => '0',
            'endereco' => '0',
            'num' => '0',
            'filme' => 'Blade Runner 2049',
        ]);

        DB::table('users')->insert([
            'name' => 'Valdomiro Pannain',
            'username' => 'Miro',
            'email' => 'N/A',
            'password' => Hash::make('12345678'),
            'perm' => 1,
            'CPF' => '0',
            'endereco' => '0',
            'filme' => 'N/A',
            'num' => '0',
            'imagem' => '/images/profavatar/atumalaca.jpg',
        ]);

        DB::table('users')->insert([
            'name' => 'Ricardo Engelbrecht',
            'username' => 'Ricardo',
            'email' => 'N/A',
            'password' => Hash::make('12345678'),
            'perm' => 1,
            'CPF' => '0',
            'endereco' => '0',
            'num' => '0',
            'filme' => 'N/A',
            'imagem' => '/images/profavatar/atumalaca.jpg',
        ]);

        
    }

}
