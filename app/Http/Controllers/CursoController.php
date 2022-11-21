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
        $user = Auth::user();
        $usuarioentrou = false;

        if($user){
            $cursosusuario = $user->cursos->toArray();
            foreach ($cursosusuario as $cursousuario){
                if($cursousuario['id'] == $id){
                    $usuarioentrou = true;
                } 
            }
        }
        
        return view('cursos.show',['curso' => $curso,'usuarioentrou' => $usuarioentrou]);
    }


    public function join($id){
        $user = Auth::user();

        $cursosusuario = $user->cursos->toArray();
        foreach ($cursosusuario as $cursousuario){
            if($cursousuario['id'] == $id){
                return redirect ('/cursos');
            } 
        }
        $user->cursos()->attach($id);

        $curso = curso::findOrfail($id);

        return redirect ('/home')->with('status','Matriculado com sucesso em: ' . $curso->name);
    }

    public function leave($id){
        $user = Auth::user();

        $user->cursos()->detach($id);
        $curso = curso::findOrfail($id);

        return redirect ('/home')->with('status','Você se desmatriculou de: ' . $curso->name);
    }
}
