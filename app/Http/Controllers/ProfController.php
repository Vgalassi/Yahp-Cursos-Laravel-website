<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use App\Models\Cursouser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfController extends Controller
{
    public function index(){
        $admin = Auth::user();
        if($admin->perm != 1){
            return redirect('/');
        }

        
        $notas = Cursouser::all();
        $notaaluno = NULL;
        $cursos = Curso::all();
        $alunos = User::where('perm', '=', 0)->get();
        $professor = Auth::user();
        $profcursos = Curso::where('user_id','=',$professor->id)->get();

        return view('profs.index',['alunos' => $alunos, 'profcursos' => $profcursos,'notas' => $notas,'notaaluno' => $notaaluno]);
    }

    public function edit($id)
    {
        $admin = Auth::user();
        if($admin->perm != 1){
            return redirect('/');
        }
        user::findOrFail($id);
        $user = Auth::user();
        
        return view('profs.edit',['user' => $user]) ;
    }

    public function notas($cursoid,$aluid,Request $request)
    {
        $admin = Auth::user();
        if($admin->perm != 1){
            return redirect('/');
        }
        $user = User::find($aluid);
        $nota = $request->$aluid;
        $curso = CursoUser::where('user_id','=',$aluid)->where('curso_id', '=',$cursoid)->update([
            'nota'=> $request->$aluid]);
        


        return back()->with("status", "Nota " .$nota. ' atribuida para ' .$user->name.'!');

    }
}
