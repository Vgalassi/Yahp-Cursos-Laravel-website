<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\User;
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
        
        $professor = User::find($curso->user_id);
        return view('cursos.show',['curso' => $curso,'usuarioentrou' => $usuarioentrou,'user' => $user,'professor'=>$professor]);
    }


    public function join($id){
        $admin = Auth::user();

        if($admin->perm != 0 && $admin->perm != 3){
            return redirect ('/cursos');
        }

        $curso = curso::findOrfail($id);
        if($curso->status == 2 || $curso->status == 3){
            return back();
        }

        $user = Auth::user();

        $cursosusuario = $user->cursos->toArray();
        foreach ($cursosusuario as $cursousuario){
            if($cursousuario['id'] == $id){
                return redirect ('/cursos');
            } 
        }
        $user->cursos()->attach($id);

        $curso = curso::findOrfail($id);
        
        $alunos = User::where('perm', '=', 0)->Orwhere('perm', '=', 3)->get();
        $count = 0;
        foreach($alunos as $aluno){
            foreach($aluno->cursos as $cursoalu){
                if($cursoalu->id == $curso->id){
                    $count = $count + 1;
                }
            }
        }
    
        $curso = Curso::findOrfail($id);
    
        if($curso->status != 3){
        if($count < $curso->minalu ){
         $curso->status = 0;
        }
        elseif($count >= $curso->maxalu){
            $curso->status = 2;
        }
        else{
            $curso->status = 1;
        }

    }
        $curso->save();
        

        return redirect ('/home')->with('status','Matriculado com sucesso em: ' . $curso->name);
    }

    public function leave($cursoid,$aluid){

        $admin = Auth::user();

        if($admin->id != $aluid && $admin->perm != 2 && $admin->perm != 3){
            return redirect ('/cursos');
        }


        $user = User::findOrFail($aluid);
        $user->cursos()->detach($cursoid);
        $curso = curso::findOrfail($cursoid);


        $alunos = User::where('perm', '=', 0)->Orwhere('perm', '=', 3)->get();
        $count = 0;
        foreach($alunos as $aluno){
            foreach($aluno->cursos as $cursoalu){
                if($cursoalu->id == $curso->id){
                    $count = $count + 1;
                }
            }
        }

        if($curso->status != 3){
        if($count < $curso->minalu ){
            $curso->status = 0;
           }
           elseif($count >= $curso->maxalu){
               $curso->status = 2;
           }
           else{
               $curso->status = 1;
           }
           $curso->save();
        
        }
        if($admin->perm == 2 || $admin->perm == 3 ){
            return back()->with('status','Aluno '. $user->name . ' desmatriculado com sucesso');
        }

        return redirect ('/home')->with('status','Você se desmatriculou de: ' . $curso->name);
    }
}
