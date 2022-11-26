<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;



class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            'name' => 'Laravel para iniciantes',
            'descrisimp' => 'Aprenda o básico do framework Laravel',
            'descricomp' => 'Aprenda como instalar o Laravel e como usar migrations,models,controllers e muito mais!',
            'minalu' => 1,
            'maxalu' => 3,
            'imagem' => '/images/cursoavatar/laravellogo.png',
            'status' => 0
        ]);
        
        DB::table('cursos')->insert([
            'name' => 'Html básico',
            'descrisimp' => 'Aprenda o básico de HTML',
            'descricomp' => 'Aprenda a usar o html, adicionando imagens, hyperlink e muito mais!',
            'minalu' => 0,
            'maxalu' => 20,
            'imagem' => '/images/cursoavatar/frontlogo.png',
            'status' => 1
        ]);

        DB::table('cursos')->insert([
            'name' => 'MySql básico',
            'descrisimp' => 'Aprenda o básico de MySql',
            'descricomp' => 'Aprenda como usar insert,select,where, entre muitos outros!',
            'minalu' => 3,
            'maxalu' => 20,
            'imagem' => '/images/cursoavatar/datalogo.png',
            'status' => 0
        ]);


    }
}
