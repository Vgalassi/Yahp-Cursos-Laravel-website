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
            'endereco' => ['required', 'string', 'max:255'],
            'filme' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:50','unique:users'],
        ]);

        $user = new user;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->CPF = $request->CPF;
        $user->endereco = $request->endereco;
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
        'profendereco' => ['required', 'string', 'max:255'],
        'username' => ['required','string','max:50','unique:users'],
    ]);
    $user = new user;

    $user->imagem = $request->profimagem;
    $user->name = $request->profname;
    $user->username = $request->username;
    $user->password = hash::make($request->password);
    $user->CPF = $request->CPF;
    $user->endereco = $request->profendereco;
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
}
