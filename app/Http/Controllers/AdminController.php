<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
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
public function delete_user($id){
    User::findOrFail($id)->delete();

    return back()->with("status", "Usuário excluído com sucesso!");

}

public function delete_curso($id){
    Curso::findOrFail($id)->delete();

    return back()->with("status", "Curso excluído com sucesso!");

}

public function linkprof(){
    $users = User::all();
    $cursos = Curso::all();

    return view('admin.linkprof',[ 'cursos' => $cursos, 'users' => $users]);
}

public function attachprof(Request $request){
    $curso = curso::findOrFail($request->cursoid);
    $user = user::findOrFail($request->profid);
    $curso->user_id = $user->id;
    $curso->save();
    return back()->with("status","Professor " .$user->name. ' relacionado com ' .$curso->name );
    
}

public function dettachprof($id){
    
    $curso = Curso::findOrFail($id);
    $user = User::findOrFail($curso->user_id);
    $curso->user_id = NULL;
    $curso->save();
    return back()->with("status","Professor " .$user->name. ' desatribuído de ' .$curso->name );
}
}
