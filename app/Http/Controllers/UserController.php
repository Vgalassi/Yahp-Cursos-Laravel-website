<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cursouser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $admin = Auth::user();
        if($admin->perm != 0){
            return redirect('/');
        }
        $user = Auth::user();
        $notas = Cursouser::where('user_id','=',$user->id)->get();

        $cursospart = $user->cursos;
        return view('users.index',['cursospart' => $cursospart,'notas' => $notas]);
    }

    public function show($id)
    {
        $admin = Auth::user();
        if($admin->perm != 0 && $admin->perm != 1){
            return redirect('/');
        }
        user::findOrFail($id);
        $user = Auth::user();
        return view('users.show',['user' => $user]);
    }

    public function edit($id)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 2){
            return redirect('/');
        }
        $user = user::findOrFail($id);
        
        
        return view('users.edit',['user' => $user]) ;
    }

    public function update($id,Request $request)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 2){
            return redirect('/');
        }


        $user = user::findOrFail($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'CPF' => $request->CPF,
            'endereco' => $request->endereco,
            'filme' => $request->filme
        ]);


        if($admin->perm == 1){
            return redirect ('/professor')->with("status",'Dados alterados com sucesso');
        }

        if($admin->perm == 2){
            return back()->with("status", "Dados alterados com sucesso");
        }
        return redirect('/home')->with("status",'Dados alterados com sucesso');

    }

    public function editpassword($id)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 2){
            return redirect('/');
        }
        $user = user::findOrFail($id);
        
        return view('users.editpassword',['user' => $user]) ;
    }

    public function updatepassword(Request $request)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 2){
            return redirect('/');
        }
        $request->validate([
            'antigopassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        if(!hash::check($request->antigopassword,auth()->user()->password)){
            return back()->with("error", "ERRO: Senha incorreta");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/professor')->with("status",'Senha alterada com sucesso');
    }
}
