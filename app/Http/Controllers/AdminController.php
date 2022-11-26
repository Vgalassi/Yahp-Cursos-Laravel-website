<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use App\Models\Cursouser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $admin = Auth::user();
        if($admin->perm != 2){
            return redirect('/');
        }
        
        $cursos = Curso::all();
        $users = User::all();


        return view('admin.index',['cursos' => $cursos, 'users' => $users]);
    }

    public function create(){
        $admin = Auth::user();
        if($admin->perm != 2){
            return redirect('/');
        }
        return view('auth.register');
    }
    

    public function create_alu( Request $request){

        $admin = Auth::user();
        if($admin->perm != 2){
            return redirect('/');
        }


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'CPF' => ['required','string','unique:users'],
            'cep' => ['required','string', 'max:8'],
            'filme' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:50','unique:users'],
        ]);

        $user = new user;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->CPF = $request->CPF;
        $user->endereco = $request->cep;
        $user->filme = $request->filme;
        


        $user->perm = 0;

        $user->save();
        return back()->with("status", "Aluno " .$user->username. ' adicionado com sucesso!');

   }

   public function create_prof( Request $request){

    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }

    $request->validate([
        'profname' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8','confirmed'],
        'CPF' => ['required','string','unique:users'],
        'pcep' => ['required', 'string', 'max:8'],
        'username' => ['required','string','max:50','unique:users'],
    ]);
    $user = new user;

    $user->imagem = $request->profimagem;
    $user->name = $request->profname;
    $user->username = $request->username;
    $user->password = hash::make($request->password);
    $user->CPF = $request->CPF;
    $user->endereco = $request->pcep;
    $user->filme = 'N/A';
    $user ->email = 'N/A';

    $user->perm = 1;

    $user->save();
    return back()->with("status", "Professor " .$user->username. ' adicionado com sucesso!');
}

public function create_curso( Request $request){

    
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }

    $curso = new curso;

    $curso->name = $request->namecurso;
    $curso->descrisimp = $request->descrisimp;
    $curso->descricomp = $request->descricomp;
    $curso->maxalu = $request->maxalu;
    $curso->minalu = $request->minalu;
    $curso->imagem = $request->cursoimagem;

    if($curso->minalu == 0){
       $curso->status = 0;
    }
    else{
    $curso->status = 1;}

    $curso->save();
    return back()->with("status", "Curso " .$curso->name. ' adicionado com sucesso!');

}

public function show_curso($id){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }

    $curso = Curso::findOrfail($id);
    $notas = Cursouser::where('curso_id', '=',$id )->get();
    $soma = 0;
    $reprovado = 0;
    $aprovado = 0;
    $reprovadop = 0;
    $aprovadop = 0;
    foreach ($notas as $nota){
        $soma = $soma + $nota->nota;
        if($nota->nota >= 5){
            $aprovado = $aprovado + 1;
        }
        else{
            $reprovado = $reprovado + 1;
        }
    }
    if(count($notas) != 0){
        $media = $soma/count($notas);
        $aprovadop = ($aprovado/count($notas)) * 100;
        $reprovadop = ($reprovado/count($notas)) * 100;
    }
    else{
        $media = NULL;
    }
    $users= User::where('perm', '=', 0)->get();
    $professor = User::find($curso->user_id);

    return view('admin.show',['curso' => $curso,'users' =>$users,'professor' => $professor,'media' => $media,
    'notas'=> $notas,'aprovado' => $aprovado,'reprovado' => $reprovado,'aprovadop' => $aprovadop,'reprovadop' => $reprovadop]);
    
}
public function delete_user($id){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }
    User::findOrFail($id)->delete();

    return back()->with("status", "Usuário excluído com sucesso!");

}

public function delete_curso($id){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }
    Curso::findOrFail($id)->delete();

    return back()->with("status", "Curso excluído com sucesso!");

}

public function linkprof(){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }
    $users = User::all();
    $cursos = Curso::all();

    return view('admin.linkprof',[ 'cursos' => $cursos, 'users' => $users]);
}

public function attachprof(Request $request){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }
    $curso = curso::findOrFail($request->cursoid);
    $user = user::findOrFail($request->profid);
    $curso->user_id = $user->id;
    $curso->save();
    return back()->with("status","Professor " .$user->name. ' relacionado com ' .$curso->name );
    
}

public function dettachprof($id){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect('/');
    }
    
    $curso = Curso::findOrFail($id);
    $user = User::findOrFail($curso->user_id);
    $curso->user_id = NULL;
    $curso->save();
    return back()->with("status","Professor " .$user->name. ' desatribuído de ' .$curso->name );
}

public function join(Request $request,$id){
    $admin = Auth::user();

    if($admin->perm != 2){
        return redirect ('/cursos');
    }
    $curso = curso::findOrfail($id);
    if($curso->status == 2 || $curso->status == 3){
        return back()->with('erro','ERRO: Matrículas fechadas!');
    }
    $user = User::findOrfail($request->alunoid);

    $cursosusuario = $user->cursos->toArray();
    foreach ($cursosusuario as $cursousuario){
        if($cursousuario['id'] == $id){
            return back()->with('erro','Aluno já está no curso');
        } 
    }
    $user->cursos()->attach($id);

    $curso = curso::findOrfail($id);

    $alunos = User::where('perm', '=', 0)->get();
    $count = 0;

    foreach($alunos as $aluno){
        foreach($aluno->cursos as $cursoalu){
            if($cursoalu->id == $curso->id){
                $count = $count + 1;
            }
        }
    }

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
    

    return back()->with('status','Aluno ' . $user->name . ' matriculado com sucesso em: ' . $curso->name);
}

public function edit_curso($id){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect ('/cursos');
    }
    $curso = Curso::findOrFail($id);

    return view('admin.edit',['curso' => $curso]);
}

public function update_curso($id,Request $request){
    $admin = Auth::user();
    if($admin->perm != 2){
        return redirect ('/cursos');
    }
    if($request->maxalu < $request->minalu){
        return back()->with('erro','ERRO: mínimo de alunos maior do que máximo de alunos');}

    $alunos = User::where('perm', '=', 0)->get();
    $curso = Curso::findOrfail($id);
    $count = 0;
    foreach($alunos as $aluno){
        foreach($aluno->cursos as $cursoalu){
            if($cursoalu->id == $curso->id){
                $count = $count + 1;
            }
        }
    }

    Curso::findOrfail($id)->update($request->all());
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
    return back()->with("status", "Dados alterados com sucesso");

}
    public function close($id){
        $admin = Auth::user();
        if($admin->perm != 2){
            return redirect ('/cursos');
        }

        $curso = Curso::findOrfail($id);
        $curso->status = 3;
        $curso->save();

        return back()->with("status", "Curso fechado com sucesso");
    }

    public function open($id){
        $admin = Auth::user();
        if($admin->perm != 2){
            return redirect ('/cursos');
        }

    $alunos = User::where('perm', '=', 0)->get();
    $curso = Curso::findOrfail($id);
    $count = 0;
    foreach($alunos as $aluno){
        foreach($aluno->cursos as $cursoalu){
            if($cursoalu->id == $curso->id){
                $count = $count + 1;
            }
        }
    }

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

        return back()->with("status", "Fechamento forçado cancelado com sucesso!");
    }


}
