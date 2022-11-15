<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index(){


        $search = request('search');

        if($search){
            $cursos = Curso::where([
                ['name','like','%'.$search.'%']
            ])->get();

        }else{
        $cursos = Curso::all();
        }
        return view('cursos.index',['cursos' => $cursos,'search' => $search]);
    }

    public function show($id){
        $curso = curso::findOrfail($id);
        return view('cursos.show',['curso' => $curso]);
    }
}
