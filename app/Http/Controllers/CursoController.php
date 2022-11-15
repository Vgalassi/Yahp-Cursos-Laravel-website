<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;


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


    public function join($id){
        $user = Auth::user();

        $user->cursos()->attach($id);

        $curso = curso::findOrfail($id);

        return redirect ('/home')->with('msg','Matriculado com sucesso em' . $curso->name);
    }
}
